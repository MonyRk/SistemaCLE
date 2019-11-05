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
    <div class="container-fluid m--t">
        <div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center">
            <div class="col-lg col-md">
                <h4 class="text-dark">Pagos</h4>
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
                <a href="" data-toggle="modal" data-target="#modal-form">
                    <i class="fas fa-money-check-alt fa-5x text-dark"></i>
                   <h5 class="text-dark">Agregar Pago</h5>
                </a>
            </div>
            <div class="col-md-2"></div>
            <div class="col-md-2 text-center">
                <a @if($usuarioactual->tipo == 'coordinador') href="{{ route('verificarPagos') }}" @else href="{{ route('buscarPago') }}" @endif>
                    <i class="fas fa-search-dollar fa-5x text-dark"></i>
                    <h5 class="text-dark">@if($usuarioactual->tipo == 'coordinador') Verificar Pagos @else Ver Historial de Pagos @endif</h5>
                </a>
            </div>
        </div>
        <br><br><br><br><br>
        @include('layouts.footers.nav')
    </div>

{{-- modal para agregar un pago --}}
    <div class="col-md-4">
        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-lighter shadow border-0">
                            <div class="card-body px-lg-5 py-lg-5">
                                <div class="text-center text-muted mb-4">
                                    <strong>{{ __('Agregar Pago') }}</strong>
                                </div>
                                    <form role="form" method="post" action="{{ route('agregarPago') }}" autocomplete="off">
                                        @csrf
                                        @method('post')
                                        @if ($usuarioactual->tipo == 'coordinador')
                                            <div class="form-group mb-3">
                                                <div class="input-group input-group-alternative">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                                    </div>
                                                    <input class="form-control" name="numControl" placeholder="N&uacute;mero de Control" type="text" value="{{ old('numControl') }}">
                                                </div>
                                            </div>
                                        @else
                                        @php
                                            $num_control = App\Alumno::where('curp_alumno',$usuarioactual->curp_user)->select('num_control')->get();
                                        @endphp
                                            <input class="form-control" name="numControl" placeholder="N&uacute;mero de Control" type="hidden" value="{{ $num_control[0]->num_control }}">
                                        @endif
                            
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                                </div>
                                                <input class="form-control" name="folio" placeholder="Folio de Pago" type="text" value="{{ old('folio') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                                </div>
                                                <input class="form-control" name="monto" placeholder="Monto de Pago" type="text" value="{{ old('monto') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                                </div>
                                                <input class="form-control" name="date" placeholder="Fecha (dd/mm/aaaa)" type="text" value="{{ old('date') }}">
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="sumbit" class="btn btn-primary my-4">{{ __('Guardar') }}</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection