<div class="mt-4"> @include('flash-message') </div>
{{-- ESTUDIANTE --}}
<div class="header bg-gradient-lighter pb-3 pt-5 pt-md-8" @if($usuarioactual->tipo == 'alumno')style = "display:block;" @else style="display:none" @endif>
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                        {{-- <div class="col-xl-2 col-lg-6"></div> --}}
                    <div class="col-xl-4 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            @php 
                            $alumno = App\User::where('users.id',$usuarioactual->id)
                                    ->leftjoin('personas','personas.curp','=','users.curp_user')
                                    ->leftjoin('alumnos','personas.curp','=','alumnos.curp_alumno')
                                    ->get();
                            $periodo_actual = App\Periodo::where('actual',true)->first(); 
                            @endphp                         
                            <a href="{{ route('editarEstudiante',$alumno[0]->num_control) }}" >
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class=" font-weight-bold mb-0">Ver o Actualizar Informaci&oacute;n</span>
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
                    <div class="col-xl-4 col-lg-6">
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
                    <div class="col-xl-4 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <a href="{{ route('inscribirAlumno',$alumno[0]->num_control) }}">{{--<a href="{{ route('periodoinscripciones') }}"> --}}
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
                </div>
                <br><br>
                <div class="row">
                    <div class="col-xl-4 col-lg-6">
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
                    <div class="col-xl-4 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <a href="{{ route('avance').'?numControl='.$alumno[0]->num_control }}">
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
                    <div class="col-xl-4 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            <div class="card-body">
                                <a href="{{ route('evaluacion').'?periodo='.$periodo_actual->id_periodo }}">
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
            </div>
        </div>
    </div>
    <br><br>