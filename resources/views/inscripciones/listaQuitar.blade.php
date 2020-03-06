@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')
<div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center" >
    <div class="col-lg col-md">
        <h4 class="text-dark">Grupo {{ $grupo[0]->grupo }} {{ $grupo[0]->nivel }}{{ $grupo[0]->modulo }}</h4>
        <h6 class="text-dark">{{ $grupo[0]->edificio }}{{ $grupo[0]->aula }} {{ $grupo[0]->hora }}</h6>
        <h6 class="text-dark">{{ $periodo_actual[0]->descripcion }} {{ $periodo_actual[0]->anio }}</h6>   
    </div>
</div>
    <div class="container-fluid m--t"> 
        <div class="text-right">
            <a href="{{ route('periodoinscripciones') }}" class="btn btn-outline-primary btn-sm mt-4">
                <span>
                    <i class="fas fa-reply"></i> &nbsp; Regresar
                    <input type="hidden" name="periodo" value="{{ $grupo[0]->periodo }}">
                </span>
            </a>
        </div>
        <div class="row">
           
            <div class="col-md">
                    {{-- @include('flash-message') --}}
            </div>
            
        </div>
        <div class="card-body">
            @include('flash-message')
        </div>
        <div class="pl-lg-4"> @php $nivel =  $grupo[0]->nivel.$grupo[0]->modulo @endphp
            <form method="post" action="{{ route('modificarLista') }}" autocomplete="off">
                @csrf
                @method('post')
                <input type="hidden" name="grupo" value="{{ $grupo[0]->id_grupo }}">
                <input type="hidden" name="periodo" value="{{ $grupo[0]->periodo }}">
                <input type="hidden" name="cupo" value="{{ $grupo[0]->cupo }}">
                <div class="row">
<div class="col-xl">
        <div class="card shadow" >
            <div class="card-header border-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h6 class="heading-small text-muted mb-4">{{ __('Estudiantes Inscritos') }}</h6>
                    </div>
                    
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center table-flush th" id="datatable2">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Núm.</th>
                            <th scope="col">Número <br> de Control</th>
                            <th scope="col">Nombre</th>
                            {{-- <th scope="col">Carrera</th> --}}
                            <th scope="col">Quitar de <br> la lista</th>
                        </tr>
                    </thead>
                    <tbody>@php ($i=1)
                        @foreach ($alumnos_en_el_grupo as $ag)
                        <tr>
                        <th scope="row">
                           {{ $i }}
                        </th>
                        <th scope="row">
                            {{ $ag->num_control }}
                        </th>
                        <th scope="row">
                            {{ $ag->ap_paterno }} @if ($ag->ap_materno != null ) {{ $ag->ap_materno }} @endif {{ $ag->nombres }} 
                        </th>
                        <td scope="row">
                                <div class="custom-control custom-control-alternative custom-checkbox">
                                        <input class="custom-control-input" id="{{ $ag->num_control }}" name="quitar[]" type="checkbox" value="{{ $ag->num_control }}">
                                        <label class="custom-control-label" for="{{ $ag->num_control }}">o</label>
                                    </div>
                            <span>
                                {{-- <input type="checkbox" class="custom-control-input" name="quitar[]" value="{{ $ag->num_control }}">     --}}
                            </span>{{-- <span id="alumnoid" class="quitar" data-alumnoid="{{ $ag->num_control }}" data-nombre="{{ $ag->nombres }} {{ $ag->ap_paterno }} {{ $ag->ap_materno }}"><i class="fas fa-times"></i></span> --}}
                        </td>
                        {{-- <input type="hidden" id="array" name="id[]" value="{{ $ag->num_control }}"> --}}
                        </tr>@php ($i++)
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="text-center">
                <button type="submit" class="btn btn-primary mt-4" id="guardar">{{ __('Modificar Lista') }}</button>
            </div>
    </div>
    
</form>

    </div>
    </div>
@endsection
    