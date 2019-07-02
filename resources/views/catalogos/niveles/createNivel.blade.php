@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')
<div class="header pb-5 pt-5 pt-lg-8 d-flex align-items-center" >
    </div>
        
        <div class="container-fluid m--t">
            <div class="card-body ">
                @if ($errors->any())
                    <p>No pudimos agregar los datos, <br> por favor, verifica la información</p>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </ul>                            
                @endif
    
<div class="col-md-4">
    <button type="button" class="btn btn-block btn-white" data-toggle="modal" data-target="#modal-form"><i class="fas fa-plus-circle"></i></button>
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