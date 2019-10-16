@extends('layouts.app')
@section('sidebar')
@php
$usuarioactual = \Auth::user();
@endphp
@if ($usuarioactual->tipo == 'coordinador')
@include('layouts.navbars.sidebar')
@endif
@if ($usuarioactual->tipo == 'alumno')
@include('layouts.navbars.sidebarEstudiantes')
@endif
@if ($usuarioactual->tipo == 'docente')
@include('layouts.navbars.sidebarDocentes')
@endif
@endsection
@section('content')
<div class="container-fluid m--t">
    <div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center">
        <div class="col-lg col-md">
            <h4 class="text-dark">Evaluaci&oacute;n Docente</h4>
        </div>
    </div>
    <div class="card-body">
        @include('flash-message')
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <div class="text-right">
        <a href="{{ route('inicio') }}" class="btn btn-outline-primary btn-sm mt--3">
            <span>
                <i class="fas fa-reply"></i> &nbsp; Regresar
            </span>
        </a>
    </div>
    <form role="form" method="post" action="{{ route('guardarEvaluacion') }}" autocomplete="off">
        @csrf
        @method('post')
        <div class="pl-lg-4" id="preguntas">
            @if ($usuarioactual->tipo == 'coordinador')
                <div class="row">
                    <div class="col-md text-right">
                        <button type="button" id="agregar" class="btn btn-primary btn-sm mt-4" data-toggle="modal" data-target="#modal-form2">{{ __('Agregar Pregunta') }}</button>
                    </div>
                </div>
            @endif
            @if ($usuarioactual->tipo == 'alumno')
                @php
                    $estudiante = App\User::where('users.id',$usuarioactual->id)
                            ->leftjoin('alumnos','alumnos.curp_alumno','=','users.curp_user')
                            ->get();
                    $docente_a_evaluar = App\Inscripcion::where('alumno_inscrito.num_control',$estudiante[0]->num_control)
                                                        ->orderBy('alumno_inscrito.updated_at','DESC')
                                                        ->leftjoin('grupos','grupos.id_grupo','=','alumno_inscrito.id_grupo')
                                                        ->leftjoin('docentes','docentes.id_docente','=','grupos.docente')
                                                        ->leftjoin('personas','personas.curp','=','docentes.curp_docente')
                                                        ->select('grupos.id_grupo','docentes.id_docente','personas.nombres','personas.ap_paterno','personas.ap_materno')
                                                        ->first();
                @endphp
                {{-- {{ dd($docente_a_evaluar) }} --}}
                <input type="hidden" name="docente" value="{{ $docente_a_evaluar->id_docente }}">
                <input type="hidden" name="periodo" value="{{ $periodo }}">
                <input type="hidden" name="grupo" value="{{ $docente_a_evaluar->id_grupo }}">
                <div class="row">
                    Evaluaci&oacute;n docente a: &nbsp; <h5 class=" mb-1">{{ $docente_a_evaluar->nombres }} {{ $docente_a_evaluar->ap_paterno }} @if($docente_a_evaluar->ap_materno) {{ $docente_a_evaluar->ap_materno }} @endif
                </div>
                </h5>
            @endif
            <hr class="my-4" />
            <h6 class="heading-small text-muted mb-4">Enfoque de Enseñanza</h6>
            @php $i=0 @endphp
            @foreach ($enfoque as $pEnfoque)
            @php $i++ @endphp
            <div class="row" id="{{ $pEnfoque->id_pregunta }}">
                @if ($usuarioactual->tipo == 'coordinador')
                    <a href="" data-idpreg="{{ $pEnfoque->id_pregunta }}" data-preg="{{ $pEnfoque->pregunta }}" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-edit"></i></a>
                    <a href="" id="" data-preguntaid="{{ $pEnfoque->id_pregunta }}" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-eraser"></i></a>
                @endif
                <input type="hidden" name="preg-res{{ $i }}[]" value="{{ $pEnfoque->id_pregunta }}">
                <div class="form-group col-md">
                    <label class="form-control-label" for="input-pregunta">{{ $i.'.' }}{{ $pEnfoque->pregunta }}</label>
                    <select id="input-pregunta" class="form-control col-md-4" name="preg-res{{$pEnfoque->id_pregunta}}[]">
                        <option selected value="">Elija una opci&oacute;n</option>
                        {{ $respuestas = App\Respuesta::where('grupo_respuesta', $pEnfoque->id_respuesta)->get() }}
                        @foreach ($respuestas as $respuesta)
                          <option value="{{ $respuesta->id_respuesta }}">{{ $respuesta->respuesta }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endforeach
            
            <hr class="my-4" />
            <h6 class="heading-small text-muted mb-4">Clima Afectivo</h6>
            
            @foreach ($clima as $climaA)
            @php $i++ @endphp
            <div class="row" id="{{ $climaA->id_pregunta }}">
                @if ($usuarioactual->tipo == 'coordinador')
                    <a href="" data-idpreg="{{ $climaA->id_pregunta }}" data-preg="{{ $climaA->pregunta }}" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-edit"></i></a>
                    <a href="" id="" data-preguntaid="{{ $climaA->id_pregunta }}" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-eraser"></i></a>
                @endif
                <input type="hidden" name="preg-res{{ $i }}[]" value="{{ $climaA->id_pregunta }}">
                <div class="form-group col-md">
                    <label class="form-control-label" for="input-pregunta">{{ $i.'.' }}{{ $climaA->pregunta }}</label>
                    <select id="input-pregunta" class="form-control col-md-4" name="preg-res{{$climaA->id_pregunta}}[]">
                        <option selected value="">Elija una opci&oacute;n</option>
                        {{ $respuestas = App\Respuesta::where('grupo_respuesta', $climaA->id_respuesta)->get() }}
                        @foreach ($respuestas as $respuesta)
                        <option value="{{ $respuesta->id_respuesta }}">{{ $respuesta->respuesta }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endforeach

            <hr class="my-4" />
            <h6 class="heading-small text-muted mb-4">Proceso de Enseñanza</h6>
            
            @foreach ($enseñanzas as $pEnseñanza)
            @php $i++ @endphp
            <div class="row" id="{{ $pEnseñanza->id_pregunta }}">
                @if ($usuarioactual->tipo == 'coordinador')
                    <a href="" data-idpreg="{{ $pEnseñanza->id_pregunta }}" data-preg="{{ $pEnseñanza->pregunta }}" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-edit"></i></a>
                    <a href="" id="" data-preguntaid="{{ $pEnseñanza->id_pregunta }}" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-eraser"></i></a>
                @endif
                <input type="hidden" name="preg-res{{ $i }}[]" value="{{ $pEnseñanza->id_pregunta }}">
                <div class="form-group col-md">
                    <label class="form-control-label" for="input-pregunta">{{ $i.'.' }}{{ $pEnseñanza->pregunta }}</label>
                    <select id="input-pregunta" class="form-control col-md-4" name="preg-res{{$pEnseñanza->id_pregunta}}[]">
                        <option selected value="">Elija una opci&oacute;n</option>
                        {{ $respuestas = App\Respuesta::where('grupo_respuesta', $pEnseñanza->id_respuesta)->get() }}
                        @foreach ($respuestas as $respuesta)
                        <option value="{{ $respuesta->id_respuesta }}">{{ $respuesta->respuesta }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @endforeach

            <hr class="my-4" />
            <h6 class="heading-small text-muted mb-4">Estrategias de Retroalimentaci&oacute;n </h6>
           
            @foreach ($retroalimentacion as $retroa)
            @php $i++ @endphp
            <div class="row" id="{{ $retroa->id_pregunta }}">
                @if ($usuarioactual->tipo == 'coordinador')
                <a href="" data-toggle="modal" data-target="#modal-edit" data-idpreg="{{ $retroa->id_pregunta }}" data-preg="{{ $retroa->pregunta }}"><i class="fas fa-edit"></i></a>
                <a href="" id="" data-preguntaid="{{ $retroa->id_pregunta }}" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-eraser"></i></a>
                @endif
                <input type="hidden" name="preg-res{{ $i }}[]" value="{{ $retroa->id_pregunta }}">
                <div class="form-group col-md">
                    <label class="form-control-label" for="input-pregunta">{{ $i.'.' }}{{ $retroa->pregunta }}</label>
                    <select id="input-pregunta" class="form-control col-md-4" name="preg-res{{$retroa->id_pregunta}}[]">
                        <option selected value="">Elija una opci&oacute;n</option>
                        {{ $respuestas = App\Respuesta::where('grupo_respuesta', $retroa->id_respuesta)->get() }}
                        @foreach ($respuestas as $respuesta)
                        <option value="{{ $respuesta->id_respuesta }}">{{ $respuesta->respuesta }}</option>
                        @endforeach
                        
                    </select>
                    
                </div>
            </div>
            @endforeach
            @if ($usuarioactual->tipo != 'coordinador')
                <div class="text-center">
                    <button type="sumbit" class="btn btn-primary my-4">{{ __('Guardar') }}</button>
                </div>
            @endif
            
    </form>
<br><br>
@include('layouts.footers.nav')
</div>
{{-- modal para agregar --}}
<div class="col-md-6">

    <div class="modal fade" id="modal-form2" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card bg-lighter shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <strong>{{ __('Nueva Pregunta') }}</strong>
                            </div>

                            <form role="form" method="post" action="{{  route('agregarPregunta') }}" autocomplete="off">
                                @csrf
                                @method('post')
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <input class="form-control" name="pregunta" placeholder="Pregunta" type="text" value="{{ old('pregunta') }}">
                                    </div>
                                </div>
                                <label class="form-control-label" for="input-tipo">{{ __('Clasificación de la Pregunta') }}</label>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <select id="input-tipo" class="form-control" name="tipo">
                                            <option selected value="">Clasificaci&oacute;n</option>
                                            @foreach ($tipoPregunta as $tipo)
                                                <option value="{{ $tipo->tipo }}">{{ $tipo->tipo }}</option>    
                                            @endforeach
                                         </select>
                                    </div>
                                </div>
                                <label class="form-control-label" for="input-respuestas">{{ __('Grupos de Respuestas') }}</label>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <select id="input-respuestas" class="form-control" name="respuestas">
                                            <option selected value="">Tipo de Respuestas</option>
                                            @foreach ($grupoRs as $r)
                                            <option value="{{ $r->id_grupoRespuestas }}">{{ $r->grupoRespuesta }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <label class="form-control-label" for="input-vigencia">{{ __('Año de Vigencia') }}</label>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <select id="input-vigencia" class="form-control" name="vigencia">
                                            @php $anio = date('Y') @endphp
                                            <option selected value="">Vigencia</option> 
                                            {{-- <option selected value="{{ $anio }}">{{ $anio }}</option>  --}}
                                            @for ($i = 0; $i < 6; $i++)
                                                <option value="{{ $anio+$i }}">{{ $anio+$i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="sumbit" class="btn btn-primary my-4">{{ __('Guardar') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- modal para eliminar --}}
<div class="col-md-6">
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-white">
                
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">¡Espera!</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    
                </div>
                <form action="{{ route('eliminarPregunta','test') }}" method="POST" class="delete" id="deleteForm">
                @csrf
                @method('delete')
                <div class="modal-body">
                    
                    <div class="py-3 text-center">
                            <i class="fas fa-times fa-3x" style="color:#CD5C5C;"></i>
                        <h4 class="heading mt-4">¡Da tu confirmaci&oacute;n para Eliminar!</h4>
                        <p>¿Realmente deseas eliminar la pregunta?</p>
                        <input type="hidden" name="idpregunta" id="idpregunta" value="">
                    </div>
                    
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-white">S&iacute;, Eliminar</button>
                    <button type="button" class="btn btn-link text-gray ml-auto" data-dismiss="modal">No, Cambi&eacute; de opinion</button> 
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- modal para editar --}}
<div class="col-md-6">
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card bg-lighter shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <strong>{{ __('Editar Pregunta') }}</strong>
                            </div>

                            <form role="form" method="post" action="{{  route('guardarPregunta','test') }}" autocomplete="off">
                                @csrf
                                @method('patch')
                                
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <input class="form-control" name="pregunta" id="preguntaEdit" placeholder="Pregunta" type="text" value="{{ old('pregunta') }}">
                                    </div>
                                </div>
                                <label class="form-control-label" for="input-tipo">{{ __('Clasificación de la Pregunta') }}</label>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <select id="input-tipo" class="form-control" name="tipo">
                                            <option selected value="">Clasificaci&oacute;n</option>
                                            @foreach ($tipoPregunta as $tipo)
                                                <option value="{{ $tipo->tipo }}">{{ $tipo->tipo }}</option>    
                                            @endforeach
                                            </select>
                                    </div>
                                </div>
                                <label class="form-control-label" for="input-respuestas">{{ __('Grupos de Respuestas') }}</label>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <select id="input-respuestas" class="form-control" name="respuestas">
                                            <option selected value="">Tipo de Respuestas</option>
                                            @foreach ($grupoRs as $r)
                                            <option value="{{ $r->id_grupoRespuestas }}">{{ $r->grupoRespuesta }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <label class="form-control-label" for="input-vigencia">{{ __('Año de Vigencia') }}</label>
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <select id="input-vigencia" class="form-control" name="vigencia">
                                            @php $anio = date('Y') @endphp
                                            <option selected value="">Vigencia</option> 
                                            {{-- <option selected value="{{ $anio }}">{{ $anio }}</option>  --}}
                                            @for ($i = 0; $i < 6; $i++)
                                                <option value="{{ $anio+$i }}">{{ $anio+$i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" id="idpreg" name="idpreg" value="">
                                <div class="text-center">
                                    <button type="sumbit" class="btn btn-primary my-4">{{ __('Actualizar') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
        
        $('#modal-delete').on('show.bs.modal', function(event){
            var button = $(event.relatedTarget) //
            // console.log(button)
            var pregunta_id = button.attr('data-preguntaid')
            // console.log(pregunta_id)
            var modal = $(this)
            // console.log(modal.find('.modal-body #nivel_id').val(alumn_id));
            modal.find('.modal-body #idpregunta').val(pregunta_id);
        } );



// {{-- editar --}}
    $('#modal-edit').on('show.bs.modal', function(event) {
        // console.log('open');
        var button = $(event.relatedTarget)
        var idpregunta = button.attr('data-idpreg')
        // var idpregunta = button.data('idpreg')
        var pregunt = button.attr('data-preg')
        // console.log($(event.relatedTarget))
        var modal = $(this)
        modal.find('.modal-body #preguntaEdit').val(pregunt);
        modal.find('.modal-body #idpreg').val(idpregunta);
    });


        

</script>

@endsection
@endsection