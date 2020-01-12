@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')
@php
    use Carbon\Carbon;
@endphp
<div class="container-fluid m--t">
    <div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center" >
        <div class="col-lg col-md">
            <h4 class="text-dark">Exámenes de Ubicaci&oacute;n Periodo: {{ $periodo_actual[0]->descripcion }} {{ $periodo_actual[0]->anio }}</h4>
        </div>
    </div>
    <div class="card-body">
        @include('flash-message')
    </div>

    <div class="text-right">
        
        <a href="{{ back() }}" class="btn btn-outline-primary btn-sm mt-4">
            <span>
                <i class="fas fa-reply"></i> &nbsp; Regresar
            </span>
        </a>
    </div>
    <form action="{{ route('verificarExamenes') }}" method="post">
        @csrf
        @method('post')
        <div class="row mt-3">
            <div class="col-xl">
                <div class="col-xl">
                    <div class="card shadow ">
                        <div class="card-header border-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h5>Exámenes Registrados</h5>{{-- <strong class="mb-0"></strong>                            --}}
                                </div>
                                {{-- <div class="col">N&uacute;mero de Control: <strong>{{ $pagos[0]->num_control }}</strong></div> --}}
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush th" id="datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Número de <br>Control</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Nivel</th>
                                        <th scope="col">Verificar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alumnos_ubicados as $alumno)
                                        <tr>
                                            <td>
                                                {{ $alumno->num_control }}
                                            </td>
                                            <td>
                                                {{ $alumno->nombres }} {{ $alumno->ap_paterno }} @if ($alumno->ap_materno) {{ $alumno->ap_materno }} @endif
                                            </td>
                                            <td>
                                                {{ $alumno->nivel_inicial }}
                                            </td>
                                            <td>
                                                <div class="custom-control custom-control-alternative custom-checkbox">
                                                    <input class="custom-control-input" id="{{ $alumno->num_control }}" name="verificado[]" type="checkbox" value="{{ $alumno->num_control }}">
                                                    <label class="custom-control-label" for="{{ $alumno->num_control }}">E</label>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="sumbit" class="btn btn-primary my-4">{{ __('Guardar Verificados') }}</button>
        </div>
    </form>
    <br><br>
    @include('layouts.footers.nav')
</div>

@endsection