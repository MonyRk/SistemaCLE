@extends('layouts.app')
@section('sidebar')
    @include('layouts.navbars.sidebar')

@endsection
@section('content')

<div class="header bg-gradient-pantone py-5 py-lg-3">
    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</div>
<div class="container">
    <div class="header-body text-center mb-2">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-6">
                    <h3 class="text-dark">@yield('titulo')</h3>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid m--t">
        <div class="text-right">
                <a href="{{ route('verAlumnos') }}" class="btn btn-primary mt-4">Regresar</a>
            </div>
<h6 class="heading-small text-muted mb-4">{{ __('Información Personal') }}</h6>
<div>
    <div class="row">
    <div class="col-xl col-lg-6">
        <div class="card card-stats mb-4 mb-xl">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="card-tittle">{{ __('Nombre: ') }}</span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="">
                        <p class="card-text font-weight-bold">{{ $datos[0]->nombres }} {{ $datos[0]->ap_paterno }} {{ $datos[0]->ap_materno }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl col-lg-6">
        <div class="card card-stats mb-4 mb-xl">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="card-tittle">{{ __('CURP: ') }}</span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="">
                        <p class="card-text font-weight-bold">{{ $datos[0]->curp }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl col-lg-6">
        <div class="card card-stats mb-4 mb-xl">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="card-title">{{ __('Dirección: ') }}</span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="">  
                        <p class="card-text font-weight-bold">{{ $datos[0]->calle }} {{ $datos[0]->numero }}, {{ $datos[0]->colonia }}, {{ $municipio[0]->nombre_municipio }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl col-lg-6">
        <div class="card card-stats mb-4 mb-xl">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="card-title">{{ __('Teléfono: ') }}</span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="">
                        <p class="card-text font-weight-bold">{{ $datos[0]->telefono }}<p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>       
<div class="row">
    <div class="col-xl-6 col-lg-6">
        <div class="card card-stats mb-4 mb-xl">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="card-title">{{ __('Email: ') }}</span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="">
                        <p class="card-text font-weight-bold"> email</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl col-lg-6">
        <div class="card card-stats mb-4 mb-xl">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="card-title">{{ __('Edad: ') }}</span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="">
                        <p class="card-text font-weight-bold">{{ $datos[0]->edad }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl col-lg-6">
        <div class="card card-stats mb-4 mb-xl">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="card-title">{{ __('Sexo: ') }}</span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="">
                        <p class="card-text font-weight-bold">
                            @if ($datos[0]->sexo ='F')
                                {{ __('Femenino') }}
                            @else
                                {{ __('Masculino') }}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<div>
    @yield('informacion')
</div>


</div>
@endsection

