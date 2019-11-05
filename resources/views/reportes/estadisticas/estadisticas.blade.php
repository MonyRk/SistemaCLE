@extends('layouts.app')

@section('sidebar')
@include('layouts.navbars.sidebar')
@endsection

@section('content')

<div class="container-fluid mt-4">
    <div class="text-right">
        <a href="{{ route('inicio') }}" class="btn btn-outline-primary btn-sm mt-4">
            <span>
                <i class="fas fa-reply"></i> &nbsp; Regresar
            </span>
        </a>
    </div>
    <div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center mt-5" >
        <div class="col-lg col-md">
            <h4 class="text-dark">Ingresos Estimados de la CLE del Periodo {{ $periodo[0]->descripcion }} {{ $periodo[0]->anio }}</h4>
        </div>
    </div>
    
    <h2 class="animated fadeInDown slower text-center mt-3">$ {{ $ingresos*814 }}.00</h2>
                        
    <h4 class="mt-6 text-center">Total de Estudiantes inscritos durante el periodo {{ $periodo[0]->descripcion }} {{ $periodo[0]->anio }}</h4>
    <h2 class="animated fadeInDown slower text-center mt-3"> {{ $ingresos }}</h2>
                         
    <div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center mt-6" >
        <div class="col-lg col-md">
            <h4 class="text-dark">Datos Estadisticos del Periodo {{ $periodo[0]->descripcion }} {{ $periodo[0]->anio }}</h4>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-xl-6">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            {{-- <h6 class="text-uppercase text-muted ls-1 mb-1">Grupos por Periodo</h6> --}}
                            <h3 class="mb-0">Estudiantes por Carrera</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        {{-- <canvas id="chart-orders2" class="chart-canvas"></canvas> --}}
                        <canvas id="chart-orders4" width="400" height="400" class="chart-canvas"></canvas>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            {{-- <h6 class="text-uppercase text-muted ls-1 mb-1">Grupos por Periodo</h6> --}}
                            <h3 class="mb-0">Estudiantes por G&eacute;nero</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        {{-- <canvas id="chart-orders2" class="chart-canvas"></canvas> --}}
                        <canvas id="chart-orders5" width="400" height="400" class="chart-canvas"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-xl-6">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            {{-- <h6 class="text-uppercase text-muted ls-1 mb-1">Grupos por Periodo</h6> --}}
                            <h3 class="mb-0">Estudiantes por Nivel</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        {{-- <canvas id="chart-orders2" class="chart-canvas"></canvas> --}}
                        <canvas id="chart-orders7" width="400" height="400" class="chart-canvas"></canvas>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            {{-- <h6 class="text-uppercase text-muted ls-1 mb-1">Grupos por Periodo</h6> --}}
                            <h3 class="mb-0">Índices de Aprobación</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        {{-- <canvas id="chart-orders2" class="chart-canvas"></canvas> --}}
                        <canvas id="chart-orders8" width="400" height="400" class="chart-canvas"></canvas>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="text-right">
        {{-- <a href="{{ route('descargarEstadisticas') }}" class="btn btn-outline-info btn-sm mt-4"> --}}
            <form action="{{ route('descargarEstadisticas') }}" method="get">
                <button type="submit"  class="btn btn-outline-info btn-sm mt-4">
                    <span>
                        <i class="fas fa-file-download"></i> &nbsp; Descargar Datos
                    </span>
                    <input type="hidden" name="periodo" value="{{ $periodo[0]->id_periodo }}">
                </button>
            </form>
        {{-- </a> --}}
    </div>
    <br><br>
@include('layouts.footers.nav')
</div>
    @endsection

@include('viewsBase.baseCharts')
    @push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    @endpush