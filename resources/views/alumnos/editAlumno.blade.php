@extends('layouts.app')
@section('sidebar')
@php
$usuarioactual = \Auth::user();
@endphp
@if ($usuarioactual->tipo == 'coordinador')
@include('layouts.navbars.sidebar')
@else
@include('layouts.navbars.sidebarEstudiantes')
@endif
@endsection

@section('content')

    {{-- editar alumno --}}
    <div class="container-fluid m--t">
        <div class="text-right">
            <a   @if ($usuarioactual->tipo == 'coordinador')
                href=" {{ route('verEstudiantes') }} "
                @else
                href=" {{ route('home') }} "
                @endif   
                class="btn btn-outline-primary btn-sm mt-4">
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
                    {{-- <strong>No pudimos agregar los datos, <br> por favor, verifica la información</strong> --}}
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

        <form method="post" action="{{ route('actualizarEstudiante',$datos_alumno[0]->num_control) }}" autocomplete="off">
            @csrf
            @method('put')

            <h6 class="heading-small text-muted mb-4">{{ __('Información Personal') }}</h6>
            
            <p class="text-muted">La informaci&oacute;n proporcionada en &eacute;sta p&aacute;gina web ser&aacute; utilizada para fines 
                    acad&eacute;micos y s&oacute;lo por la Coordinaci&oacute;n de Lenguas Extranjeras.</p>
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                   
                </div>
            @endif

            <div class="pl-lg-4">
                <div class="row">
                    <div class="col-md">
                        <label class="form-control-label" for="input-name"><b style="color:red;">*</b>{{ __('Nombre(s)') }}</label>
                        <input type="text" name="name" id="input-name" class="form-control" placeholder="" value="{{ old('name', $datos_alumno[0]->nombres) }}" required autofocus>
                    </div>
                    <div class="col-md">
                        <label class="form-control-label" for="input-apPaterno"><b style="color:red;">*</b>{{ __('Apellido Paterno') }}</label>
                        <input type="text" name="apPaterno" id="input-apPaterno" class="form-control" placeholder="" value="{{ old('apPaterno', $datos_alumno[0]->ap_paterno) }}" required autofocus>
                    </div>
                    <div class="col-md">
                        <label class="form-control-label" for="input-apMaterno">{{ __('Apellido Materno') }}</label>
                        <input type="text" name="apMaterno" id="input-apMaterno" class="form-control" placeholder="" value="{{ old('apMaterno', $datos_alumno[0]->ap_materno) }}" autofocus>
                    </div>
                </div>
                
                <br>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label class="form-control-label" for="input-curp"><b style="color:red;">*</b>{{ __('CURP') }}</label>
                        <input type="text" class="form-control" name="curp" id="input-curp" value="{{ old('curp', $datos_alumno[0]->curp) }}" onkeyup="this.value = this.value.toUpperCase();"
                        @if ($usuarioactual->tipo != 'coordinador') readonly  @endif>
                    </div>
                    <div class="form-group col-md-2">
                        <label class="form-control-label" for="input-edad"><b style="color:red;">*</b>{{ __('Edad') }}</label>
                        <input type="text" class="form-control" name="edad" id="input-edad" value="{{ old('edad', $datos_alumno[0]->edad) }}">
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-sexo" ><b style="color:red;">*</b>{{ __('Sexo') }}</label>
                        <div class="row">            
                            <div class="custom-control custom-radio">
                                <input type="radio" id="sexof" name="sexo"  @if($datos_alumno[0]->sexo == 'F') checked @endif value = {{ old('sexo',$datos_alumno[0]->sexo) }} class="custom-control-input">
                                <label class="custom-control-label" for="sexof">&nbsp&nbsp&nbsp&nbsp&nbspFemenino</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="sexom" name="sexo" @if($datos_alumno[0]->sexo == 'M') checked @endif value = {{ old('sexo',$datos_alumno[0]->sexo) }} class="custom-control-input">
                                <label class="custom-control-label" for="sexom">&nbsp&nbsp&nbsp&nbsp&nbspMasculino</label>
                            </div>
                        </div>
                    </div>
                </div>
                <label class="form-control-label">{{ __('Dirección') }}</label>
                <div class="row">
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-calle">{{ __('Calle') }}</label>
                        <input type="text" name="calle" id="input-calle" class="form-control"  value="{{ old('calle', $datos_alumno[0]->calle) }}"  >
                    </div>
                    <div class="form-group col-md">
                            <label class="form-control-label" for="input-numero">{{ __('Número') }}</label>
                        <input type="text" name="numero" id="input-numero" class="form-control" value="{{ old('numero', $datos_alumno[0]->numero) }}" >
                    </div>
                    <div class="form-group col-md">
                            <label class="form-control-label" for="input-colonia">{{ __('Colonia') }}</label>
                        <input type="text" name="colonia" id="input-colonia" class="form-control" value="{{ old('colonia', $datos_alumno[0]->colonia) }}">
                    </div>
                    <div class="form-group col-md">
                            <label class="form-control-label" for="input-municipio">{{ __('Municipio') }}</label>
                        <select id="input-municipio" class="form-control" name="municipio">
                            
                                {{ $nm = App\Municipio::select('id','nombre_municipio')->where('id',$datos_alumno[0]->municipio)->pluck('nombre_municipio') }}
                            
                                @if ($datos_alumno[0]->municipio == null) <option selected value="">Municipio </option> @else <option selected value="{{ old('municipio', $datos_alumno[0]->municipio) }}">{{ $nm[0] }} </option> @endif
                        @if($datos_alumno[0]->municipio != null){{ $nm[0] }} @endif
                        </option>
                        @foreach ($nombres_municipios as $mun)
                        <option value="{{ $mun }}">{{ $mun }}</option>  
                        @endforeach
                        
                        </select>                  
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-cp">{{ __('C. P.') }}</label>
                    <input type="text" name="cp" id="input-cp" class="form-control" value="{{ old('cp', $datos_alumno[0]->cp) }}" >
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-telefono">{{ __('Teléfono') }}</label>
                        <input type="text" name="telefono" id="input-telefono" class="form-control" placeholder="" value="{{ old('telefono', $datos_alumno[0]->telefono) }}">
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder="" value="{{ old('email',$email) }}" >
                    </div>
                </div>
        
        
            </div>

            <hr class="my-4" />
            <h6 class="heading-small text-muted mb-4">{{ __('Información Escolar') }}</h6>
            
            <div class="pl-lg-4">
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="form-control-label" for="input-numControl"><b style="color:red;">*</b>{{ __('Número de Control') }}</label>
                    <input type="text" name="numControl" id="input-numControl" class="form-control" placeholder="" value="{{ old('numControl', $datos_alumno[0]->num_control) }}"
                    @if ($usuarioactual->tipo != 'coordinador') readonly  @endif >
                </div>
                <div class="form-group col-md-6">
                    <label class="form-control-label" for="input-carrera"><b style="color:red;">*</b>{{ __('Carrera') }}</label>
                    <select id="input-carrera" class="form-control" name="carrera" value="{{ old('carrera', $datos_alumno[0]->carrera) }}">
                    <option selected value="{{ old('carrera', $datos_alumno[0]->carrera) }}">{{ old('carrera', $datos_alumno[0]->carrera) }}</option>
                    <option value="Ingeniería Eléctrica">{{ __('Ing. Eléctrica') }}</option>
                    <option value="Ingeniería Electrónica">{{ __('Ing. Electrónica') }}</option>
                    <option value="Ingeniería Civil">{{ __('Ing. Civil') }}</option>
                    <option value="Ingeniería Mecánica">{{ __('Ing. Mecánica') }}</option>
                    <option value="Ingeniería Industrial">{{ __('Ing. Industrial') }}</option>
                    <option value="Ingeniería Química">{{ __('Ing. Química') }}</option>
                    <option value="Ingeniería en Gestión Empresarial">{{ __('Ing. Gestión Empresarial') }}</option>
                    <option value="Ingeniería en Sistemas Computacionales">{{ __('Ing. Sistemas Computacionales') }}</option>
                    <option value="Licenciatura en Administración">{{ __('Lic. Administración') }}</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                        <label class="form-control-label" for="input-semestre"><b style="color:red;">*</b>{{ __('Semestre') }}</label>
                        <select  id="input-semestre" class="form-control" name="semestre">
                        <option selected value="{{ old('semestre', $datos_alumno[0]->semestre) }}">{{ old('semestre', $datos_alumno[0]->semestre) }}</option>
                            @for ($i = 1; $i <= 16; $i++)
                                <option value="{{ $i }}">{{ ($i) }}</option>
                            @endfor 
                        </select>
                </div>
            </div>
            <div class="form-row" @if($usuarioactual->tipo == 'alumno') style="display:none;" @endif>
                <div class="form-group col-md-3">
                    <label class="form-control-label" for="examen">{{ __('Examen de Ubicación') }}</label>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" id="examen" name="examen" onchange="comprobar(this);" value="true" class="custom-control-input" @if($datos_alumno[0]->nivel_inicial) checked @endif>
                        <label class="custom-control-label" for="examen">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Realiz&oacute; examen</label>
                    </div>
                </div>
                <div class="form-group col-md-3" id="inicial" @if($datos_alumno[0]->nivel_inicial == null) style="display:none" @endif>
                    <label class="form-control-label" for="input-nivel">{{ __('Nivel Donde Inicia') }}</label>
                    <select id="input-nivel" class="form-control" name="nivel">
                        <option selected value="{{ $datos_alumno[0]->nivel_inicial }}">{{ $datos_alumno[0]->nivel_inicial }}</option>
                            @foreach ($niveles as $nivel)
                                <option value="{{ $nivel->nivel }}{{ $nivel->modulo }}">{{ $nivel->nivel }}{{ $nivel->modulo }}&nbsp;-&nbsp; {{ $nivel->idioma }}</option>                             
                            @endforeach
                    </select>                  
                </div> 
            </div> 
            {{-- <div class="form-row">
                <div class="form-group col-md-3" id="folio" {{ style="display:none" }}>
                    <label for="foliopago" class="form-control-label"> {{ __('Folio de Pago') }}</label>
                    <input type="text" name="foliopago" id="foliopago" class="form-control" placeholder=""  value="{{ old('foliopago') }}">
                </div>
                <div class="form-group col-md-3" id="monto" {{ style="display:none" }}>
                    <label for="foliopago" class="form-control-label"> {{ __('Monto de Pago') }}</label>
                    <input type="text" name="monto" id="monto" class="form-control" placeholder=""  value="{{ old('monto') }}">
                </div>
            </div> --}}
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
        <script>
            function comprobar(obj)
            {   
                if (obj.checked){
                    document.getElementById('inicial').style.display = "";
                } else{
                    document.getElementById('inicial').style.display = "none";
                }     
            }

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
<b style="color:red;">*</b><span class="text-muted">Campos Obligatorios</span>
        <div class="text-center">
            <button type="submit" class="btn btn-primary mt-4">{{ __('Actualizar') }}</button>
        </div>
        </form>
        <br><br>
           @include('layouts.footers.nav')
    </div>
</div>
@endsection