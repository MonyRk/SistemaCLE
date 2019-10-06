@extends('layouts.app')

@section('sidebar')
@include('layouts.navbars.sidebar')
@endsection

@section('content')

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-xl-6">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            {{-- <h6 class="text-uppercase text-muted ls-1 mb-1">Grupos por Periodo</h6> --}}
                            <h2 class="mb-0">Grupos por Periodo</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        {{-- <canvas id="chart-orders2" class="chart-canvas"></canvas> --}}
                        <canvas id="chart-orders2" width="400" height="400" class="chart-canvas"></canvas>

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
                            <h2 class="mb-0">Estudiantes por Periodo</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        {{-- <canvas id="chart-orders2" class="chart-canvas"></canvas> --}}
                        <canvas id="chart-orders3" width="400" height="400" class="chart-canvas"></canvas>

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
                            <h2 class="mb-0">Estudiantes por Carrera</h2>
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
                            <h2 class="mb-0">Estudiantes del G&eacute;nero Masculino</h2>
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
                            <h2 class="mb-0">Estudiantes del G&eacute;nero Femenino</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        {{-- <canvas id="chart-orders2" class="chart-canvas"></canvas> --}}
                        <canvas id="chart-orders6" width="400" height="400" class="chart-canvas"></canvas>

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
                            <h2 class="mb-0">Estudiantes por Nivel</h2>
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
    </div>
    <div class="row mt-4">
        <div class="col-xl-6">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            {{-- <h6 class="text-uppercase text-muted ls-1 mb-1">Grupos por Periodo</h6> --}}
                            <h2 class="mb-0">Estudiantes Aprobados</h2>
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
        <div class="col-xl-6">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            {{-- <h6 class="text-uppercase text-muted ls-1 mb-1">Grupos por Periodo</h6> --}}
                            <h2 class="mb-0">Estudiantes Reprobados</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        {{-- <canvas id="chart-orders2" class="chart-canvas"></canvas> --}}
                        <canvas id="chart-orders9" width="400" height="400" class="chart-canvas"></canvas>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
@include('layouts.footers.nav')
    @endsection

@include('viewsBase.baseCharts')
    @push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    @endpush