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
                        {{-- <span class="avatar avatar-sm rounded-circle"> --}}
                            <span class="mb-0 text-sm  font-weight-bold text-black">{{ auth()->user()->name }}</span>{{-- <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg"> --}}
                        {{-- </span> --}}
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    {{-- <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Bienvenido!') }}</h6>
                    </div> --}}
                    {{-- <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('Mi perfil') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>{{ __('Configuración') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-calendar-grid-58"></i>
                        <span>{{ __('Actividad') }}</span>
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ni ni-support-16"></i>
                        <span>{{ __('Soporte') }}</span>
                    </a> --}}
                    <div class="dropdown-divider"></div>
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
            {{-- <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Buscar') }}" aria-label="Buscar">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation --> --}}
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">
                        <i class="ni ni-tv-2 text-primary"></i> {{ __('Principal') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('verEstudiantes') }}" >
                        <i class="fas fa-users text-danger" style= "color: danger"></i>{{ __('Estudiantes') }}</span>
                    </a>

                    
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('verDocentes') }}">
                        <i class="fas fa-chalkboard-teacher text-orange"></i> {{ __('Docentes') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('verGrupos') }}">
                        <i class="fas fa-list-ol text-yellow"></i>{{ __('Grupos') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('indexpagos') }}">
                        <i class="fas fa-receipt text-dark"></i>{{ __('Pagos') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('periodoinscripciones') }}">
                        <i class="fas fa-user-edit text-green"></i> {{ __('Inscripciones') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cursos') }}">
                        <i class="fas fa-layer-group text-purple"></i> {{ __('Cursos') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('boletas') }}">
                        <i class="fas fa-check text-info"></i> {{ __('Calificaciones') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('inicioEvaluacion') }}">
                        <i class="fas fa-question text-gray"></i> {{ __('Evaluación Docente') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('reportes') }}">
                        <i class="fas fa-percent text-primary"></i> {{ __('Reportes') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('catalogos') }}">
                        <i class="far fa-clipboard text-pink"></i> {{ __('Catálogos') }}
                    </a>
                </li>
                
            </ul>
            <!-- Divider >
            <hr class="my-3"-->
            
        </div>
    </div>
</nav>