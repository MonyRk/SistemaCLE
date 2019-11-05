<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
        <div class="container-fluid">
            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Brand -->
            <a class="navbar-brand pt-0" href="{{ route('home') }}">
                <img src="{{ asset('argon') }}/img/brand/logog.png" class="navbar-brand-img" alt="...">
            </a>
            <!-- User -->
            <ul class="nav align-items-center d-md-none">
                <li class="nav-item dropdown">
                    <a class="nav-link" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="media align-items-center">
                            <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                            </span>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                        <div class=" dropdown-header noti-title">
                            <h6 class="text-overflow m-0">{{ __('Bienvenido!') }}</h6>
                        </div>
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="ni ni-user-run"></i>
                            <span>{{ __('Cerrar sesión') }}</span>
                        </a>
                    </div>
                </li>
            </ul>
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Collapse header -->
                <div class="navbar-collapse-header d-md-none">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="{{ route('home') }}">
                                <img src="{{ asset('argon') }}/img/brand/logog.png">
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Form -->
                <form class="mt-4 mb-3 d-md-none">
                    <div class="input-group input-group-rounded input-group-merge">
                        <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Buscar') }}" aria-label="Buscar">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <span class="fa fa-search"></span>
                            </div>
                        </div>
                    </div>
                </form>
                @php 
                $usuarioactual = \Auth::user();
                $docente = App\User::where('users.id',$usuarioactual->id)->leftjoin('personas','personas.curp','=','users.curp_user')->leftjoin('docentes','personas.curp','=','docentes.curp_docente')->get();
                $periodo_actual = App\Periodo::where('actual',true)->get();
                @endphp
                <!-- Navigation -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="ni ni-tv-2 text-primary"></i> {{ __('Principal') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('editarDocente',$docente[0]->id_docente) }}" >
                            <i class="fas fa-users text-danger" style= "color: danger"></i>{{ __('Información') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('inscripciones').'?periodo='.$periodo_actual[0]->id_periodo }}">
                            <i class="fas fa-user-edit text-green"></i> {{ __('Grupos') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('boletas') }}">
                            <i class="fas fa-check text-info"></i> {{ __('Calificaciones') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('periodoResultados') }}">
                            <i class="fas fa-question text-gray"></i> {{ __('Evaluación Docente') }}
                        </a>
                    </li>                
            </div>
        </div>
    </nav>