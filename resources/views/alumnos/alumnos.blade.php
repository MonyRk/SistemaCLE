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
                     <h3 class="text-dark">Estudiantes</h3>{{-- aqui irá la variable del nombre del modulo en el que se esta --}}
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
                <div class="">
                    <form class="navbar-search navbar-search-dark form-inline mr-5 d-none d-md-flex ml-lg-9"  style="margin-top: 15px" >
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
                <!-- filtros de busqueda -->
            <div class="col-xl-4">
                Nivel <br> <br>
                <div class="row">     <!-- se deben sustituir los checkbox por cada nivel que haya -->       
                    <div class="col">
                        <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="customCheck5" type="checkbox">
                            <label class="custom-control-label" for="customCheck5">1</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check form-check-inline custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="customCheck7" type="checkbox">
                            <label class="custom-control-label" for="customCheck7">3</label>
                        </div>
                    </div>
                </div>
                <div>
                    <label class="form-control-label" for="input-filtrocarrera">{{ __('Carrera') }}</label>
                    <select id="input-filtrocarrera" class="form-control" name="filtrocarrera">
                    <option selected></option>
                    <option value="Ingeniería Eléctrica">{{ __('Ing. Eléctrica') }}</option>
                    <option value="Ingeniería Electrónica">{{ __('Ing. Electrónica') }}</option>
                    <option value="Ingeniería Civil">{{ __('Ing. Civil') }}</option>
                    <option value="Ingeniería Mecánica">{{ __('Ing. Mecánica') }}</option>
                    <option value="Ingeniería Industrial">{{ __('Ing. Industrial') }}</option>
                    <option value="Ingeniería Química">{{ __('Ing. Química') }}</option>
                    <option value="Ingeniería en Gestión Empresarial">{{ __('Ing. Gestión Empresarial') }}</option>
                    <option value="Ingeniería en Sist. Computacionales">{{ __('Ing. Sistemas Computacionales') }}</option>
                    <option value="Licenciatura en Administración">{{ __('Lic. Administración') }}</option>
                    </select>
                </div>
                <br><br>

                Idioma <br><br>
                    <select name="idioma" id="idioma">    </select>

                <br><br>

                 Grupo <br> estatus <br> pago <br>
            </div>

            <div class="col-xl-8">
                <!-- header de la tabla-->
                <div class="col-xl">
                    <div class="card shadow ">
                        <div class="card-header border-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="mb-0">Datos de los Estudiantes</h4>
                                </div>
                                <div class="col text-right">
                                    <a href="{{ route('agregarAlumno') }}" class="btn btn-sm btn-gray">Agregar
                                        <i class="fas fa-user-plus"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush th">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Número <br> de Control</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Estatus</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Eliminar</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($datos_alumnos as $alumno)
                                    <tr>
                                        <th scope="row">
                                            {{ $alumno->num_control }}
                                        </th>
                                        <th>
                                            <a href="">{{ $alumno->nombres }} {{ $alumno->ap_paterno }} {{ $alumno->ap_materno }}</a>
                                        </th>
                                        <td name="name">{{ $alumno->estatus }}</td>
                                        <td> <a href="alumnos/{{ $alumno->num_control }}/editar"><i class="fas fa-edit"></i></a>
                                        </td>
                                        <td>
                                            <a href="alumnos/{{ $alumno->num_control }}/eliminar"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- @include('layouts.footers.auth') --}}
        </div>
    
@endsection

{{-- @push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush --}}

 
</div>
            
