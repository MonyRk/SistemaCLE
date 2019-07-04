@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')


<div class="header pb-5 pt-5 pt-lg-8 d-flex align-items-center" >
</div>
    
    <div class="container-fluid m--t">
        <div class="card-body ">
            @if ($errors->any())
                <p>No pudimos agregar los datos, <br> por favor, verifica la información</p>
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                </ul>                            
            @endif

        <form method="post" action="{{ route('agregarGrupo') }}" autocomplete="off">
            @csrf
            @method('post')

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
                        <input type="text" name="name" id="input-name" class="form-control" placeholder="" value="{{ old('name') }}" >
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-nivel">{{ __('Nivel') }}</label>
                        <select id="input-nivel" class="form-control" name="nivel">
                            <option selected></option>
                                @foreach ($grupos as $grupo)
                                    <option value="{{ $grupo->nivel_id }}">{{ $grupo->nivel }}{{ $grupo->modulo }}</option>                             
                                @endforeach
                        </select>                  
                    </div>                 
                </div>
                <div class="row">
                        <div class="form-group col-md">
                                <label class="form-control-label" for="input-modalidad">{{ __('Modalidad') }}</label>
                                <select id="input-modalidad" class="form-control" name="modalidad">
                                    <option selected></option>
                                        <option value="Semanal">{{ __('Semanal') }}</option>
                                        <option value="Sabatino">{{ __('Sabatino') }}</option>
                                </select>                  
                            </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-aula">{{ __('Aula') }}</label>
                        <select id="input-aula" class="form-control" name="aula">
                            <option selected></option>
                                @foreach ($aulas as $aula)
                                <option value="{{ $aula->id_aula }}">{{ $aula->edificio }}{{ $aula->num_aula }}</option>                             
                                @endforeach
                        </select>                  
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-hora">{{ __('Hora') }}</label>
                        <select id="input-hora" class="form-control" name="hora"> 
                        </select>                  
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-nivel">{{ __('Docente') }}</label>
                        <select id="input-docente" class="form-control" name="docente">
                            <option selected></option>
                                @foreach ($maestros as $maestro)
                                <option value="{{ $maestro->id_docente }}">{{ $maestro->nombres }} {{ $maestro->ap_paterno }} {{ $maestro->ap_materno }}</option>                             
                                @endforeach
                        </select>                  
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-periodo">{{ __('Periodo') }}</label>
                        <select id="input-periodo" class="form-control" name="periodo">
                            <option selected></option>
                                @foreach ($periodos as $periodo)
                                 <option value="{{ $periodo->id }}">{{ $periodo->descripcion }} {{ $periodo->anio }}</option>                             
                                @endforeach
                        </select>                  
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4">{{ __('Guardar') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    var $jq = jQuery.noConflict();
    $jq(document).ready(function(){
        $jq('#input-aula').on('change',function(){
            var aula_id = $jq(this).val();
            if ($jq.trim(aula_id) != ''){
                $jq.get('aulas',{id_aula: aula_id},function(aulas){
                    $jq('#input-hora').empty();
                    $jq('#input-hora').append("<option value=''></option>");
                    $jq.each(aulas, function(index, value){ 
                        console.log(index,value);
                        for (let i = 0; i < 14; i++) {
                            if (value[i] != null) {
                                $jq('#input-hora').append("<option value='"+ i +"'>"+ value[i] +"</option>");
                            }
                        }
                    });
                });
            }
        });
    });
    </script>
@endsection