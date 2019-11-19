@extends('layouts.app')
@section('sidebar')
@include('layouts.navbars.sidebar')
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md pt-3">
            @include('flash-message')
            @if ($errors->any())
            <div class="alert alert-danger alert-block pt-2">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <ul>
                    @foreach($errors->all() as $error)
                    <li> {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </div>
    <div class="text-right pb-4">
        <a href="{{ route('catalogos') }}" class="btn btn-outline-primary btn-sm mt-4">
            <span>
                <i class="fas fa-reply"></i> &nbsp; Regresar
            </span>
        </a>
    </div>

    {{-- <div class="col text-right mt-3">
        <button type="button" class="btn btn-sm btn-white" data-toggle="modal" data-target="#modal-form">{{ __('Crear Grupo de Respuestas') }}<i class="fas fa-plus-circle"></i></button>
    </div> --}}
    <div class="row mt-3">
        <div class="col-xl">
            <div class="card shadow ">
                <div class="card-header border-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="mb-0">{{ __('Clasificación de Preguntas para la Evaluación Docente') }}</h5>
                        </div>
                        <div class="col text-right">
                            <button type="button" class="btn btn-sm btn-white" data-toggle="modal" data-target="#modal-form2">{{ __('Agregar Clasificación ') }}<i class="fas fa-plus-circle"></i></button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush th">
                        <thead class="thead-light">
                            <tr>
                                <th></th>
                                <th scope="col">Clasificaci&oacute;n</th>
                                {{-- <th scope="col">Clasificaci&oacute;n de Respuesta</th> --}}
                                <th scope="col">Editar</th>
                                {{-- <th scope="col">Eliminar</th> --}}

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($respuestas as $clasificacion)
                            <tr>
                                <th></th>
                                <th scope="row">
                                    {{ $clasificacion->clasificacion }}
                                </th>
                                {{-- <td>
                                    {{ $respuesta->grupoRespuesta }}
                                </td> --}}
                                <td>
                                    <a href="" class="text-primary" data-idclasificacion="{{ $clasificacion->id_clasificacion }}" data-clasificacion="{{ $clasificacion->clasificacion }}" data-toggle="modal" data-target="#modal-form3"><i class="fas fa-edit"></i></a>
                                </td>
                                {{-- <td>
                                    <a href="" class="text-danger" id="respid" data-respuid="{{ $clasificacion->id_clasificacion }}" data-toggle="modal" data-target="#modal-notification"><i class="far fa-trash-alt"></i></a>
                                </td> --}}
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
<br><br>
@include('layouts.footers.nav')
</div>
{{-- modal para crear clasificacion --}}

<div class="col-md-4">

    <div class="modal fade" id="modal-form2" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card bg-lighter shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <strong>{{ __('Nueva Clasificación') }}</strong>
                            </div>

                            <form role="form" method="post" action="{{  route('agregarClasificacion') }}" autocomplete="off">
                                @csrf
                                @method('post')
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <input class="form-control" name="clasificacion" placeholder="Clasificación" type="text" value="{{ old('clasificacion') }}">
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
{{-- modal para editar --}}
<div class="col-md-4">

    <div class="modal fade" id="modal-form3" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card bg-lighter shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <strong>{{ __('Editar clasificacion') }}</strong>
                            </div>

                            <form role="form" method="post" action="{{  route('guardarClasificacion','test') }}" autocomplete="off">
                                @csrf
                                @method('patch')
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <input class="form-control" id="clasificacionn" name="clasificacion" placeholder="Clasificación" type="text" value="{{ old('clasificacion') }}">
                                        <input type="hidden" name="id_clasificacion" id="id_clasificacion" value="">
                                    </div>
                                </div>
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

{{-- modal para eliminar --}}
<div class="col-md-4">
    <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-white">

                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">¡Espera!</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>

                </div>
                <form action="{{ route('eliminarClasificacion','test') }}" method="POST" class="delete" id="deleteForm">
                    @csrf
                    @method('delete')
                    <div class="modal-body">

                        <div class="py-3 text-center">
                            <i class="fas fa-times fa-3x" style="color:#CD5C5C;"></i>
                            <h4 class="heading mt-4">¡Da tu confirmaci&oacute;n para Eliminar!</h4>
                            <p>¿Realmente deseas eliminar la respuesta?</p>
                            <input type="hidden" name="id_r_eliminar" id="id_r_eliminar" value="">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-danger">S&iacute;, Eliminar</button>
                        <button type="button" class="btn btn-link text-gray ml-auto" data-dismiss="modal">No, Cambi&eacute; de opinion</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- modal para crear GRUPO  de respuestas --}}

<div class="col-md-4">

    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card bg-lighter shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <strong>{{ __('Nuevo Grupo de Respuestas') }}</strong>
                            </div>

                            <form role="form" method="post" action="{{  route('agregargrupoR') }}" autocomplete="off">
                                @csrf
                                @method('post')
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <input class="form-control" name="grupoR" placeholder="Grupo de Respuesta" type="text" value="{{ old('grupoR') }}">
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





@section('script')
<script>
    // para eliminar
    $('#modal-notification').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id_res = button.attr('data-respuid')
        var modal = $(this)
        modal.find('.modal-body #id_r_eliminar').val(id_res);
    })



    // para editar
    $('#modal-form3').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id_clasificacion = button.attr('data-idclasificacion')
        var clasificacion = button.attr('data-clasificacion')
        var modal = $(this)
        modal.find('.modal-body #clasificacionn').val(clasificacion);
        modal.find('.modal-body #id_clasificacion').val(id_clasificacion);
    })
</script>
@endsection


@endsection