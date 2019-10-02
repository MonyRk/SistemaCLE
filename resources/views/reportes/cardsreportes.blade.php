@extends('layouts.app')

@section('content')
<div class="header bg-gradient-lighter pb-8 pt-0 pt-md-0"><br><br>
    <div class="container-fluid m--t">
            {{-- <div class="container-fluid m--t"> --}}
                    <div class="text-right">
                        <a href="{{ route('inicio') }}" class="btn btn-outline-primary btn-sm mt-4">
                            <span>
                                <i class="fas fa-reply"></i> &nbsp; Regresar
                            </span>
                        </a>
                    </div>
        <div class="header-body">
            <!-- Card stats -->
            <div class="row mt-4">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <a href="{{ route('estadisticas') }}"><div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="font-weight-bold mb-0">{{ __('Datos Estadísticos') }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="far fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <a href="{{ route('verAulas') }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class=" font-weight-bold mb-0">{{ __('Constancias') }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                                            <i class="far fa-file-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <a href="{{ route('periodos') }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class=" font-weight-bold mb-0">{{ __('Acuerdos Laborales') }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                            <i class="fas fa-file-signature"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                {{-- <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <a href="{{ route('respuestas') }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class=" font-weight-bold mb-0">{{ __('Respuestas Evaluacion') }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                                            <i class="far fa-check-square"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> --}}
            </div>
            
        </div>
    </div>
</div>
<br><br>
@include('layouts.footers.nav')

@endsection