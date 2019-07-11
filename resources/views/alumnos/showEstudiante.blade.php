@extends('viewsBase.show')
@section('tiutlo')
{{ __('Datos del Estudiante') }}
@endsection

@section('informacion')
<hr class="my-4"/>
    <h6 class="heading-small text-muted mb-4">{{ __('Información Escolar') }}</h6>
    <div>
        <div class="row">
            <div class="col-xl col-lg-6">
                    <div class="card card-stats mb-4 mb-xl">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <span class="card-title">{{ __('Número de Control: ') }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="">
                                    <p class="card-text font-weight-bold">{{ $datos[0]->num_control }}</p>
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
                                    <span class="card-title">{{ __('Carrera: ') }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="">
                                    <p class="card-text font-weight-bold">{{ $datos[0]->carrera }}<p>
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
                                    <span class="card-title">{{ __('Semestre: ') }}</span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="">
                                    <p class="card-text font-weight-bold">{{ $datos[0]->semestre }}</p>
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
