@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')
<div class="container-fluid m--t text-center">
        <div class="text-right mt-2">
                <a href="{{ route('inicio') }}" class="btn btn-outline-primary mt-2">
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

    <div class="row mt-4">
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">@php $i=9; @endphp
                            <div class="card-body 
                            @foreach ($cursado as $curso)
                            @if ($curso->nivel == "A1") 
                            bg-success 
                            @else
                            bg-gray
                            @endif
                            @endforeach
                            ">
                                <div class="row">
                                    <div class="col">
                                        <span class="font-weight-bold mb-0">A1</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                                <div class="card-body 
                                @foreach ($cursado as $curso)
                                @if ($curso->nivel == "A2" && $curso->modulo == "M1") 
                                bg-success 
                                @else
                                bg-gray
                                @endif
                                @endforeach
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
                                @foreach ($cursado as $curso)
                                @if ($curso->nivel == "A2" && $curso->modulo == "M2") 
                                bg-success 
                                @else
                                bg-gray
                                @endif
                                @endforeach
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
                                @foreach ($cursado as $curso)
                                @if ($curso->nivel == "B1" && $curso->modulo == "M1") 
                                bg-success 
                                @else
                                bg-gray
                                @endif
                                @endforeach
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
                                @foreach ($cursado as $curso)
                                @if ($curso->nivel == "B1" && $curso->modulo == "M2") 
                                bg-success 
                                @else
                                bg-gray
                                @endif
                                @endforeach
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
</div>
@endsection