@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebarEscolares')
@endsection
@section('content')
    {{-- @include('users.partials.header', ['title' => __('Añadir Usuario')])    --}}

    <div class="container-fluid mt-4">
            <div class="card-body">
                    @include('flash-message')
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            
                <div class="text-right">
                    <a href="{{ back() }}" class="btn btn-outline-primary btn-sm mt-1">
                        <span>
                            <i class="fas fa-reply"></i> &nbsp; Regresar
                        </span>
                    </a>
                </div>
        <div class="row mt-4">
            <div class="col-xl-2"></div>
            <div class="col-xl-8 order-xl-1">
                <div class="card bg-lighter shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Agregar Usuario') }}</h3>
                            </div>
                            
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('guardarUsuario') }}" autocomplete="off">
                            @csrf
                            
                            <h6 class="heading-small text-muted mb-4">{{ __('Informacion de usuario') }}</h6>
                            <div class="pl-lg-4">
                                {{-- <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-name">{{ __('Nombre') }}</label>
                                    <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Nombre') }}" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div> --}}
                                <div class="form-row">
                                    <div class="col-md">
                                        <label class="form-control-label" for="input-name">{{ __('Nombre(s)') }}</label>
                                        <input type="text" name="name" id="input-name" class="form-control form-control-alternative" placeholder="" value="{{ old('name') }}"  autofocus>
                                    </div>
                                    <div class="col-md">
                                        <label class="form-control-label" for="input-apPaterno">{{ __('Apellido Paterno') }}</label>
                                        <input type="text" name="apPaterno" id="input-apPaterno" class="form-control form-control-alternative" placeholder="" value="{{ old('apPaterno') }}"  >
                                    </div>
                                    <div class="col-md">
                                        <label class="form-control-label" for="input-apMaterno">{{ __('Apellido Materno') }}</label>
                                        <input type="text" name="apMaterno" id="input-apMaterno" class="form-control form-control-alternative" placeholder="" value="{{ old('apMaterno') }}" >
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-md">
                                        <label class="form-control-label" for="input-curp">{{ __('CURP') }}</label>
                                        <input type="text" class="form-control form-control-alternative" name="curp" id="input-curp" value="{{ old('curp') }}" onkeyup="this.value = this.value.toUpperCase();" data-toggle="tooltip" data-placement="bottom" title="Aseg&uacute;rate de escribir la CURP correctamente, no se podr&aacute; modificar despu&eacute;s.">
                                    </div>
                                    <div class="form-group col-md">
                                        <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder="" value="{{ old('email') }}" >
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password">{{ __('Contraseña') }}</label>
                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative" placeholder="" value="" >
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirmar Contraseña') }}</label>
                                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="" value="" >
                                </div>
                                <input type="hidden" name="tipo" value="coordinador">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary mt-4">{{ __('Guardar') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection