@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection
@section('content')
    
     <div class="container-fluid m--t">
            <div class="text-right">
                    <a href=" {{ route('catalogos') }} " class="btn btn-outline-primary btn-sm mt-4">
                        <span>
                            <i class="fas fa-reply"></i> &nbsp; Regresar
                        </span>
                    </a>
                </div>
        <div class="row">
            
            <div class="col-md">
                    @include('flash-message')
            </div>
            
            <div class="col-md">
                <div class="">
                    <form action="{{ route('buscarCambios') }}" method="GET" class="navbar-search navbar-search-dark form-inline mr-5 d-none d-md-flex ml-lg-9"  style="margin-top: 15px" >
                        
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
            </div>
        </div>
<br>
        <div class="row">
            <div class="col-xl">
                <div class="col-xl">
                    <div class="card shadow ">
                        <div class="card-header border-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="mb-0">Actualizaciones a Calificaciones</h4>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush th" id="datatable">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" colspan="2">Fecha de Actualizaci&oacute;n</th>
                                        {{-- <th scope="col" rowspan="2">Nombre</th> --}}
                                        <th scope="col" colspan="2">Info. del Estudiante</th>
                                        <th scope="col" colspan="3">Calificaciones Previas</th>
                                        <th scope="col" colspan="3">Calificaciones Actualizadas</th>
                                        <th scope="col" colspan="2">Usuario que Actualiz&oacute;</th>
                                    </tr>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Hora</th>
                                        <th>N&uacute;m. de Control</th>
                                        <th>Nombre</th>
                                        <th scope="col">Parcial 1</th>
                                        <th scope="col">Parcial 2</th>
                                        <th scope="col">Parcial 3</th>
                                        <th scope="col">Parcial 1</th>
                                        <th scope="col">Parcial 2</th>
                                        <th scope="col">Parcial 3</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Cargo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i=0;
                                    @endphp
                                    @foreach ($cambios as $cambio) 
                                    <tr>
                                        <td>
                                            {{ date('d-m-Y',strtotime($cambio->fecha)) }} 
                                        </td>
                                        <td>
                                            {{ date('H:m',strtotime($cambio->hora)) }}
                                        </td>
                                        <td>
                                            {{ $cambio->num_control }}
                                        </td>
                                        <td>
                                            @php
                                                $alumno = App\Alumno::where('num_control',$cambio->num_control)->leftjoin('personas','personas.curp','=','alumnos.curp_alumno')->get();
                                            @endphp
                                            {{ $alumno[0]->ap_paterno }} {{ $alumno[0]->ap_materno }} {{ $alumno[0]->nombres }}
                                        </td>
                                        <td>
                                            @if ($cambio->calif1_previo == null)
                                            0
                                            @else
                                            {{ $cambio->calif1_previo }}
                                            @endif
                                            
                                        </td>
                                        <td>
                                            @if ($cambio->calif2_previo == null)
                                            0
                                            @else
                                            {{ $cambio->calif2_previo }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($cambio->calif3_previo == null)
                                            0
                                            @else
                                            {{ $cambio->calif3_previo }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $cambio->calif1_nuevo }}
                                        </td>
                                        <td>
                                            {{ $cambio->calif2_nuevo }}
                                        </td>
                                        <td>
                                            {{ $cambio->calif3_nuevo }}
                                        </td>
                                        <td>
                                            {{ $cambio->nombres }} {{ $cambio->ap_paterno }} {{ $cambio->ap_materno }}
                                        </td>
                                        <td>
                                            @if ($cambio->tipo == 'coordinador')
                                                Coordinador
                                            @endif
                                            @if ($cambio->tipo == 'escolares')
                                                Servicios Escolares
                                            @endif
                                            @if ($cambio->tipo == 'docente')
                                                Docente
                                            @endif
                                        </td>
                                        @php
                                            $i++;
                                        @endphp
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $cambios->links() }}
                    </div>
                </div>
            </div>
{{-- endsection contenido --}}
            
        </div>
    
</div>

@endsection