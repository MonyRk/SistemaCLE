@extends('layouts.app', ['class' => 'bg-gradient-pantone'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
            <div>
                    @include('flash-message')
                </div><br>
        <div class="row justify-content-center">
            
            <div class="col-lg-5 col-md-7">
                <div class="card bg-white shadow border-0">
                    <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center mt-3 mb--3"><strong>{{ __('Ingresa tu usuario') }}</strong></div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <div class="text-center text-muted mb-4">
                        </div>
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group{{ $errors->has('curp_user') ? ' has-danger' : ''}} mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('curp_user') ? ' is-invalid' : '' }}" placeholder="{{ __('CURP') }}" type="text" name="curp_user" value="{{ old('curp') }}" autofocus>
                                </div>
                                @if ($errors->has('curp_user'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('curp_user') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Contraseña') }}" type="password" value="secret" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customCheckLogin">
                                    <span class="text-muted">&nbsp&nbsp&nbsp&nbsp&nbsp{{ __('Recordarme') }}</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Iniciar') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6 text-right">
                        <a href="{{ route('agregarEstudiante') }}" class="text-light">
                            <small>{{ __('Crear cuenta nueva') }}</small>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
