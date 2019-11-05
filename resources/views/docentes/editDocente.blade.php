@extends('layouts.app')

@section('sidebar')
@php
$usuarioactual = \Auth::user();
@endphp
@if ($usuarioactual->tipo == 'coordinador')
@include('layouts.navbars.sidebar')
@else
@include('layouts.navbars.sidebarDocentes')
@endif
@endsection

@section('content')

<div class="header pb-2 pt-5 pt-lg-8 d-flex align-items-center text-center" >
        <div class="col-lg col-md">
                <h4 class="text-dark">Editar Docente</h4>
            </div>
</div>

    <div class="container-fluid m--t">
            <div class="text-right">
                    <a href="{{ back() }}" class="btn btn-outline-primary btn-sm mt-4">
                        <span>
                            <i class="fas fa-reply"></i> &nbsp; Regresar
                        </span>
                    </a>
                </div>
                <div>
                    @include('flash-message')
                </div>
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

        <form method="post" action="{{ url("docentes/{$docente[0]->id_docente}") }}" autocomplete="off" enctype="multipart/form-data">
            @csrf
            @method('put')

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
                        <input type="text" name="name" id="input-name" class="form-control" placeholder="" value="{{ old('name', $docente[0]->nombres) }}" required autofocus>
                    </div>
                    <div class="col-md">
                        <label class="form-control-label" for="input-apPaterno">{{ __('Apellido Paterno') }}</label>
                        <input type="text" name="apPaterno" id="input-apPaterno" class="form-control" placeholder="" value="{{ old('apPaterno', $docente[0]->ap_paterno) }}" required autofocus>
                    </div>
                    <div class="col-md">
                        <label class="form-control-label" for="input-apMaterno">{{ __('Apellido Materno') }}</label>
                        <input type="text" name="apMaterno" id="input-apMaterno" class="form-control" placeholder="" value="{{ old('apMaterno', $docente[0]->ap_materno) }}" required autofocus>
                    </div>
                </div>
                
                <br>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label class="form-control-label" for="input-curp">{{ __('CURP') }}</label>
                        <input type="text" class="form-control" name="curp" id="input-curp" value="{{ old('curp', $docente[0]->curp) }}" @if($usuarioactual->tipo != 'coordinador') readonly @endif>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="form-control-label" for="input-edad">{{ __('Edad') }}</label>
                        <input type="text" class="form-control" name="edad" id="input-edad" value="{{ old('edad', $docente[0]->edad) }}">
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-sexo" >{{ __('Sexo') }}</label>
                        <div class="row">            
                            <div class="custom-control custom-radio">
                                <input type="radio" id="sexof" name="sexo"  @if($docente[0]->sexo ='F') checked @endif value = {{ old('sexo',$docente[0]->sexo) }} class="custom-control-input">
                                <label class="custom-control-label" for="sexof">&nbsp&nbsp&nbsp&nbsp&nbspFemenino</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="sexom" name="sexo" @if($docente[0]->sexo ='M') checked @endif value = {{ old('sexo',$docente[0]->sexo) }} class="custom-control-input">
                                <label class="custom-control-label" for="sexom">&nbsp&nbsp&nbsp&nbsp&nbspMasculino</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-calle">{{ __('Dirección') }}</label>
                        <input type="text" name="calle" id="input-calle" class="form-control" placeholder="Calle" value="{{ old('calle', $docente[0]->calle) }}" required autofocus>
                    </div>
                    <div class="form-group col-md">
                            <label class="form-control-label" for="input-numero">{{ __('') }}</label>
                        <input type="text" name="numero" id="input-numero" class="form-control" placeholder="Número" value="{{ old('numero', $docente[0]->numero) }}" required autofocus>
                    </div>
                    <div class="form-group col-md">
                            <label class="form-control-label" for="input-colonia">{{ __(' ') }}</label>
                        <input type="text" name="colonia" id="input-colonia" class="form-control" placeholder="Colonia" value="{{ old('colonia', $docente[0]->colonia) }}" required autofocus>
                    </div>
                    <div class="form-group col-md">
                            <label class="form-control-label" for="input-municipio">{{ __(' ') }}</label>
                        <select id="input-municipio" class="form-control" name="municipio">
                            
                                {{ $nm = App\Municipio::select('id','nombre_municipio')->where('id',$docente[0]->municipio)->pluck('nombre_municipio') }}
                            
                        <option selected value="{{ old('municipio', $docente[0]->municipio) }}">{{ $nm[0] }} </option>
                        @forelse ($nombres_municipios as $mun)
                        <option value="{{ $mun }}">{{ $mun }}</option>  
                        @empty
                            
                        @endforelse
                        
                        </select>
                                         
                    </div>
                    <div class="form-group col-md">
                            <label class="form-control-label" for="input-cp">{{ __(' ') }}</label>
                            <input type="text" name="cp" id="input-cp" class="form-control" placeholder="C.P." value="{{ old('cp', $docente[0]->cp) }}" required autofocus>
                        </div> 

                </div>
                <div class="row">
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-telefono">{{ __('Teléfono') }}</label>
                        <input type="text" name="telefono" id="input-telefono" class="form-control" placeholder="" value="{{ old('telefono', $docente[0]->telefono) }}"  >
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder=""value="{{ old('email',$email[0]->email) }}"  >
                    </div>
                </div>
        
        
            </div>

            <hr class="my-4" />
            <h6 class="heading-small text-muted mb-4">{{ __('Información Profesional') }}</h6>
            
            <div class="pl-lg-4">
                    <div class="form-row">  
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="input-estudios">{{ __('Grado de Estudios') }}</label>
                                <input class="form-control" type="text" id="input-estudios" name="estudios" value="{{ old('estudios',$docente[0]->grado_estudios) }}">
                                {{-- <select id="input-estudios" class="form-control" name="estudios">
                                <option value="{{ old('estudios',$docente[0]->grado_estudios) }}"selected>{{ old('estudios',$docente[0]->grado_estudios) }}</option>
                                <option value="Licenciatura">{{ __('Licenciatura') }}</option>
                                <option value="Maestría">{{ __('Maestría') }}</option>
                                <option value="Doctorado">{{ __('Doctorado') }}</option>
                                </select> --}}
                            </div>
                            <div class="form-group col-md" @if($usuarioactual->tipo != 'coordinador')style = "display:none;" @else style="display:block" @endif>
                                <label class="form-control-label" for="input-estatus">{{ __('Estatus') }}</label>
                                <select id="input-estatus" class="form-control" name="estatus">
                                <option value="{{ old('estatus',$docente[0]->estatus) }}" selected>{{ old('estatus',$docente[0]->estatus) }}</option>
                                <option value="Activo">{{ __('Activo') }}</option>
                                <option value="Inactivo">{{ __('Inactivo') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row"  @if($usuarioactual->tipo != 'coordinador')style = "display:none;" @else style="display:block" @endif>
                            <div class="form-group col-md">
                                <label class="form-control-label" for="input-rfc">{{ __('RFC') }}</label>
                                <div class="form-group">
                                    <input type="file" class="form-control-file" id="input-rfc" name="rfc" value="{{ old('rfc',$docente[0]->rfc) }}">
                                    </div>
                             </div>
                            </div>
                             <div class="form-row"  @if($usuarioactual->tipo != 'coordinador')style = "display:none;" @else style="display:block" @endif>
                             <div class="form-group col-md">
                                <label class="form-control-label" for="input-titulo">{{ __('Título') }}</label>
                                <div class="form-group">
                                    <input type="file" class="form-control-file" id="input-titulo" name="titulo" value="{{ old('titulo',$docente[0]->titulo) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-row"  @if($usuarioactual->tipo != 'coordinador')style = "display:none;" @else style="display:block" @endif>
                            <div class="form-group col-md">
                                <label class="form-control-label" for="input-cedula">{{ __('Cédula Profesional') }}</label>
                                {{-- <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="input-cedula" lang="es-ES">
                                    <label class="custom-file-label" for="input-cedula">{{ $docente[0]->ced_prof }}</label>
                                </div> --}}
                                <div class="form-group">
                                    <input type="file" class="form-control-file" id="input-cedula" name="cedula" placeholder="{{ $docente[0]->ced_prof }}" value="{{ $docente[0]->ced_prof }}">
                                </div>
                            </div>
                            
                        </div>
                        <hr class="my-4" />
            <h6 class="heading-small text-muted mb-4">{{ __('Información de Usuario') }}</h6>
            <div class="form-group col-md-3">
                <label class="form-control-label" for="input-contrasenia">{{ __('Reestablecer Contraseña?*') }}</label>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="input-contrasenia" name="contrasenia" onchange="comprobar2(this);" value="true" class="custom-control-input">
                    <label class="custom-control-label" for="input-contrasenia">o</label>
                </div>
            </div>
            <div id="reestablecer-contrasenia" style="display:none;">
                
                <div class="form-group col-xl-4">
                    <label class="form-control-label" for="input-password">{{ __('Nueva Contraseña') }}</label>
                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative" value="" >
                </div>
                <div class="form-group col-xl-4">
                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirmar Nueva Contraseña') }}</label>
                    <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" value="" >
                </div>
            </div>
            <p class="text-muted">*El reestablecimiento de la contraseña no es obligatorio al ver o actualizar otro dato</p>          
        </div>
    </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-4">{{ __('Actualizar') }}</button>
            </div>
        </form>
    </div>

    <script>
            function comprobar2(obj)
            {   
                if (obj.checked){
                    document.getElementById('reestablecer-contrasenia').style.display = "";
                } else{
                    document.getElementById('reestablecer-contrasenia').style.display = "none";
                }     
            }

        </script>

    <br><br>
           @include('layouts.footers.nav')
</div>


@endsection