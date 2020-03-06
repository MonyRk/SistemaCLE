@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')
<div class="container-fluid m--t">
        <div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center">
            <div class="col-lg col-md">
                <h4 class="text-dark"></h4>
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
            <a href="{{ route('reportes') }}" class="btn btn-outline-primary btn-sm mt-2">
                <span>
                    <i class="fas fa-reply"></i> &nbsp; Regresar
                </span>
            </a>
        </div>
        <form action="{{ route('contratos') }}" method="GET">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 text-center">
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-docente">{{ __('Docente') }}</label>
                        <select id="input-docente" class="form-control" name="docente">
                            <option ></option>
                            @foreach ($docentes as $docente)
                                <option value="{{ $docente->id_docente }}">{{ $docente->nombres }} {{ $docente->ap_paterno }} @if ($docente->ap_materno) {{ $docente->ap_materno }} @endif</option> 
                            @endforeach
                        </select> 
                    </div>
                    <div class="col-lg-4"></div>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-3">
                    <label class="form-control-label" for="input-idioma">{{ __('Idioma a Impartir') }}</label>
                    <input type="text" name="idioma" id="input-idioma" class="form-control" placeholder="" value="{{ old('idioma') }}">
                </div> 
                <div class="form-group col-md-3">
                    <label class="form-control-label" for="input-nivel">{{ __('Nivel a Impartir') }}</label>
                    <input type="text" name="nivel" id="input-nivel" class="form-control" placeholder="" value="{{ old('nivel') }}">
                </div> 
                <div class="form-group col-md-3">
                    <label class="form-control-label" for="input-rfc">{{ __('RFC') }}</label>
                    <input type="text" name="rfc" id="input-rfc" class="form-control" placeholder="" value="{{ old('rfc') }}">
                </div> 
                <div class="form-group col-md-3">
                    <label class="form-control-label" for="input-titulo">{{ __('Título') }}</label>
                    <input type="text" name="titulo" id="input-titulo" class="form-control" placeholder="" value="{{ old('titulo') }}">
                </div>                          
            </div> 
            <div class="row">
                <div class="form-group col-md-3">
                    <label class="form-control-label" for="input-fecha_pago">{{ __('Fecha de Pago') }}</label>
                    <input type="text" name="fecha_pago" id="input-fecha_pago" class="form-control" placeholder="01 de octubre de 2019" value="{{ old('fecha_pago') }}">
                </div>  
                <div class="form-group col-md-3">
                    <label class="form-control-label" for="input-importe">{{ __('Importe a Pagar') }}</label>
                    <input type="text" name="importe" id="input-importe" class="form-control" placeholder="0,000" value="{{ old('importe') }}">
                </div> 
                <div class="form-group col-md-3">
                    <label class="form-control-label" for="input-inicio">{{ __('Fecha de Inicio') }}</label>
                    <input type="text" name="inicio" id="input-inicio" class="form-control" placeholder="01 de octubre de 2019" value="{{ old('inicio') }}">
                </div>
                <div class="form-group col-md-3">
                        <label class="form-control-label" for="input-fin">{{ __('Fecha Final') }}</label>
                        <input type="text" name="fin" id="input-fin" class="form-control" placeholder="01 de octubre de 2019" value="{{ old('fin') }}">
                    </div>                           
            </div>                
                    
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-4">Generar Adendum</button>
            </div>
                
                
        </form>
        <br><br><br><br>
        @include('layouts.footers.nav')
    </div>
    
    
@endsection