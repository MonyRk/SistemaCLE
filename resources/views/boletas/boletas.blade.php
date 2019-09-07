@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')
<div class="container-fluid m--t">
    <div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center" >
        <div class="col-lg col-md">
            <h4 class="text-dark">Calificaciones</h4>
        </div>
    </div>
    <div class="card-body">
        {{-- @include('flash-message') --}}
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
        
        <a href="{{ route('boletas') }}" class="btn btn-outline-primary mt-4">
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
                        <option selected value="{{ old('periodo') }}">{{ old('periodo') }}</option>
                        @foreach ($periodos as $periodo)
                            <option value="{{ $periodo->id_periodo }}">{{ $periodo->descripcion }} {{ $periodo->anio }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md">
                    <label class="form-control-label" for="input-grupo">{{ __('Grupos') }}</label>
                    <select  id="input-grupo" class="form-control" name="grupo">
                        {{-- @foreach ($grupos as $grupo)
                            <option value="{{ $grupo->id_grupo }}">{{ $grupo->grupo }}</option>
                        @endforeach --}}
                    </select>
                </div>
            </div>
        </form>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-lg mt-4"><span><i class="fas fa-arrow-right"></i></span></button>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
</div>



@section('script')
<script>
    var $jq = jQuery.noConflict();
    $jq(document).ready(function(){
        $jq('#input-periodo').on('change',function(){
            var id_periodo_seleccionado = $jq(this).val();
            if ($jq.trim(id_periodo_seleccionado) != ''){
                $jq.get('boletaGrupo',{id_periodo: id_periodo_seleccionado},function(grupos){
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