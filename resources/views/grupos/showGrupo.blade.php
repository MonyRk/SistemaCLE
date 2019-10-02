@extends('layouts.app')
@section('sidebar')
    @include('layouts.navbars.sidebar')

@endsection
@section('content')


<div class="container-fluid m--t">
        <div class="text-right">
                <a href=" {{ route('verGrupos') }} " class="btn btn-outline-primary btn-sm mt-4">
                    <span>
                        <i class="fas fa-reply"></i> &nbsp; Regresar
                    </span>
                </a>
            </div>
<h6 class="heading-small text-muted mb-4">{{ __('Información General') }}</h6>
<div>
    <div class="row">
    <div class="col-xl col-lg">
        <div class="card card-stats mb-4 mb-xl">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="card-tittle">{{ __('Nombre del Grupo: ') }}</span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="">
                        <p class="card-text font-weight-bold">{{ $datos[0]->grupo }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl col-lg">
        <div class="card card-stats mb-4 mb-xl">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="card-tittle">{{ __('Nivel: ') }}</span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="">
                        <p class="card-text font-weight-bold">{{ $datos[0]->nivel }}{{ $datos[0]->modulo }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl col-lg">
        <div class="card card-stats mb-4 mb-xl">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="card-tittle">{{ __('Modalidad: ') }}</span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="">
                        <p class="card-text font-weight-bold">{{ $datos[0]->modalidad }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-xl col-lg">
        <div class="card card-stats mb-4 mb-xl">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="card-title">{{ __('Aula: ') }}</span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="">  
                        <p class="card-text font-weight-bold">{{ $datos[0]->edificio }}{{ $datos[0]->num_aula }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl col-lg">
        <div class="card card-stats mb-4 mb-xl">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <span class="card-title">{{ __('Hora: ') }}</span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="">
                        <p class="card-text font-weight-bold">{{ $datos[0]->hora }}<p>
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
                        <span class="card-title">{{ __('Cantidad Límite de Estudiantes: ') }}</span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="">  
                        <p class="card-text font-weight-bold">{{ $datos[0]->cupo }}</p>
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
                        <span class="card-title">{{ __('Docente: ') }}</span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="">
                        <p class="card-text font-weight-bold">{{ $docente[0]->nombres }} {{ $docente[0]->ap_paterno }} {{ $docente[0]->ap_materno }}</p>
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
                        <span class="card-title">{{ __('Periodo: ') }}</span>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="">
                        <p class="card-text font-weight-bold">{{ $datos[0]->descripcion }} {{ $datos[0]->anio }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
</div>


<br><br>
        @include('layouts.footers.nav')
</div>
@endsection

