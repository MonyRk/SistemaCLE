@extends('viewsBase.show')

@section('regresar')
{{ route('verDocentes') }}
@endsection

@section('informacion')
<hr class="my-4"/>
    <h6 class="heading-small text-muted mb-4">{{ __('Información Profesional') }}</h6>
    <div>
        <div class="row">
            <div class="col-xl col-lg-6">
                    <div class="card card-stats mb-4 mb-xl">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="card-title">{{ __('Grado de Estudios: ') }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="">
                                    <p class="card-text font-weight-bold">{{ $datos[0]->grado_estudios }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl col-lg-6">
                    <div class="card card-stats mb-4 mb-xl">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="card-title">{{ __('RFC : ') }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="">
                                    <p class="card-text font-weight-bold">{{ $datos[0]->rfc }}<p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl col-lg-6">
                    <div class="card card-stats mb-4 mb-xl">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="card-title">{{ __('Título: ') }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="">
                                    <p class="card-text font-weight-bold">{{ $datos[0]->titulo }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl col-lg-6">
                    <div class="card card-stats mb-4 mb-xl">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="card-title">{{ __('Cédula Profesional: ') }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="">
                                    <p class="card-text font-weight-bold">{{ $datos[0]->ced_prof }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl col-lg-6">
                    <div class="card card-stats mb-4 mb-xl">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="card-title">{{ __('Matrícula: ') }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="">
                                    <p class="card-text font-weight-bold">{{ $datos[0]->id_docente }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl col-lg-6">
                    <div class="card card-stats mb-4 mb-xl">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="card-title">{{ __('Estatus: ') }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="">
                                    <p class="card-text font-weight-bold">{{ $datos[0]->estatus }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    
@endsection
