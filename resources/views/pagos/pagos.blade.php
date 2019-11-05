@extends('layouts.app')

@section('sidebar')
@php
$usuarioactual = \Auth::user();
@endphp
@if ($usuarioactual->tipo == 'coordinador')
@include('layouts.navbars.sidebar')
@else
@include('layouts.navbars.sidebarEstudiantes')
@endif
@endsection

@section('content')
@php
    use Carbon\Carbon;
@endphp
<div class="container-fluid m--t">
    <div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center" >
        <div class="col-lg col-md">
            <h4 class="text-dark">Pagos</h4>
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
    <form action="{{ route('guardarVerificados') }}" method="post">
        @csrf
        @method('post')
        <div class="row mt-3">
            <div class="col-xl">
                <div class="col-xl">
                    <div class="card shadow ">
                        <div class="card-header border-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    Estudiante: <strong class="mb-0">{{ $pagos[0]->nombres }} {{ $pagos[0]->ap_paterno }} @if ($pagos[0]->ap_materno!=null) {{ $pagos[0]->ap_materno }} @endif</strong>                           
                                </div>
                                <div class="col">N&uacute;mero de Control: <strong>{{ $pagos[0]->num_control }}</strong></div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush th" id="datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Folio de Pago</th>
                                        <th scope="col">Monto de Pago</th>
                                        <th scope="col">Fecha</th>
                                        @if ($usuarioactual->tipo == 'coordinador')
                                            <th scope="col">Verificar</th>
                                        @else
                                            <th scope="col">Estatus</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pagos as $pago)
                                        <tr>
                                            <td>
                                                {{ $pago->folio_pago }}
                                            </td>
                                            <td>
                                                {{ $pago->monto_pago }}
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($pago->fecha)) }}
                                            </td>
                                            <td>
                                                @if ($usuarioactual->tipo == 'coordinador')
                                                    @if ($pago->pago_verificado == true)
                                                    <p class="text-success"><i class="fas fa-check"></i> Verificado</p>
                                                    @else
                                                        <div class="custom-control custom-control-alternative custom-checkbox">
                                                            <input class="custom-control-input" id="{{ $pago->folio_pago }}" name="verificado[]" type="checkbox" value="{{ $pago->num_inscripcion }}">
                                                            <label class="custom-control-label" for="{{ $pago->folio_pago }}">o</label>
                                                        </div>
                                                    @endif
                                                @else
                                                    @if ($pago->pago_verificado == true)
                                                        <p class="text-success"><i class="fas fa-check"></i> Verificado</p>
                                                    @else
                                                        <p class="text-danger"><i class="fas fa-times"></i> No Verificado</p>
                                                    @endif
                                                @endif
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
        <div class="text-center" @if ($usuarioactual->tipo != 'coordinador') style = "display:none;" @endif>
            <button type="sumbit" class="btn btn-primary my-4">{{ __('Guardar') }}</button>
        </div>
    </form>
    <br><br>
    @include('layouts.footers.nav')
</div>

@endsection