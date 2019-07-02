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
                                <label class="form-control-label" for="input-aula">{{ __('Modalidad') }}</label>
                                <select id="input-aula" class="form-control" name="modalidad">
                                    <option selected></option>
                                        <option value="Semanal">{{ __('Semanal') }}</option>
                                        <option value="Sabatino">{{ __('Sabatino') }}</option>
                                </select>                  
                            </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-aula">{{ __('Aula') }}</label>
                        <select id="input-aula" class="form-control" name="aula">
                            <option selected></option>
                                @foreach ($grupos as $grupo)
                                <option value="{{ $grupo->id_aula }}">{{ $grupo->edificio }}{{ $grupo->num_aula }}</option>                             
                                @endforeach
                        </select>                  
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-hora">{{ __('Hora') }}</label>
                        
                        <select id="input-hora" class="form-control" name="hora">  
                                    {{-- <option value="13:00">13:00</option>                                        --}}
                                        {{-- <option value="{{ $horasaula[$grupo->id_aula]->hora1 }}">{{ $horasaula[$grupo->id_aula]->hora1 }}</option>
                                        <option value="{{ $horasaula->hora2 }}">{{ $horasaula->hora2 }}</option>
                                        <option value="{{ $horasaula->hora3 }}">{{ $horasaula->hora3 }}</option>
                                        <option value="{{ $horasaula->hora4 }}">{{ $horasaula->hora4 }}</option>
                                        <option value="{{ $horasaula->hora5 }}">{{ $horasaula->hora5 }}</option>
                                        <option value="{{ $horasaula->hora6 }}">{{ $horasaula->hora6 }}</option>
                                        <option value="{{ $horasaula->hora7 }}">{{ $horasaula->hora7 }}</option>
                                        <option value="{{ $horasaula->hora8 }}">{{ $horasaula->hora8 }}</option>
                                        <option value="{{ $horasaula->hora9 }}">{{ $horasaula->hora9 }}</option>
                                        <option value="{{ $horasaula->hora10 }}">{{ $horasaula->hora10 }}</option>
                                        <option value="{{ $horasaula->hora11 }}">{{ $horasaula->hora11 }}</option>
                                        <option value="{{ $horasaula->hora12 }}">{{ $horasaula->hora12 }}</option>
                                        <option value="{{ $horasaula->hora13 }}">{{ $horasaula->hora13 }}</option>  --}}
                                       
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
    $(document).ready(function(){
        $('#input-aula').on('change',function(){
            var aula_id = $(this).val();
            if ($.trim(aula_id) != ''){
                $.get('aulas',{id_aula: aula_id},function('aulas'){
                    $('#input-hora').empty();
                    $('#input-aula').append("<option value=''>Selecciona un aula</option>");
                    $.each(aulas, function(index, value){
                        $('#input-aula').append("<option value='"+ index +"'>"+ value +"</option>");
                    });
                });
            }
        });
    });
    </script>
@endsection