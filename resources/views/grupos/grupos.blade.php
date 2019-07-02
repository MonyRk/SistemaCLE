@extends('viewsBase.view')

@section('title')
@endsection

@section('filtros')
@if ($errors->any())
    <p>No pudimos agregar los datos, <br> por favor, verifica la información</p>
    <ul>
        @foreach($errors->all() as $error)
            <li> {{ $error }}</li>
        @endforeach
    </ul>
@endif
    <!-- filtros de busqueda -->
    <label for="hora">{{ __('Hora') }}</label><br>
    <select name="hora" id="hora" class="form-control">
        <option selected>{{ __('  ') }}</option>
            @for ($i = 7; $i <= 19; $i++)
                <option value={{ "".$i.":00:00" }}>{{ $i.':00' }}</option>
            @endfor
    </select>

    <br>
    {{-- buscar por nivel --}}
    Nivel <br>
    <select id="" class="form-control" name="filtronivel">
        <option selected>{{ __(' ') }}</option>
            @foreach ($niveles as $nivel)
            <option value="{{ $nivel->id_nivel }}">{{ $nivel->nivel }}{{ $nivel->modulo }}-{{ $nivel->idioma }}</option>
            @endforeach
    </select>
    <br>
    {{-- buscar por aula  --}}
    
    Aula <br>
    <select id="" class="form-control" name="filtroaula">
        <option selected>{{ __(' ') }}</option>
            @foreach ($aulas as $aula)
            <option value="{{ $aula->id_aula }}">{{ $aula->edificio }}{{ $aula->num_aula }}</option>
            @endforeach
    </select>
    <br>
    Modalidad
    <br>
    <select name="filtromodalidad" id="" class="form-control">
        <option value="" selected></option>
        <option value="Semanal">{{ __('Semanal') }}</option>
        <option value="Sabatino">{{ _('Sabatino') }}</option>
    </select>
    <br>
    Docente
    <br>
    <select name="filtrodocente" id="" class="form-control">
        <option value="" selected></option>
        @foreach ($docentes as $docente)
            <option value="{{ $docente->id_docente }}">{{ $docente->nombres }} {{ $docente->ap_paterno }} {{ $docente->ap_materno }}</option>
        @endforeach
    </select>
    <br>
    Periodo
    <br>
    <select name="filtroperiodo" id="" class="form-control">
        <option value="" selected></option>
        @foreach ($periodos as $periodo)
            <option value="{{ $periodo->id_periodo }}">{{ $periodo->descripcion }} {{ $periodo->anio }}</option>    
        @endforeach
    </select>
    <br>

@endsection

@section('contenido')
    <!-- header de la tabla-->
    <div class="col-xl">
            <div class="card shadow ">
                <div class="card-header border-3">
                    <div class="row align-items-center">
                        <div class="col">
                            <h4 class="mb-0">{{ __('Información de los Grupos') }}</h4>
                        </div>
                        <div class="col text-right">
                            <a href="{{ url("/agregarGrupo") }}" class="btn btn-sm btn-gray">Crear
                                <i class="fas fa-plus-circle"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush th">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">Grupo</th>
                                <th scope="col">Nivel</th>{{--viene nivel y modulo --}}
                                <th scope="col">Idioma</th>
                                <th scope="col">Aula</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Eliminar</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grupos as $grupo)
                            <tr>
                                <th scope="row">
                                    {{ $grupo->grupo }}
                                </th>
                                <th>
                                    {{ $grupo->nivel }}{{ $grupo->modulo }}
                                </th>
                                <th>
                                    {{ $grupo->idioma }}
                                </th>
                                <th>
                                    {{ $grupo->edificio }}{{ $grupo->num_aula }}
                                </th>
                                <td> <a href="grupos/{{ $grupo->id_grupo }}/editar"><i class="fas fa-edit"></i></a>
                                </td>
                                <td>
                                    <a href="grupos/{{ $grupo->id_grupo }}/eliminar"><i class="far fa-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
