@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection
@section('content')
    
     <div class="container-fluid m--t">
            <div class="text-right">
                    <a href=" {{ back() }} " class="btn btn-outline-primary btn-sm mt-4">
                        <span>
                            <i class="fas fa-reply"></i> &nbsp; Regresar
                        </span>
                    </a>
                </div>
        <div class="row">
            
            <div class="col-md">
                    @include('flash-message')
            </div>
            
            {{-- <div class="col-md">
                <div class="">
                    <form action="{{ route('buscarEstudiante') }}" method="GET" class="navbar-search navbar-search-dark form-inline mr-5 d-none d-md-flex ml-lg-9"  style="margin-top: 15px" >
                        
                        <div class="form-group mb-0">
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search"></i></span>
                                </div>
                                <input name='buscar' class="form-control" placeholder="Buscar" type="text" >
                            </div>
                        </div>
                    </form> 
                </div>
            </div> --}}
        </div>

        <div class="row">
    

            <div class="col-xl">
                <!-- header de la tabla-->
                {{-- section contenido --}}
                <div class="col-xl">
                    <div class="card shadow ">
                        <div class="card-header border-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="mb-0">Estudiantes Deshabilitados</h4>
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
                                        <th scope="col">Restaurar</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datos_alumnos as $alumno) 
                                        <tr>
                                            <th scope="row">
                                                {{ $alumno->num_control }}
                                            </th>
                                            <th scope="row">
                                                {{ $alumno->nombres }} {{ $alumno->ap_paterno }} {{ $alumno->ap_materno }}
                                            </th>
                                            {{-- <td scope="row"> <a href="{{ route('recuperar',$alumno->curp_alumno) }}" class="text-primary"><i class="fas fa-edit"></i></a>
                                            </td> --}}
                                            <td scope="row">
                                                <a href="" id="alumnoid" data-alumnoid="{{ $alumno->curp_alumno }}" class="text-danger" data-toggle="modal" data-target="#modal-notification" >
                                                    <i class="fas fa-undo-alt text-info"></i>
                                                </a>{{-- alumnos/{{ $alumno->num_control }}/eliminar --}}
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
                    <form action="{{ route('recuperar','test') }}" method="get" class="delete" id="deleteForm">
                    {{-- @csrf
                    @method('get') --}}
                    <div class="modal-body">
                        
                        <div class="py-3 text-center">
                                <i class="fas fa-exclamation fa-3x" style="color:#11cdef;"></i>
                            <h4 class="heading mt-4">¡Recuperar&aacute;s la informaci&oacute;n del estudiante!</h4>
                            <p>¿Realmente deseas restaurar los datos del estudiante?<br>
                                Esto le dara acceso nuevamente al estudiante, y este podra realizar los procesos permitidos,
                            adem&aacute;s de que se mostrar&aacute; su informaci&oacute;n nuevamente en las secciones respectivas.</p>
                            <input type="hidden" name="alumno_id" id="alumno_id" value="">
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-info">S&iacute;, Recuperar</button>
                        <button type="button" class="btn btn-link text-gray ml-auto" data-dismiss="modal">Cancelar</button> 
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
                // console.log(button)
                var alumn_id = button.attr('data-alumnoid')
                console.log(alumn_id)
                var modal = $(this)
                // console.log(modal.find('.modal-body #alumno_id').val(alumn_id));
                modal.find('.modal-body #alumno_id').val(alumn_id);
            } )
            </script>
           @endsection
           <br><br>
           @include('layouts.footers.nav')
@endsection

</div>

