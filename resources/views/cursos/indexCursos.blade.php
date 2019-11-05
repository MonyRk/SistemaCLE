@extends('layouts.app')

@section('sidebar')
@include('layouts.navbars.sidebar')
@endsection

@section('content')
    <div class="container-fluid m--t">
        <div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center">
            <div class="col-lg col-md">
                <h4 class="text-dark">Cursos</h4>
            </div>
        </div>
        <div class="card-body">
            @include('flash-message')
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    
        <div class="text-right">
            <a href="{{ route('inicio') }}" class="btn btn-outline-primary btn-sm mt-1">
                <span>
                    <i class="fas fa-reply"></i> &nbsp; Regresar
                </span>
            </a>
        </div>

        <div class="row mt-5">
            <div class="col-md-3"></div>
            <div class="col-md-2 text-center">
                <a href="{{ route('mostrarExamen') }}" >
                    <i class="fas fa-clipboard-check fa-5x text-dark"></i>
                    <h5 class="text-dark">Verificar Examenes de Ubicaci&oacute;n</h5>
                </a>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2 text-center">
                <a href="{{ route('buscarCurso') }}"><i class="fas fa-sort-amount-up fa-5x text-dark"></i>
                <h5 class="text-dark">Ver Avance</h5>
                </a>
            </div>
        </div>
        <br><br><br><br><br>
        @include('layouts.footers.nav')
    </div>
@endsection