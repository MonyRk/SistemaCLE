{{-- SERVICIOS ESCOLARES --}}
<div class="header bg-gradient-lighter pb-3 pt-5 pt-md-8" @if($usuarioactual->tipo == 'escolares')style = "display:block;" @else style="display:none" @endif>
        <div class="container-fluid">
            <div class="col-md">
                @include('flash-message')
            </div>
            <div class="header-body">
                <!-- Card stats -->
                <div class="row">
                    <div class="col-xl-3 col-lg-6">
                        <div class="card card-stats mb-4 mb-xl-0">
                            @php 
                            // $docente = App\User::where('users.id',$usuarioactual->id)->leftjoin('personas','personas.curp','=','users.curp_user')->leftjoin('docentes','personas.curp','=','docentes.curp_docente')->get(); 
                            // $periodo_actual = App\Periodo::where('actual',true)->get();
                            @endphp                          
                            <a  href="{{ route('verUsuarios') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class=" font-weight-bold mb-0">Ver Usuarios</span>
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
                            <a  href="{{ route('agregarCoordinador') }}">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <span class=" font-weight-bold mb-0">Agregar Usuario</span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
                                                <i class="fas fa-user-plus"></i>
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
                </div>
            </div>
        </div>
    </div>
    <br><br>