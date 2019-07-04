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

        <form method="post" action="@yield('action')" autocomplete="off">
            @csrf
            @method('post')

            <h6 class="heading-small text-muted mb-4">{{ __('Información Personal') }}</h6>
            
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                   
                </div>
            @endif

            <div class="pl-lg-4">
                <div class="row">
                    <div class="col-md">
                        <label class="form-control-label" for="input-name">{{ __('Nombre(s)') }}</label>
                        <input type="text" name="name" id="input-name" class="form-control" placeholder="" value="{{ old('name') }}" >
                    </div>
                    <div class="col-md"> 
                        <label class="form-control-label" for="input-apPaterno">{{ __('Apellido Paterno') }}</label>
                        <input type="text" name="apPaterno" id="input-apPaterno" class="form-control" placeholder="" value="{{ old('apPaterno') }}" >
                    </div>
                    <div class="col-md">
                        <label class="form-control-label" for="input-apMaterno">{{ __('Apellido Materno') }}</label>
                        <input type="text" name="apMaterno" id="input-apMaterno" class="form-control" placeholder="" value="{{ old('apMaterno') }}">
                    </div>
                </div>
                
                <br>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label class="form-control-label" for="input-curp">{{ __('CURP') }}</label>
                        <input type="text" class="form-control" name="curp" id="input-curp" value="{{ old('curp') }}">
                    </div>
                    <div class="form-group col-md-2">
                        <label class="form-control-label" for="input-edad">{{ __('Edad') }}</label>
                        <input type="text" class="form-control" name="edad" id="input-edad" value="{{ old('edad') }}">
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-sexo">{{ __('Sexo') }}</label>
                        <div class="row">            
                            <div class="custom-control custom-radio">
                                <input type="radio" id="sexof" name="sexo" value="F" class="custom-control-input">
                                <label class="custom-control-label" for="sexof">&nbsp&nbsp&nbsp&nbsp&nbspFemenino</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="sexom" name="sexo" value="M" class="custom-control-input">
                                <label class="custom-control-label" for="sexom">&nbsp&nbsp&nbsp&nbsp&nbspMasculino</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-calle">{{ __('Dirección') }}</label>
                        <input type="text" name="calle" id="input-calle" class="form-control" placeholder="Calle" value="{{ old('calle') }}" >
                    </div>
                    <div class="form-group col-md-2">
                            <label class="form-control-label" for="input-numero">{{ __('') }}</label>
                        <input type="text" name="numero" id="input-numero" class="form-control" placeholder="Número" value="{{ old('numero') }}" >
                    </div>
                    <div class="form-group col-md">
                            <label class="form-control-label" for="input-colonia">{{ __(' ') }}</label>
                        <input type="text" name="colonia" id="input-colonia" class="form-control" placeholder="Colonia" value="{{ old('colonia') }}" >
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-municipio">{{ __(' ') }}</label>
                        <select id="input-municipio" class="form-control" name="municipio">
                            <option selected value=""></option>
                                @foreach ($nombres_municipios as $mun)
                                <option value="{{ $mun->id }}">{{ $mun->nombre_municipio }}</option>                             
                                @endforeach
                        </select>                  
                    </div>
                </div>
<br>
                <div class="form-row">
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-telefono">{{ __('Teléfono') }}</label>
                        <input type="text" name="telefono" id="input-telefono" class="form-control" placeholder="" value="{{ old('telefono') }}">
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                        <input type="text" name="email" id="input-email" class="form-control form-control-alternative" placeholder="" value="{{ old('email') }}">
                    </div>
                </div>
                </div>
        
        <hr class="my-4" />

        @yield('nombreTipodeInformacion')

        <div class="pl-lg-4">
            @yield('informacionporTipo')
            
            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-4">{{ __('Guardar') }}</button>
            </div>
            </div>
        </form>
    </div>
</div>
@endsection