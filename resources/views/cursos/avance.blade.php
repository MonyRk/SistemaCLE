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

<div class="container-fluid m--t text-center">
        <div class="text-right mt-2">
            <a @if ($usuarioactual->tipo == 'coordinador')
                href="{{ route('buscarCurso') }}"
                @else
                href="{{ route('inicio') }}"
                @endif
             class="btn btn-outline-primary btn-sm mt-2">
                <span>
                    <i class="fas fa-reply"></i> &nbsp; Regresar
                </span>
            </a>
        </div>
    <div class="header pb-1 pt-5 pt-lg-7 d-flex align-items-center text-center" >
        <div class="col-lg col-md">
            <h5 class="text-dark">Avance del Estudiante</h5><br>
            <h4 class="text-dark">
            {{ $estudiante[0]->nombres }} {{ $estudiante[0]->ap_paterno }} @if ($estudiante[0]->ap_materno != null) {{ $estudiante[0]->ap_materno }} @endif
            </h4>
        </div>
    </div>
    <div class="card-body">
        @include('flash-message')
    </div>
    <div class="card-body ">
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
    </div>

    <div class="row mt-4">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">@php $i=9; @endphp
                            <div class="card-body 
                            {{-- @foreach ($cursado as $curso) --}}
                            @if ($cursado[0]->A1M1 == "aprobado") 
                            bg-success 
                            @endif
                            @if ($cursado[0]->A1M1 == "cursando")
                            bg-purple
                            @endif
                            @if ($cursado[0]->A1M1 == "reprobado")
                            bg-yellow
                            @endif
                            @if ($cursado[0]->A1M1 == NULL)
                            bg-gray
                            @endif
                            {{-- @endforeach --}}
                            ">
                                <div class="row">
                                    <div class="col">
                                        <span class="font-weight-bold mb-0">A1M1</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body 
                                {{-- @foreach ($cursado as $curso) --}}
                                @if ($cursado[0]->A2M1 == "aprobado") 
                                bg-success 
                                @endif
                                @if ($cursado[0]->A2M1 == "cursando")
                                bg-purple
                                @endif
                                @if ($cursado[0]->A2M1 == "reprobado")
                                bg-yellow
                                @endif
                                @if ($cursado[0]->A2M1 == NULL)
                                bg-gray
                                @endif
                                {{-- @endforeach --}}
                                ">
                                <div class="row">
                                    <div class="col">
                                        <span class=" font-weight-bold mb-0">A2M1</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body 
                                {{-- @foreach ($cursado as $curso) --}}
                                @if ($cursado[0]->A2M2 == "aprobado") 
                                bg-success 
                                @endif
                                @if ($cursado[0]->A2M2 == "cursando")
                                bg-purple
                                @endif
                                @if ($cursado[0]->A2M2 == "reprobado")
                                bg-yellow
                                @endif
                                @if ($cursado[0]->A2M2 == NULL)
                                bg-gray
                                @endif
                                {{-- @endforeach --}}
                                ">
                                <div class="row">
                                    <div class="col">
                                        <span class=" font-weight-bold mb-0">A2M2</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body 
                                {{-- @foreach ($cursado as $curso) --}}
                                @if ($cursado[0]->B1M1 == "aprobado") 
                                bg-success 
                                @endif
                                @if ($cursado[0]->B1M1 == "cursando")
                                bg-purple
                                @endif
                                @if ($cursado[0]->B1M1 == "reprobado")
                                bg-yellow
                                @endif
                                @if ($cursado[0]->B1M1 == NULL)
                                bg-gray
                                @endif
                                {{-- @endforeach --}}
                                ">
                                <div class="row">
                                    <div class="col">
                                        <span class=" font-weight-bold mb-0">B1M1</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body 
                                @if ($cursado[0]->B1M2 == "aprobado") 
                                bg-success 
                                @endif
                                @if ($cursado[0]->B1M2 == "cursando")
                                bg-purple
                                @endif
                                @if ($cursado[0]->B1M2 == "reprobado")
                                bg-yellow
                                @endif
                                @if ($cursado[0]->B1M2 == NULL)
                                bg-gray
                                @endif
                                ">
                                <div class="row">
                                    <div class="col">
                                        <span class="font-weight-bold mb-0">B1M2</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<h6 class="mt-7 text-center">C&oacute;digo de Colores</h6>
<div class="row mt-4 text-center">
    <div class="container-fluid">
        <div class="header-body">
            <!-- Card stats -->
            <div class="row text-center">
                <div  class="col-xl-2"></div>
                <div class="col-xl-2 col-lg-4">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body bg-success">
                            <div class="row">
                                <div class="col">
                                    <span class="font-weight-bold mb-0">Acreditada</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body bg-purple">
                            <div class="row">
                                <div class="col">
                                    <span class=" font-weight-bold mb-0">Cursando</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body bg-yellow">
                            <div class="row">
                                <div class="col">
                                    <span class=" font-weight-bold mb-0">Cursada sin Acreditar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-4">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <div class="card-body bg-gray">
                            <div class="row">
                                <div class="col">
                                    <span class=" font-weight-bold mb-0">Por Cursar</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5" @if ($grupo_inscrito == null || $grupo_inscrito->grupo == null) style="display:none;"@endif >    
        <div class="col-xl">
            <div class="col-xl">
                <div class="card shadow ">
                    <div class="table-responsive">
                        <table id="tabledata" class="table align-items-center table-flush th">
                            <thead class="thead-light">
                                <tr class="card-header">
                                    <th colspan="3">
                                        <h6>Datos del Curso Actual</h6>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                    @if ($grupo_inscrito != null)
                                <tr>
                                    <td>
                                        Grupo: <strong>{{ $grupo_inscrito->grupo }}</strong>
                                    </td>
                                    <td>
                                        Hora: <strong>{{ $grupo_inscrito->hora }}</strong>   
                                    </td>
                                    <td>
                                        Nivel: <strong>{{ $grupo_inscrito->nivel }}{{ $grupo_inscrito->modulo }}</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Idioma: <strong>{{ $grupo_inscrito->idioma }}</strong>
                                    </td>
                                    <td>
                                        Aula: <strong>{{ $grupo_inscrito->edificio }}{{ $grupo_inscrito->num_aula }}</strong>
                                    </td>
                                {{-- </tr>
                                <tr> --}}
                                    <td>
                                        Docente: <strong>{{ $grupo_inscrito->nombres }} {{ $grupo_inscrito->ap_paterno }} @if( $grupo_inscrito->ap_materno != null) {{ $grupo_inscrito->ap_materno }}@endif</strong>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<br><br>
    @include('layouts.footers.nav')
</div>
@endsection