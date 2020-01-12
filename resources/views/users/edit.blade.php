@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebarEscolares')
@endsection
@section('content')
    {{-- @include('users.partials.header', ['title' => __('Editar Usuario')])    --}}
    <div class="text-right">
        <a href=" {{ back() }} " class="btn btn-outline-primary btn-sm mt-4">
            <span>
                <i class="fas fa-reply"></i> &nbsp; Regresar
            </span>
        </a>
    </div>
    <div class="container-fluid mt-4">
        <div>
            @include('flash-message')
            @if ($errors->any())
            <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>	
                    <strong>No pudimos agregar los datos, <br> por favor, verifica la información</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li> {{ $error }}</li>
                        @endforeach
                    </ul>  
                </div>    
             
            @else 
            @if(session()->has('message'))
                <div class="alert alert-success">
                     {{ session()->get('message') }}
                </div>
            @endif                           
            @endif
        </div>
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-lighter shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Editar Usuario') }}</h3>
                            </div>
                            {{-- <div class="col-4 text-right">
                                <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">{{ __('Regresar a lista') }}</a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('actualizarUsuario') }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Informacion del usuario') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-row">
                                    <div class="col-md">
                                        <label class="form-control-label" for="input-name">{{ __('Nombre(s)') }}</label>
                                        <input type="text" name="name" id="input-name" class="form-control form-control-alternative" placeholder="" value="{{ old('name',$user->name) }}"  autofocus>
                                    </div>
                                    <div class="col-md">
                                        <label class="form-control-label" for="input-apPaterno">{{ __('Apellido Paterno') }}</label>
                                        <input type="text" name="apPaterno" id="input-apPaterno" class="form-control form-control-alternative" placeholder="" value="{{ old('apPaterno',$user->ap_paterno) }}"  >
                                    </div>
                                    <div class="col-md">
                                        <label class="form-control-label" for="input-apMaterno">{{ __('Apellido Materno') }}</label>
                                        <input type="text" name="apMaterno" id="input-apMaterno" class="form-control form-control-alternative" placeholder="" value="{{ old('apMaterno',$user->ap_materno) }}" >
                                    </div>
                                </div><br>
                                <div class="form-row">
                                    <div class="form-group col-md">
                                        <label class="form-control-label" for="input-curp">{{ __('CURP') }}</label>
                                        <input readonly type="text" class="form-control form-control-alternative" name="curp" id="input-curp" value="{{ old('curp',$user->curp) }}" onkeyup="this.value = this.value.toUpperCase();" >
                                    </div>
                                    <div class="form-group col-md">
                                        <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder="" value="{{ old('email',$user->email) }}" >
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
                                <div class="form-group col-md">
                                        <label class="form-control-label" for="input-estatus">{{ __('Estatus') }}</label>
                                        <select id="input-estatus" class="form-control form-control-alternative" name="estatus">
                                            <option selected @if($user->deleted_at == null) value="activo" @else value="inactivo" @endif>@if($user->deleted_at == null) {{ 'Activo' }} @else {{ 'Inactivo' }} @endif</option>
                                                <option value="activo">Activo</option>  
                                                <option value="inactivo">Inactivo</option>                            
                                        </select>                  
                                    </div>
                                
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