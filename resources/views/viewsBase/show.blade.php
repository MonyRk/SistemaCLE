@extends('layouts.app')
@section('sidebar')
    @include('layouts.navbars.sidebar')

@endsection
@section('content')


<div class="container-fluid m--t">
        <div class="text-right">
            <a href=" @yield('regresar') " class="btn btn-outline-primary btn-sm mt-4">
                <span>
                    <i class="fas fa-reply"></i> &nbsp; Regresar
                </span>
            </a>
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
                        <p class="card-text font-weight-bold">
                            @if($datos[0]->calle != null) {{ $datos[0]->calle }}  @endif
                            @if($datos[0]->numero != null) {{ $datos[0]->numero }}  @endif
                            @if($datos[0]->colonia != null) {{ $datos[0]->colonia }}  @endif
                            @if($municipio->isNotEmpty()) {{ $municipio[0] }}  @endif
                            @if($datos[0]->cp != null) {{ $datos[0]->cp }}  @endif
                        </p>
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
                        <p class="card-text font-weight-bold">
                            @if($datos[0]->telefono != null) {{ $datos[0]->telefono }}  @endif
                        <p>
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
                        <p class="card-text font-weight-bold">
                            @if($datos[0]->email != null) {{ $datos[0]->email }}  @endif
                        </p>
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

<br><br>
           @include('layouts.footers.nav')
</div>
@endsection

