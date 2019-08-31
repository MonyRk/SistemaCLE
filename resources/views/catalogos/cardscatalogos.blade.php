@extends('layouts.app')

@section('content')
<div class="header bg-gradient-lighter pb-8 pt-0 pt-md-0"><br><br>
    <div class="container-fluid m--t">
            {{-- <div class="container-fluid m--t"> --}}
                    <div class="text-right">
                        <a href="{{ route('inicio') }}" class="btn btn-primary mt-4">
                            <span>
                                <i class="fas fa-reply"></i> &nbsp; Regresar
                            </span>
                        </a>
                    </div>
        <div class="header-body">
            <!-- Card stats -->
            <div class="row">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <a href="{{ route('verNiveles') }}"><div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="font-weight-bold mb-0">{{ __('Niveles') }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="fas fa-cubes"></i>
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
                                        <span class=" font-weight-bold mb-0">{{ __('Aulas') }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                                            <i class="fas fa-chalkboard"></i>
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
                                        <span class=" font-weight-bold mb-0">{{ __('Periodos') }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                            <i class="fas fa-user-clock"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection