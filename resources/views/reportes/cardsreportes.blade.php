@extends('layouts.app')

@section('content')
<div class="header bg-gradient-lighter pb-8 pt-0 pt-md-0">
    <div class="container-fluid m--t">
            {{-- <div class="container-fluid m--t"> --}}
                <div>
                    @include('flash-message')
                </div>
                    <div class="text-right">
                        <a href="{{ route('inicio') }}" class="btn btn-outline-primary btn-sm mt-4">
                            <span>
                                <i class="fas fa-reply"></i> &nbsp; Regresar
                            </span>
                        </a>
                    </div>
        <div class="header-body">
            <!-- Card stats -->
            <div class="row mt-4">
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <a href="{{ route('indexestadisticas') }}"><div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="font-weight-bold mb-0">{{ __('Datos Estadísticos') }}</span>
                                </div>
                                <div class="col-auto">
                                    <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                        <i class="far fa-chart-bar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <a href="" data-toggle="modal" data-target="#modal-form2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class=" font-weight-bold mb-0">{{ __('Constancias de Liberación') }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                                            <i class="far fa-file-alt"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="card card-stats mb-4 mb-xl-0">
                        <a href="{{ route('adendum') }}">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <span class=" font-weight-bold mb-0">{{ __('Acuerdos Laborales') }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                            <i class="fas fa-file-signature"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- <br><br> --}}
@include('layouts.footers.nav')
</div>


{{-- modal liberaciones --}}

<div class="col-md-4">
        <div class="modal fade" id="modal-form2" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-lighter shadow border-0">
                            <div class="card-body px-lg-5 py-lg-5">
                                <div class="text-center text-muted mb-4">
                                    <strong>{{ __('Tipo de Liberación') }}</strong>
                                </div>

                                    <form role="form" method="get" action="{{ route('liberaciones') }}" autocomplete="off">
                                       
                                        <div class="form-group mb-3">
                                          <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                                </div>
                                                <select name="liberacion" id="liberacion" class="form-control">
                                                    <option selected>Tipo de Liberaci&oacute;n</option>
                                                    <option value="cle">CLE</option>
                                                    <option value="certificacion">Certificaci&oacute;n</option>
                                                    <option value="habilidades">4 Habilidades</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="sumbit" class="btn btn-primary my-4"><i class="fas fa-arrow-right"></i></button>
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