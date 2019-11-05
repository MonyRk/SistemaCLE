@extends('layouts.app')

@section('sidebar')
@php
$usuarioactual = \Auth::user();
@endphp
@if ($usuarioactual->tipo == 'coordinador')
@include('layouts.navbars.sidebar')
@endif
@if ($usuarioactual->tipo == 'docente')
@include('layouts.navbars.sidebarDocentes')
@endif
@endsection


@section('content')
<style>.col-med {
        width: 50%;
        word-wrap: break-word;
        /* border-collapse: collapse; */
    }</style>
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
    <div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center" >
            <div class="col-lg col-md">
                <h6 class="text-dark">Resultados Evaluaci&oacute;n Docente Periodo {{ $periodo[0]->descripcion }} {{ $periodo[0]->anio }}</h6>
                <h4 class="text-dark">{{ $docente[0]->nombres }}{{ $docente[0]->ap_paterno }} @if ( $docente[0]->ap_materno ) {{ $docente[0]->ap_materno }} @endif</h4>
            </div>
            
        </div>
        <div class="text-right mb-2">
            <a href=" {{ route('inicio') }} " class="btn btn-outline-primary btn-sm mt-3">
                <span>
                    <i class="fas fa-reply"></i> &nbsp; Regresar
                </span>
            </a>
        </div> 
        
        {{-- <form method="post" action="{{ route('guardarCalificaciones') }}" autocomplete="off">
            @csrf
            @method('post') --}}
            {{-- <input type="hidden" name="grupo" value="{{ $infoGrupo[0]->id_grupo }}"> --}}
            {{-- <input type="hidden" name="periodo" value="{{ $infoGrupo[0]->periodo }}"> --}}
            <div class="row">    
                <div class="col-xl">
                    <div class="col-xl">
                        <div class="card shadow ">
                            <div class="table-responsive">
                                <table id="tabledata" class="table align-items-center table-flush th">
                                    <thead class="thead-light">
                                        <tr class="card-header">
                                            <th class="text col-med">Pregunta </th>
                                            @foreach ($datos_respuesta as $respuesta)
                                            <th class="text">{{ $respuesta->respuesta }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody> @php $k=0 @endphp
                                        @foreach ($datos_pregunta as $pregunta)
                                            <tr>
                                                <th>
                                                    {{ $pregunta->pregunta }}
                                                </th>
                                                @foreach ($datos_respuesta as $respuesta)
                                                    <th>
                                                        {{ $resultados[$k] }}
                                                    </th>
                                                    @php $k++ @endphp
                                                @endforeach
                                            </tr>
                                        @endforeach
                                       {{-- @for ($i = 0; $i < count($datos_pregunta); $i++)
                                       <tr>
                                            <th>{{ $datos_pregunta[$i]->pregunta }}<th>
                                           @for ($j = 0; $j < count($datos_respuesta); $j++)
                                                <th>{{ $resultados[$k] }}<th>
                                                    @php $k++ @endphp
                                           @endfor
                                           
                                       </tr>
                                       @endfor --}}
                                            
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="text-center" @if($usuarioactual->tipo=='alumno') style="display:none" @else style="display:block" @endif>
                <button type="submit" id="guardar" class="btn btn-primary mt-4">Guardar</button>
            </div> --}}
        </form>
    
    <br><br>
    @include('layouts.footers.nav')
</div>

@endsection