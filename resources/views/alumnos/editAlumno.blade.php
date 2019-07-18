@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')

    {{-- editar alumno --}}
    <div class="container-fluid m--t">
        <div class="text-right">
            <a href=" {{ route('verEstudiantes') }} " class="btn btn-primary mt-4">
                <span>
                    <i class="fas fa-reply"></i> &nbsp; Regresar
                </span>
            </a>
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

        <form method="post" action="{{ route('actualizarEstudiante',$datos_alumno[0]->num_control) }}" autocomplete="off">
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
                        <input type="text" name="name" id="input-name" class="form-control" placeholder="" value="{{ old('name', $datos_alumno[0]->nombres) }}" required autofocus>
                    </div>
                    <div class="col-md">
                        <label class="form-control-label" for="input-apPaterno">{{ __('Apellido Paterno') }}</label>
                        <input type="text" name="apPaterno" id="input-apPaterno" class="form-control" placeholder="" value="{{ old('apPaterno', $datos_alumno[0]->ap_paterno) }}" required autofocus>
                    </div>
                    <div class="col-md">
                        <label class="form-control-label" for="input-apMaterno">{{ __('Apellido Materno') }}</label>
                        <input type="text" name="apMaterno" id="input-apMaterno" class="form-control" placeholder="" value="{{ old('apMaterno', $datos_alumno[0]->ap_materno) }}" required autofocus>
                    </div>
                </div>
                
                <br>

                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label class="form-control-label" for="input-curp">{{ __('CURP') }}</label>
                        <input type="text" class="form-control" name="curp" id="input-curp" value="{{ old('curp', $datos_alumno[0]->curp) }}" onkeyup="this.value = this.value.toUpperCase();">
                    </div>
                    <div class="form-group col-md-2">
                        <label class="form-control-label" for="input-edad">{{ __('Edad') }}</label>
                        <input type="text" class="form-control" name="edad" id="input-edad" value="{{ old('edad', $datos_alumno[0]->edad) }}">
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-sexo" >{{ __('Sexo') }}</label>
                        <div class="row">            
                            <div class="custom-control custom-radio">
                                <input type="radio" id="sexof" name="sexo"  @if($datos_alumno[0]->sexo ='F') checked @endif value = {{ old('sexo',$datos_alumno[0]->sexo) }} class="custom-control-input">
                                <label class="custom-control-label" for="sexof">&nbsp&nbsp&nbsp&nbsp&nbspFemenino</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="sexom" name="sexo" @if($datos_alumno[0]->sexo ='M') checked @endif value = {{ old('sexo',$datos_alumno[0]->sexo) }} class="custom-control-input">
                                <label class="custom-control-label" for="sexom">&nbsp&nbsp&nbsp&nbsp&nbspMasculino</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-calle">{{ __('Dirección') }}</label>
                        <input type="text" name="calle" id="input-calle" class="form-control" placeholder="Calle" value="{{ old('calle', $datos_alumno[0]->calle) }}" required autofocus>
                    </div>
                    <div class="form-group col-md-2">
                            <label class="form-control-label" for="input-numero">{{ __('') }}</label>
                        <input type="text" name="numero" id="input-numero" class="form-control" placeholder="Número" value="{{ old('numero', $datos_alumno[0]->numero) }}" required autofocus>
                    </div>
                    <div class="form-group col-md">
                            <label class="form-control-label" for="input-colonia">{{ __(' ') }}</label>
                        <input type="text" name="colonia" id="input-colonia" class="form-control" placeholder="Colonia" value="{{ old('colonia', $datos_alumno[0]->colonia) }}" required autofocus>
                    </div>
                    <div class="form-group col-md">
                            <label class="form-control-label" for="input-municipio">{{ __(' ') }}</label>
                        <select id="input-municipio" class="form-control" name="municipio">
                            
                                {{ $nm = App\Municipio::select('id','nombre_municipio')->where('id',$datos_alumno[0]->municipio)->pluck('nombre_municipio') }}
                            
                        <option selected value="{{ old('municipio', $datos_alumno[0]->municipio) }}">{{ $nm[0] }} </option>
                        @foreach ($nombres_municipios as $mun)
                        <option value="{{ $mun }}">{{ $mun }}</option>  
                        @endforeach
                        
                        </select>                  
                    </div>

                </div>
                <div class="row">
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-telefono">{{ __('Teléfono') }}</label>
                        <input type="text" name="telefono" id="input-telefono" class="form-control" placeholder="" value="{{ old('telefono', $datos_alumno[0]->telefono) }}" required autofocus>
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder=""{{-- value="old('email',$email[0]->email)" --}}required >
                    </div>
                </div>
        
        
            </div>

            <hr class="my-4" />
            <h6 class="heading-small text-muted mb-4">{{ __('Información Escolar') }}</h6>
            
            <div class="pl-lg-4">
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="form-control-label" for="input-numControl">{{ __('Número de Control') }}</label>
                    <input type="text" name="numControl" id="input-numControl" class="form-control" placeholder="" value="{{ old('numControl', $datos_alumno[0]->num_control) }}">
                </div>
                <div class="form-group col-md-6">
                    <label class="form-control-label" for="input-carrera">{{ __('Carrera') }}</label>
                    <select id="input-carrera" class="form-control" name="carrera" value="{{ old('carrera', $datos_alumno[0]->carrera) }}">
                    <option selected value="{{ old('carrera', $datos_alumno[0]->carrera) }}">{{ old('carrera', $datos_alumno[0]->carrera) }}</option>
                    <option value="Ingeniería Eléctrica">{{ __('Ing. Eléctrica') }}</option>
                    <option value="Ingeniería Electrónica">{{ __('Ing. Electrónica') }}</option>
                    <option value="Ingeniería Civil">{{ __('Ing. Civil') }}</option>
                    <option value="Ingeniería Mecánica">{{ __('Ing. Mecánica') }}</option>
                    <option value="Ingeniería Industrial">{{ __('Ing. Industrial') }}</option>
                    <option value="Ingeniería Química">{{ __('Ing. Química') }}</option>
                    <option value="Ingeniería en Gestión Empresarial">{{ __('Ing. Gestión Empresarial') }}</option>
                    <option value="Ingeniería en Sist. Computacionales">{{ __('Ing. Sistemas Computacionales') }}</option>
                    <option value="Licenciatura en Administración">{{ __('Lic. Administración') }}</option>
                    </select>
                </div>
                <div class="form-group col-md-2">
                        <label class="form-control-label" for="input-semestre">{{ __('Semestre') }}</label>
                        <select  id="input-semestre" class="form-control" name="semestre">
                        <option selected value="{{ old('semestre', $datos_alumno[0]->semestre) }}">{{ old('semestre', $datos_alumno[0]->semestre) }}</option>
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">{{ ($i) }}</option>
                            @endfor 
                        </select>
                </div>
            </div>
            <div class="form-row">
                    <div class="col-md-3"></div>
                    <div class="form-group col-md-3">
                        <label for="activarpago" class="form-control-label">{{ __('Activar Folio de Pago') }}</label>
                        <div><label class="custom-toggle" >
                                <input type="checkbox" id="activarpago" onchange="comprobar(this);">
                                <span class="custom-toggle-slider rounded-circle"></span>
                              </label>
                            </div>
                    </div>
                   
                    <div class="form-group col-md" id="folio" style="display:none">
                        <label for="foliopago" class="form-control-label"> {{ __('Folio de Pago') }}</label>
                        <input type="text" name="foliopago" id="foliopago" class="form-control" placeholder=""  value="">
                    </div>
                </div>
            </div>
            <script>
             function comprobar(obj)
                {   
                    if (obj.checked){
                    
                document.getElementById('folio').style.display = "";
                } else{
                    
                document.getElementById('folio').style.display = "none";
                }     
                }
            </script>

            <div class="text-center">
                <button type="submit" class="btn btn-primary mt-4">{{ __('Actualizar') }}</button>
            </div>
        </form>
    </div>
</div>
@endsection