@extends('layouts.app')
@section('sidebar')
@php
$usuarioactual = \Auth::user();
@endphp
@if ($usuarioactual->tipo == 'coordinador')
@include('layouts.navbars.sidebar')
@else
@include('layouts.navbars.sidebarEstudiantes')
@endif
@endsection
@section('content')

<div class="container-fluid m--t">
    <div class="col-md mt-4">
        @include('flash-message')
        @if ($errors->any())
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>No pudimos agregar los datos, <br> por favor, verifica la información</strong>
            <ul>
                @foreach($errors->all() as $error)
                <li> {{ $error }}</li>
                @endforeach
            </ul>
        </div>

        @else
        @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        @endif
    </div>
    <div class="row">
        <div class="col-md">
            <div class="text-right">

                <a href="{{ back() }}" class="btn btn-outline-primary mt-2 mb-4">
                    <span>
                        <i class="fas fa-reply"></i> &nbsp; Regresar
                    </span>
                </a>
            </div>
        </div>
    </div>
<form action="{{ route('inscribirEnGrupo') }}" method="post">
@csrf
@method('post')
    <!-- header de la tabla-->
    <div class="row">
        <div class="col-xl">
            <div class="col-xl">
                <div class="card shadow ">
                    <div class="card-header border-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="mb-0">{{ __('Grupos Disponibles Periodo ') }}{{ $grupos[0]->descripcion }} {{ $grupos[0]->anio }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush th">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Grupo</th>
                                    <th scope="col">Nivel</th>{{--viene nivel y modulo --}}
                                    <th scope="col">Idioma</th>
                                    <th scope="col">Aula</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Docente</th>
                                    <th scope="col">Inscribirme</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($grupos as $grupo)
                                @php
                                    $alumnos_en_el_grupo = App\Inscripcion::where('alumno_inscrito.id_grupo',$grupo->id_grupo)->count();
                                @endphp 
                                @if ($alumnos_en_el_grupo < $grupo->cupo)
                                    <tr>
                                        <th scope="row">
                                            <span> {{ $grupo->grupo }}</span>
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
                                        <th>
                                            {{ $grupo->hora }}
                                        </th>
                                        <th>
                                            {{ $grupo->nombres }} {{ $grupo->ap_paterno }} {{ $grupo->ap_materno }}
                                        </th>
                                        <td>
                                            <div class="custom-control custom-radio mb-0">
                                                <input name="grupo" class="custom-control-input" id="grupo{{ $grupo->id_grupo }}" type="radio" value="{{ $grupo->id_grupo }}">
                                                <label class="custom-control-label" for="grupo{{ $grupo->id_grupo }}">G</label>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- {{ $grupos->links() }} --}}
                </div>
            </div>
        </div>
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-4">{{ __('Inscribirme') }}</button>
    </div>
</form>
    <br><br>
    @include('layouts.footers.nav')
</div>


@endsection