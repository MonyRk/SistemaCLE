{{-- <div>
    @include('flash-message')
</div> --}}
{{-- COORDINADOR --}}
@if($usuarioactual->tipo == 'escolares') @include('layouts.headers.cardsEscolares')@endif
@if($usuarioactual->tipo == 'docente') @include('layouts.headers.cardsDocente') @endif
@if($usuarioactual->tipo == 'alumno') @include('layouts.headers.cardsEstudiante') @endif
@if($usuarioactual->tipo == 'coordinador') 
<div class="header bg-gradient-lighter pb-3 pt-5 pt-md-8" @if($usuarioactual->tipo != 'coordinador')style = "display:none;" @else style="display:block" @endif>
            
    <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <a href="{{ route('verEstudiantes')}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class="font-weight-bold mb-0">Estudiantes</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                                <i class="fas fa-users"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <a href="{{ route('verDocentes')}}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class=" font-weight-bold mb-0">Docentes</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                                                <i class="fas fa-chalkboard-teacher"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <a href="{{ route('indexGrupos') }}">
                                    <div class="row">
                                        <div class="col">
                                            <span class=" font-weight-bold mb-0">Grupos</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                                <i class="fas fa-list-ol"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <a href="{{ route('indexpagos') }}">
                                    <div class="row">
                                        <div class="col">
                                            <span class=" font-weight-bold mb-0">Pagos</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-dark text-white rounded-circle shadow">
                                                <i class="fas fa-receipt"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <a href="{{ route('periodoinscripciones') }}">
                                    <div class="row">
                                        <div class="col">
                                            <span class=" font-weight-bold mb-0">Inscripciones</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-green text-white rounded-circle shadow">
                                                <i class="fas fa-user-edit"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <a href="{{ route('cursos') }}">
                                    <div class="row">
                                        <div class="col">
                                            <span class=" font-weight-bold mb-0">Avance</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-purple text-white rounded-circle shadow">
                                                <i class="fas fa-layer-group"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <a href="{{ route('boletas') }}">
                                    <div class="row">
                                        <div class="col">
                                            <span class=" font-weight-bold mb-0">Calificaciones</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                                <i class="fas fa-check"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <a href="{{ route('inicioEvaluacion') }}">
                                    <div class="row">
                                        <div class="col">
                                            <span class=" font-weight-bold mb-0">Evaluación Docente</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-gray text-white rounded-circle shadow">
                                                <i class="fas fa-question"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-xl-3"></div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <a href="{{ route('reportes') }}">
                                    <div class="row">
                                        <div class="col">
                                            <span class="font-weight-bold mb-0">Reportes</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-primary text-white rounded-circle shadow">
                                                <i class="fas fa-percent"></i>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <a href="{{ route('catalogos') }}">
                                    <div class="row">
                                        <div class="col">
                                            <span class=" font-weight-bold mb-0">{{ __('Catálogos') }}</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-pink text-white rounded-circle shadow">
                                                <i class="far fa-clipboard"></i>
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
    </div>
    <br><br>
    @endif