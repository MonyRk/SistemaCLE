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
    <div class="col-md mt-4">
    
    <div class="row">
        <div class="col-md">
            <div class="text-right">

                <a href="{{ route('periodoinscripciones') }}" class="btn btn-outline-primary mt-4">
                    <span>
                        <i class="fas fa-reply"></i> &nbsp; Regresar
                    </span>
                </a>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-md"></div>
        <div class="col-md">
            <div class="">
                <form action=" {{ route('buscarGrupoInscripcion') }} " method="GET" class="navbar-search navbar-search-dark form-inline mr-5 d-none d-md-flex ml-lg-9" style="margin-top: 15px">
                    <div class="form-group mb-0">
                        <div class="input-group input-group-alternative">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-search"></i></span>
                            </div>
                            <input name="buscar" class="form-control" placeholder="Buscar" type="text">
                            <input type="hidden" name="per" value="{{ $p[0]->id_periodo }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div><br>
    @include('flash-message')
        @if ($errors->any())
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{-- <strong>No pudimos agregar los datos, <br> por favor, verifica la información</strong> --}}
            <ul>
                @foreach($errors->all() as $error)
                <li> {{ $error }}</li>
                @endforeach
            </ul>
        </div>        
        @endif
    <br>
    <form method="post" action="{{ route('fechaInscripciones') }}" autocomplete="off">
            @csrf
            @method('post')
            
        <div class="row" @if($usuarioactual->tipo != 'coordinador') style="display:none;" @else @if($periodo_actual[0]->id_periodo != $p[0]->id_periodo) style="display:none;"@endif @endif>
            @php
                if ($fecha_inscripciones == null) {
                    $inicio = '';
                    $fin = '';
                } else {
                   $inicio = date('d-m-Y', strtotime($fecha_inscripciones->fecha_inicio));
                   $fin = date('d-m-Y', strtotime($fecha_inscripciones->fecha_fin));
                }
                
            @endphp
            <strong>Duraci&oacute;n de Inscripciones: </strong> <br>
            <div class="form-group col-md-2">
                <label class="form-control-label" for="fecha-inicio">{{ __('Fecha de Inicio') }}</label>
                <input type="text" class="form-control" name="inicio" id="fecha-inicio" placeholder="dd-mm-aaaa" value="{{ old('inicio', $inicio) }}">
            </div>
            <div class="form-group col-md-2">
                <label class="form-control-label" for="fecha-fin">{{ __('Fecha Final') }}</label>
                <input type="text" class="form-control" name="fin" id="fecha-fin" placeholder="dd-mm-aaaa" value="{{ old('fin',$fin) }}">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-4">{{ __('Guardar') }}</button>
            </div>
        </div>
    </form>

    <div class="row">
        <div class="col-xl">
            <div class="col-xl">
                <div class="card shadow ">
                    <div class="card-header border-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="mb-0">{{ __('Grupos del periodo ') }}{{ $p[0]->descripcion }} {{ $p[0]->anio }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush th">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Grupo</th>
                                    <th scope="col">Nivel</th>
                                    <th scope="col">Idioma</th>
                                    <th scope="col">Aula</th>
                                    <th scope="col">Hora</th>
                                    @if($usuarioactual->tipo == 'coordinador')
                                        <th scope="col">Docente</th> 
                                        <th scope="col">Modalidad</th>
                                        <th scope="col">Capacidad Total</th>
                                        <th scope="col">Capacidad Actual</th>
                                        @if($periodo_actual[0]->id_periodo == $p[0]->id_periodo)                                     
                                            <th scope="col">Inscribir</th>
                                            <th scope="col">Modificar</th>
                                        @endif
                                    @endif
                                    
                                    <th scope="col">Lista</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grupos as $grupo)
                                <tr>
                                    <th scope="row">
                                        <span> {{ $grupo->grupo }}</span>
                                    </th>
                                    <th>
                                        {{ $grupo->nivel }}{{ $grupo->modulo }}
                                    </th>
                                    <td>
                                        {{ $grupo->idioma }}
                                    </td>
                                    <td>
                                        {{ $grupo->edificio }}{{ $grupo->num_aula }}
                                    </td>
                                    <td>
                                        {{ $grupo->hora }}
                                    </td>
                                    @if($usuarioactual->tipo == 'coordinador')
                                    <td>
                                        {{ $grupo->nombres }} {{ $grupo->ap_paterno }} {{ $grupo->ap_materno }}
                                    </td> 
                                    <td>
                                        {{ $grupo->modalidad }}
                                    </td>
                                    <td>
                                        {{ $grupo->cupo }}
                                    </td>
                                    <td>
                                        @php
                                            
                                            $alumnos_en_el_grupo = 
                                            App\Inscripcion::where('alumno_inscrito.id_grupo',$grupo->id_grupo)
                                    ->count();
                                        @endphp
                                        {{ $alumnos_en_el_grupo }}
                                    </td>
                                    @if($periodo_actual[0]->id_periodo == $p[0]->id_periodo)  
                                    <td >
                                        <a href="{{ route('inscribirEstudiantes',$grupo->id_grupo) }}" class="text-primary">
                                            <i class="far fa-list-alt"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('quitarEstudiante',$grupo->id_grupo) }}" class="text-info">
                                            <i class="far fa-edit"></i>
                                        </a>
                                    </td>
                                    @endif
                                    @endif
                                    <td>
                                        <a href="{{ route('descargarLista',$grupo->id_grupo) }}" class="text-blue">
                                            <i class="fas fa-file-download"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $grupos->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
    <br><br>
    @include('layouts.footers.nav')
</div>


@endsection