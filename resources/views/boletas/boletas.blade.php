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
    <div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center" >
        <div class="col-lg col-md">
            <h4 class="text-dark">Calificaciones</h4>
        </div>
    </div>
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
        
        <a href="{{ route('boletas') }}" class="btn btn-outline-primary btn-sm mt-4">
            <span>
                <i class="fas fa-reply"></i> &nbsp; Regresar
            </span>
        </a>
    </div>

    <form action="{{ route('verBoleta','grupo') }}" method="GET">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4 text-center">
                <div class="row">
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-periodo">{{ __('Periodo') }}</label>
                        <select  id="input-periodo" class="form-control" name="periodo">
                           @if($usuarioactual->tipo != 'alumno')<option selected value="{{ old('periodo') }}"></option> @endif
                            @foreach ($periodos as $periodo)
                                <option value="{{ $periodo->id_periodo }}" @if($usuarioactual->tipo == 'alumno' && $periodo->actual == true) selected @endif>{{ $periodo->descripcion }} {{ $periodo->anio }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row" @if ($usuarioactual->tipo == 'alumno') style="display:none;" @else style="display:block;" @endif>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-grupo">{{ __('Grupos') }}</label>
                        <select  id="input-grupo" class="form-control" name="grupo">
                            {{-- @foreach ($grupos as $grupo)
                                <option value="{{ $grupo->id_grupo }}">{{ $grupo->grupo }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-lg-4"></div>
        </div>
        {{-- <input type="hidden" name="usuarioactual" value="{{ \Auth::user() }}"> --}}
            
        <div class="text-center">
            <button type="submit" class="btn btn-primary btn-lg mt-4"><span><i class="fas fa-arrow-right"></i></span></button>
        </div>
    </form>
    <br><br>
    @include('layouts.footers.nav')
</div>



@section('script')
@if($usuarioactual->tipo == 'docente') 
    {{ $query='boletaGrupos' }}
{{-- @endif  --}}
{{-- @if($usuarioactual->tipo == 'alumno') 
    {{ $query='boletaAlumno' }} 
@endif --}}
{{-- @if($usuarioactual->tipo == 'coordinador') --}}
@else
   {{ $query='boletaGrupo' }} 
@endif
<script>
    var $jq = jQuery.noConflict();
    $jq(document).ready(function(){
        $jq('#input-periodo').on('change',function(){
            var id_periodo_seleccionado = $jq(this).val();
            if ($jq.trim(id_periodo_seleccionado) != ''){
                $jq.get('<?php echo($query) ?>',{id_periodo: id_periodo_seleccionado},function(grupos){
                    $jq('#input-grupo').empty();
                    $jq('#input-grupo').append("<option value=''></option>");
                    $jq.each(grupos, function(index, value){ 
                                $jq('#input-grupo').append("<option value='"+ index +"'>"+ value +"</option>");
                    });
                });
            }
        });
    });
    </script>
@endsection
@endsection