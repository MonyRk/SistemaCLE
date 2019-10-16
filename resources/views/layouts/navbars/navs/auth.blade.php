<!-- Top navbar -->
<div class=" bg-gradient-pantone py-3 py-lg-4 ">
        <div class="container">
            <div class="row  align-items-center" style="resize: both;">
                <div class="navbar navbar-expand-lg" data-toggle="collapse" data-target="#icono">
                    <img src="{{ asset('argon') }}/img/brand/logosep.png" class="img-responsive" HSPACE="10" VSPACE="10">
                    <img src="{{ asset('argon') }}/img/brand/logotecnmblanco1.png" style="" HSPACE="10" VSPACE="10">
                </div>
                <div class="offset-1 ">
                    <img src="{{ asset('argon') }}/img/brand/logotec1.png" class="" HSPACE="10" VSPACE="10">
                    <img src="{{ asset('argon') }}/img/brand/logo11.png" class="" HSPACE="10" VSPACE="10">
                </div>
            </div>
        </div>
    </div>
<nav class="navbar navbar-top navbar-expand-md navbar-light" id="navbar-main">
    
    <div class="container-fluid text-right">
    <!-- End Top navbar -->
        <!-- Brand -->
        <a class="h6 mb-0 mt--3 text-white text-uppercase  d-lg-inline-block" href="">{{ __(' ') }}</a>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold text-white">{{ auth()->user()->name }}</span>
                        </div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Cerrar sesión') }}</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>

