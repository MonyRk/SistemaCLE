@extends('layouts.app')
@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection
@section('content')

<div class="header bg-gradient-pantone py-5 py-lg-3">
    <div class="container">
        <div class="header-body text-center mb-2">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-6">
                     <h3 class="text-dark">Estudiantes</h3>
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
    
     <div class="container-fluid">
        <div class="row">
            
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
                
            <div class="col-xl-4">
                {{-- section filtros --}}
                <div class="">         
                    <label class="form-control-label" for="selectnivel">{{ __('Nivel')}}</label>
                        <select name="filtronivel" id="selectnivel" class="form-control">
                            <option selected></option>
                            @foreach ($niveles as $nivel)
                                <option value="{{ $nivel->id }}">{{ $nivel->nivel }}{{ $nivel->modulo }}</option>
                            @endforeach
                        </select>
                </div> <br>
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
                <br>
                <div>
                    <label for="selectestatus" class="form-control-label">{{ __('Estatus') }}</label>
                    <select name="filtroestatus" class="form-control" id="selectestatus">
                        <option selected></option>
                        <option value="Inscrito">Inscrito</option>
                        <option value="No Inscrito">No Inscrito</option>
                    </select>
                </div>
<br>
                <div class="text-center">
                    <button type="button" class="btn btn-outline-pantone">Buscar</button>
                </div>
            </div>
            {{-- endsection filtros --}}

            <div class="col-xl-8">
                <!-- header de la tabla-->
                {{-- section contenido --}}
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
                            <table class="table align-items-center table-flush th" id="datatable">
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
                                    @foreach ($datos_alumnos as $alumno) 
                                    
                                    <tr>
                                        <th scope="row">
                                            {{ $alumno->num_control }}
                                        </th>
                                        <th>
                                            <a href="{{ route('verInfo',$alumno->num_control )}}">{{ $alumno->nombres }} {{ $alumno->ap_paterno }} {{ $alumno->ap_materno }}</a>
                                        </th>
                                        <td name="name">{{ $alumno->estatus }}</td>
                                        <td> <a href="alumnos/{{ $alumno->num_control }}/editar"><i class="fas fa-edit"></i></a>
                                        </td>
                                        <td>
                                            <a href="" id="alumnoid" data-alumnoid="{{ $alumno->num_control }}" data-toggle="modal" data-target="#modal-notification" ><i class="far fa-trash-alt"></i></a>{{-- alumnos/{{ $alumno->num_control }}/eliminar --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>
                        {{ $datos_alumnos->links() }}
                    </div>
                </div>
            </div>
{{-- endsection contenido --}}
            {{-- @include('layouts.footers.auth') --}}
        </div>
    


        


    <div class="col-md-4">
        <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-" role="document">
                <div class="modal-content bg-gradient-white">
                    
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-notification">¡Espera!</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        
                    </div>
                    <form action="{{ route('eliminarAlumno','test') }}" method="POST" class="delete" id="deleteForm">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        
                        <div class="py-3 text-center">
                                <i class="fas fa-times fa-3x" style="color:#CD5C5C;"></i>
                            <h4 class="heading mt-4">¡Da tu confirmaci&oacute;n para Eliminar!</h4>
                            <p>¿Realmente deseas eliminar los datos del alumno?</p>
                            <input type="hidden" name="alumno_id" id="alumno_id" value="">
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-white">S&iacute;, Eliminar</button>
                        <button type="button" class="btn btn-link text-gray ml-auto" data-dismiss="modal">No, Cambi&eacute; de opinion</button> 
                    </div>
                    </form>
                </div>
            </div>
        </div>
            </div>







           @section('script')
           <script>
            $('#modal-notification').on('show.bs.modal', function(event){
                var button = $(event.relatedTarget) //
                var alumn_id = button.attr('data-alumnoid')
                var modal = $(this)
                modal.find('.modal-body #alumno_id').val(alumn_id);
            } )
            </script>
           @endsection
@endsection

</div>

