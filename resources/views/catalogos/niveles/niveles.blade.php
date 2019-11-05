@extends('layouts.app')
@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        
        <div class="col-md pt-3">
                @include('flash-message')
        </div>
    </div>
    <div class="text-right">
            <a href="{{ route('catalogos') }}" class="btn btn-outline-primary btn-sm mt-4">
                <span>
                    <i class="fas fa-reply"></i> &nbsp; Regresar
                </span>
            </a>
        </div>
    <div class="row mt-4">
    <div class="col-xl">
        <div class="card shadow ">
            <div class="card-header border-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="mb-0">{{ __('Niveles') }}</h4>
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-sm btn-white" data-toggle="modal" data-target="#modal-form">{{ __('Agregar ') }}<i class="fas fa-plus-circle"></i></button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush th">
                    <thead class="thead-light">
                        <tr>
                            <th></th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Módulo</th>
                            <th scope="col">Idioma</th>
                            <th scope="col">Eliminar</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($niveles as $nivel)
                        <tr>
                            <th scope="row"></th>
                            <th scope="row">
                                {{ $nivel->nivel }}
                            </th>
                            <th scope="row">
                                {{ $nivel->modulo }}
                            </th>
                            <th>
                                {{ $nivel->idioma }}
                            </th>
                            @php
                                $nivel_en_grupos = App\Grupo::where('nivel_id',$nivel->id_nivel)->get();
                            @endphp
                            @if($nivel_en_grupos->isEmpty())
                                <td>
                                    <a href="" id="nivelid" data-nivelid="{{ $nivel->id_nivel }}" class="text-danger" data-toggle="modal" data-target="#modal-notification" ><i class="far fa-trash-alt"></i></a>
                                </td>
                            @else
                                <td >
                                    <a href="" class="text-primary" data-toggle="modal" data-target="#modal-notification2" ><i class="far fa-question-circle"></i></a>
                                </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br><br>
@include('layouts.footers.nav')
</div>


{{-- modal para crear un nivel --}}
    <div class="col-md-4">
        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-lighter shadow border-0">
                            <div class="card-body px-lg-5 py-lg-5">
                                <div class="text-center text-muted mb-4">
                                    <strong>{{ __('Nuevo Nivel') }}</strong>
                                </div>
    
                                    <form role="form" method="post" action="{{ route('agregarNivel') }}" autocomplete="off">
                                        @csrf
                                        @method('post')
                                        <div class="form-group mb-3">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                                </div>
                                                <input class="form-control" name="nivel" placeholder="Nivel" type="text" value="{{ old('nivel') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                                </div>
                                                <input class="form-control" name="modulo" placeholder="Modulo" type="text" value="{{ old('modulo') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                                </div>
                                                <input class="form-control" name="idioma" placeholder="Idioma" type="text" value="{{ old('idioma') }}">
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="sumbit" class="btn btn-primary my-4">{{ __('Guardar') }}</button>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


{{-- modal para eliminar un nivel --}}

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
                <form action="{{ route('eliminarNivel','test') }}" method="POST" class="delete" id="deleteForm">
                @csrf
                @method('delete')
                <div class="modal-body">
                    
                    <div class="py-3 text-center">
                            <i class="fas fa-times fa-3x" style="color:#CD5C5C;"></i>
                        <h4 class="heading mt-4">¡Da tu confirmaci&oacute;n para Eliminar!</h4>
                        <p>¿Realmente deseas eliminar los datos del nivel?</p>
                        <input type="hidden" name="nivel_id" id="nivel_id" value="">
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
                                        <h6 class="modal-title" id="modal-title-notification">¡Información!</h6>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        
                                    </div>
                                   
                                    <div class="modal-body">
                                        
                                        <div class="py-3 text-center">
                                                <i class="fas fa-exclamation fa-3x text-warning" style=""></i>
                                <h4 class="heading mt-4">Los datos de este nivel no se puede Eliminar</h4>
                                <p>Los datos que contiene estan asociados a otros, si se elimina podr&iacute;a perderse informaci&oacute;n importante adem&aacute;s de generar inconsistencia de datos.</p>
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
            var n_id = button.attr('data-nivelid')
            // console.log(alumn_id)
            var modal = $(this)
            // console.log(modal.find('.modal-body #nivel_id').val(alumn_id));
            modal.find('.modal-body #nivel_id').val(n_id);
        } )
        </script>
       @endsection

@endsection
