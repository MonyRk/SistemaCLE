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
                     <h3 class="text-dark">{{ _('Docentes') }}</h3>{{-- aqui irá la variable del nombre del modulo en el que se esta --}}
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
            <div class="col-md"></div>
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
                
                Grado de Estudios <br> <br>
                <select id="input-estudios" class="form-control" name="estudios">
                        <option selected></option>
                        <option value="Licenciatura">{{ __('Licenciatura') }}</option>
                        <option value="Maestría">{{ __('Maestría') }}</option>
                        <option value="Doctorado">{{ __('Doctorado') }}</option>
                        </select>

                <br><br>
                Estatus
                <div class="row">     <!-- se deben sustituir los checkbox por cada nivel que haya -->       
                    <div class="col">
                        <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="customCheck5" type="checkbox">
                            <label class="custom-control-label" for="customCheck5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('    Activo') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check form-check-inline custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="customCheck7" type="checkbox">
                            <label class="custom-control-label" for="customCheck7">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('   Inactivo') }}</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <!-- header de la tabla-->
                <div class="col-xl">
                    <div class="card shadow ">
                        <div class="card-header border-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="mb-0">Datos de los Docentes</h4>
                                </div>
                                <div class="col text-right">
                                    <a href="{{ url("/agregarDocente") }}" class="btn btn-sm btn-gray">Agregar
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
                                        <th scope="col">Matricula</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Estatus</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Eliminar</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($datos_docentes as $docente)
                                    <tr>
                                        <th scope="row">
                                            {{ $docente->id_docente }}
                                        </th>
                                        <th>
                                            <a href="">{{ $docente->nombres }} {{ $docente->ap_paterno }} {{ $docente->ap_materno }}</a>
                                        </th>                                      
                                        <td name="name">{{ $docente->grado_estudios }}</td>
                                        <td> <a href="docentes/{{ $docente->id_docente }}/editar"><i class="fas fa-edit"></i></a>
                                        </td>
                                        <td>
                                            <a href="docentes/{{ $docente->id_docente }}/eliminar"><i class="far fa-trash-alt"></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                        
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
@endsection
 
</div>
            
