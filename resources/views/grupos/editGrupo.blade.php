@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')

<div class="header pb-2 pt-5 pt-lg-8 d-flex align-items-center text-center" >
        <div class="col-lg col-md">
            <h4 class="text-dark">Editar Grupo</h4>
        </div>
    </div>
    
    <div class="container-fluid m--t">
        <div class="text-right">
            <a href="{{route('verGrupos')}} " class="btn btn-outline-primary btn-sm mt-4">
                <span>
                    <i class="fas fa-reply"></i> &nbsp; Regresar
                </span>
            </a>
        </div>
        <div class="card-body">
            @if ($errors->any())
            <div class="alert alert-danger alert-block pt-2">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>No pudimos actualizar los datos, <br> por favor, verifica la información</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </ul>  
                </div> 
            @endif
        </div>

        <form method="post" action="{{ route('guardarGrupo',$grupos[0]->id_grupo) }}" autocomplete="off">
            @csrf
            @method('post')
<input type="hidden" name="id_grupo" value="{{ $grupos[0]->id_grupo }}">
            <h6 class="heading-small text-muted mb-4">{{ __('Información Principal') }}</h6>
            
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                   
                </div>
            @endif

            <div class="pl-lg-4">
                <div class="row">
                    <div class="col-md">
                        <label class="form-control-label" for="input-name">{{ __('Nombre del Grupo') }}</label>
                        <input type="text" name="name" id="input-name" class="form-control" placeholder="" value="{{ old('name',$grupos[0]->grupo) }}" >
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-nivel">{{ __('Docente') }}</label>
                        <select id="input-docente" class="form-control" name="docente">
                            <option value="{{ old('docente',$grupos[0]->id_docente) }}" selected>{{ $grupos[0]->nombres }} {{ $grupos[0]->ap_paterno }} {{ $grupos[0]->ap_materno }}</option>
                                @foreach ($maestros as $maestro)
                                <option value="{{ $maestro->id_docente }}">{{ $maestro->nombres }} {{ $maestro->ap_paterno }} {{ $maestro->ap_materno }}</option>                             
                                @endforeach
                        </select>                  
                    </div>        
                </div>
                <div class="row">
                    <div class="form-group col-md">
                            <label class="form-control-label" for="input-modalidad">{{ __('Modalidad') }}</label>
                            <select id="input-modalidad" class="form-control" name="modalidad">
                                <option value="{{ old('modalidad',$grupos[0]->modalidad) }}"selected>{{ old('modalidad',$grupos[0]->modalidad) }}</option>
                                    <option value="Semanal">{{ __('Semanal') }}</option>
                                    <option value="Sabatino">{{ __('Sabatino') }}</option>
                            </select>                  
                        </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-aula">{{ __('Aula') }}</label>
                        <select id="input-aula" class="form-control" name="aula">
                            <option value="{{ $grupos[0]->id_aula }}" selected>{{ $grupos[0]->edificio }}{{ $grupos[0]->num_aula }}</option>
                                @foreach ($aulas as $aula)
                                <option value="{{ $aula->id_aula }}">{{ $aula->edificio }}{{ $aula->num_aula }}</option>                             
                                @endforeach
                        </select>                  
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-hora">{{ __('Hora') }}</label>
                        <select id="input-hora" class="form-control" name="hora"> 
                                <option value="{{ $grupos[0]->hora }}" selected>{{ $grupos[0]->hora }}</option>
                        </select>                  
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-nivel">{{ __('Nivel') }}</label>
                        <select id="input-nivel" class="form-control" name="nivel">
                            <option value="{{ old('nivel',$grupos[0]->nivel_id) }}" selected>{{ $grupos[0]->nivel }}{{ $grupos[0]->modulo }}&nbsp;-&nbsp;{{ $grupos[0]->idioma }}</option>
                                @foreach ($niveles as $nivel)
                                    <option value="{{ $nivel->id_nivel }}">{{ $nivel->nivel }}{{ $nivel->modulo }}&nbsp;-&nbsp; {{ $nivel->idioma }}</option>                             
                                @endforeach
                        </select>                  
                    </div>       
                    <div class="col-md">
                        <label class="form-control-label" for="input-cupo">{{ __('Límite de Estudiantes en el grupo') }}</label>
                        <input type="text" name="cupo" id="input-cupo" class="form-control" placeholder="" value="{{ old('cupo',$grupos[0]->cupo) }}" >
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-periodo">{{ __('Periodo') }}</label>
                        <select id="input-periodo" class="form-control" name="periodo">
                            <option value="{{ $grupos[0]->id_periodo }}" selected>{{ $grupos[0]->descripcion }} {{ $grupos[0]->anio }}</option>
                                @foreach ($periodos as $periodo)
                                 <option value="{{ $periodo->id_periodo }}">{{ $periodo->descripcion }} {{ $periodo->anio }}</option>                             
                                @endforeach
                        </select>                  
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4">{{ __('Actualizar') }}</button>
                </div>
            </div>
        </form>
        <br><br>
        @include('layouts.footers.nav')
    </div>
</div>
@endsection

@section('script')
<script>
    var $jq = jQuery.noConflict();
    $jq(document).ready(function(){
        $jq('#input-aula').on('change',function(){
            var aula_id = $jq(this).val();
            // if ($jq.trim(aula_id) != ''){
                $jq.get('/sistema-cle/public/aulas',{id_aula: aula_id},function(aulas){
                    $jq('#input-hora').empty();
                    $jq('#input-hora').append("<option value=''></option>");
                    $jq.each(aulas, function(index, value){ 
                        for (let i = 0; i < 14; i++) {
                            if (value[i] != null) {
                                $jq('#input-hora').append("<option value='"+ i +"'>"+ value[i] +"</option>");
                            }
                        }
                    });
                });
            // }
        });
    });
    </script>
@endsection