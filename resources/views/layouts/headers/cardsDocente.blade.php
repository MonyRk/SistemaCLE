{{-- DOCENTE --}}
<div class="header bg-gradient-lighter pb-3 pt-5 pt-md-8" @if($usuarioactual->tipo == 'docente')style = "display:block;" @else style="display:none" @endif>
        <div class="container-fluid">
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            @php $docente = App\User::where('users.id',$usuarioactual->id)->leftjoin('personas','personas.curp','=','users.curp_user')->leftjoin('docentes','personas.curp','=','docentes.curp_docente')->get() @endphp                          
                            <a  href="{{ route('editarDocente',$docente[0]->id_docente) }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class=" font-weight-bold mb-0">Actualizar Informaci&oacute;n Personal</span>
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
                                    <a href="{{ route('periodoinscripciones') }}">
                                        <div class="row">
                                            <div class="col">
                                                <span class=" font-weight-bold mb-0">Grupos</span>
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
                                <a href="{{ route('periodoResultados') }}">
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