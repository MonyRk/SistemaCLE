@extends('layouts.app')

@section('sidebar')
@php
$usuarioactual = \Auth::user();
@endphp
@if ($usuarioactual->tipo == 'coordinador')
@include('layouts.navbars.sidebar')
@endif
@if ($usuarioactual->tipo == 'alumno')
@include('layouts.navbars.sidebarEstudiantes')
@endif
@if ($usuarioactual->tipo == 'docente')
@include('layouts.navbars.sidebarDocentes')
@endif
@endsection

@section('content')
<div class="container-fluid m--t">
    <div class="card-body">
        @include('flash-message')
        @if ($errors->any())
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                </ul>  
            </div> 
        @endif
    </div>

    <div class="text-right">
        
        <a href="{{ route('inicioEvaluacion') }}" class="btn btn-outline-primary mt-4">
            <span>
                <i class="fas fa-reply"></i> &nbsp; Regresar
            </span>
        </a>
    </div>  
    @if ($usuarioactual->tipo == 'docente')
        @php
            $docente = App\Docente::where('docentes.curp_docente',$usuarioactual->curp_user)
                                    ->leftjoin('users','users.curp_user','=','docentes.curp_docente')
                                    ->get();
        @endphp
    @endif
    <form action="{{ route('verResultados') }}" method="GET">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4 text-center">
                <div class="row">
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-periodo">{{ __('Selecciona un Periodo') }}</label>
                        <select id="input-periodo" class="form-control" name="periodo">
                            @foreach ($periodos as $periodo)
                                <option value="{{ $periodo->id_periodo }}" @if($periodo->actual == true) selected @endif>{{ $periodo->descripcion }} {{ $periodo->anio }}</option>
                            @endforeach
                        </select>                  
                    </div>
                </div>
                <div class="row" @if ($usuarioactual->tipo != 'coordinador') style="display:none;" @endif>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-docente">{{ __('Selecciona un Docente') }}</label>
                        <select id="input-docente" class="form-control" name="docente">
                            <option selected value=""></option>
                            @foreach ($docentes as $docente)
                                <option value="{{ $docente->curp_docente }}">{{ $docente->nombres }} {{ $docente->ap_paterno }} @if($docente->ap_materno) {{ $docente->ap_materno }} @endif</option>
                            @endforeach
                        </select>                  
                    </div>
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
    
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-4"><i class="fas fa-arrow-right"></i></button>
            </div>
            
        </form>
        
        <br><br>
        @include('layouts.footers.nav')
</div>

@endsection