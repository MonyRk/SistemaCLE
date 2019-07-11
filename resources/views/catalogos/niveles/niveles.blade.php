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
                        <h3 class="text-dark" style="font-family: 'Soberana Sans'"><br><br><br></h3>{{-- aqui irá la variable del nombre del modulo en el que se esta --}}
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
                            <td>
                                <a href="{{ route('eliminarNivel', [$nivel->id_nivel]) }}"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>




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


@endsection
