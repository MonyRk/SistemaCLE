@extends('layouts.app')
@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection
@section('content')

<div class="header bg-gradient-white py-5 py-lg-3">
    <div class="container">
        <div class="header-body text-center mb-2">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                     <h3 class="text-dark">@yield('title')</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="separator separator-bottom separator-skew zindex-100">
        <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
            <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
        </svg>
    </div>
</div>
     {{-- -contenido --}}
     <div class="container-fluid">
        <div class="row">
            <!-- espacio de busqueda-->
            <div class="col-md">
                @include('flash-message')
            </div>
            <div class="col-md">
                <div class="text-right">
                    <form action=" @yield('actionseach') " method="GET" class="navbar-search navbar-search-dark form-inline mr-5 d-none d-md-flex ml-lg-9"  style="margin-top: 15px" >
                        <div class="form-group mb-0">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input class="form-control" placeholder="Buscar" type="text">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4">
               @yield('filtros')
            </div>

            
                @yield('contenido')
            
        </div>
    
@endsection
 
</div>
            
