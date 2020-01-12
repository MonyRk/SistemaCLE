@extends('layouts.app')
@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection
@section('content')
@php
    $periodo_actual = App\Periodo::where('actual',true)->get();
@endphp

    <div class="container-fluid m--t">
        <div class="text-right">
            <a href="{{ route('inicio') }} " class="btn btn-outline-primary btn-sm mt-4">
                <span>
                    <i class="fas fa-reply"></i> &nbsp; Regresar
                </span>
            </a>
        </div>    
        <div class="row">
            <!-- espacio de busqueda-->
            <div class="col-md">
                @include('flash-message')
            </div>
            <div class="col-md">
                <div class="">
                    <div class="text-right">
                        <form action=" {{ route('buscarGrupo') }} " method="GET" class="navbar-search navbar-search-dark form-inline mr-5 d-none d-md-flex ml-lg-9"  style="margin-top: 15px" >
                            <div class="form-group mb-0">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input name="buscar" class="form-control" placeholder="Buscar" type="text">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<br>
            <!-- header de la tabla-->
        <div class="row">    
            <div class="col-xl">
                <div class="col-xl">
                    <div class="card shadow ">
                        <div class="card-header border-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="mb-0">{{ __('Información de los Grupos') }} {{ $periodos->descripcion }} {{ $periodos->anio }}</h4>
                                </div>
                                <div class="col text-right">
                                    <a href="{{ url("/agregarGrupo") }}" class="btn btn-sm btn-gray">Crear
                                        <i class="fas fa-plus-circle"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush th">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Grupo</th>
                                        <th scope="col">Nivel</th>{{--viene nivel y modulo --}}
                                        <th scope="col">Idioma</th>
                                        <th scope="col">Aula</th>
                                        <th scope="col">Hora</th>
                                        <th scope="col">Docente</th>
                                        {{-- <th scope="col">Periodo</th> --}}
                                        <th scope="col">Modalidad</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grupos as $grupo)
                                    <tr>
                                        <th scope="row" >
                                           <a class="text-dark" href="{{ route('verInfoGrupo',$grupo->id_grupo) }}"> {{ $grupo->grupo }}</a>
                                        </th>
                                        <th>
                                            {{ $grupo->nivel }}{{ $grupo->modulo }}
                                        </th>
                                        <td>
                                            {{ $grupo->idioma }}
                                        </td>
                                        <td>
                                            {{ $grupo->edificio }}{{ $grupo->num_aula }}
                                        </td>
                                        <td>
                                            {{ $grupo->hora }}
                                        </td>
                                        <td>
                                            {{ $grupo->nombres }} {{ $grupo->ap_paterno }} @if ( $grupo->ap_materno != null ) {{ $grupo->ap_materno }} @endif
                                        </td>
                                        {{-- <td>
                                            {{ $grupo->descripcion }} {{ $grupo->anio }}
                                        </td> --}}
                                        <td>
                                            {{ $grupo->modalidad }}
                                        </td>
                                        @if ($periodo_actual[0]->id_periodo == $grupo->id_periodo)
                                            <td class="text-center"> 
                                                <a href="grupos/{{ $grupo->id_grupo }}/editar" class="text-primary"  ><i class="fas fa-edit"></i></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="" class="text-danger" id="grupoid" data-grupoid="{{ $grupo->id_grupo }}" data-toggle="modal" data-target="#modal-notification" ><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        @else 
                                            <td colspan="2" class="text-center">
                                                <a href="" class="text-primary" data-toggle="modal" data-target="#modal-notification2" ><i class="far fa-question-circle"></i></a>
                                            </td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $grupos->links() }}
                    </div>
                </div>
            </div>
        </div>
<br><br>
        @include('layouts.footers.nav')
    </div> 





    <div class="col-md-4">
        <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-notification">¡Espera!</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        
                    </div>
                    <form action="{{ route('eliminarGrupo','test') }}" method="POST" class="delete" id="deleteForm">
                    @csrf
                    @method('delete')
                    <div class="modal-body">
                        
                        <div class="py-3 text-center">
                                <i class="fas fa-times fa-3x" style="color:#CD5C5C;"></i>
                            <h4 class="heading mt-4">¡Da tu confirmaci&oacute;n para Eliminar!</h4>
                            <p>¿Realmente deseas eliminar este grupo?</p>
                            <input type="hidden" name="grupo_id" id="grupo_id" value="">
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-outline-danger">S&iacute;, Eliminar</button>
                        <button type="button" class="btn btn-link text-gray ml-auto" data-dismiss="modal">No, Cambi&eacute; de opinion</button> 
                    </div>
                    </form>
                </div>
            </div>
        </div>

            </div>



            {{-- modal para informar que ya no se puede hacer nada --}}
            <div class="col-md-4">
                    <div class="modal fade" id="modal-notification2" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-" role="document">
                            <div class="modal-content">
                                
                                <div class="modal-header">
                                    <h6 class="modal-title" id="modal-title-notification">¡Espera!</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    
                                </div>
                               
                                <div class="modal-body">
                                    
                                    <div class="py-3 text-center">
                                            <i class="fas fa-exclamation fa-3x text-warning" style=""></i>
                            <h4 class="heading mt-4">Este grupo no se puede Eliminar y/o Editar</h4>
                            <p>Los datos que contiene son de un periodo diferente al actual, si se elimina o se edita podr&iacute;a perderse informaci&oacute;n importante adem&aacute;s de generar inconsistencia de datos.</p>
                                        <input type="hidden" name="grupo_id" id="grupo_id" value="">
                                    </div>
                                    
                                </div>
                                
                                <div class="modal-footer">
                                    {{-- <button type="submit" class="btn btn-outline-warning">Entendido</button> --}}
                                    <button type="button" class="btn btn-outline-warning ml-auto" data-dismiss="modal">Entendido</button> 
                                </div>
                            </div>
                        </div>
                    </div>
            
                        </div>


           @section('script')
           <script>
            $('#modal-notification').on('show.bs.modal', function(event){
                var button = $(event.relatedTarget) //
                // console.log(button)
                var group = button.attr('data-grupoid')
                // console.log(group)
                var modal = $(this)
                // console.log(modal.find('.modal-body #grupo_id').val(group));
                modal.find('.modal-body #grupo_id').val(group);
            } )
            </script>
           @endsection


@endsection
 



