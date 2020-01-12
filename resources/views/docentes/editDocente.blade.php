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
                        <label class="form-control-label" for="input-name">{{ __('Nombre(s)') }}</label>
                        <input type="text" name="name" id="input-name" class="form-control" placeholder="" value="{{ old('name', $docente[0]->nombres) }}"  autofocus>
                    </div>
                    <div class="col-md">
                        <label class="form-control-label" for="input-apPaterno">{{ __('Apellido Paterno') }}</label>
                        <input type="text" name="apPaterno" id="input-apPaterno" class="form-control" placeholder="" value="{{ old('apPaterno', $docente[0]->ap_paterno) }}"  >
                    </div>
                    <div class="col-md">
                        <label class="form-control-label" for="input-apMaterno">{{ __('Apellido Materno') }}</label>
                        <input type="text" name="apMaterno" id="input-apMaterno" class="form-control" placeholder="" value="{{ old('apMaterno', $docente[0]->ap_materno) }}"  >
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
                        <input type="text" name="calle" id="input-calle" class="form-control" placeholder="Calle" value="{{ old('calle', $docente[0]->calle) }}"  >
                    </div>
                    <div class="form-group col-md">
                            <label class="form-control-label" for="input-numero">{{ __('') }}</label>
                        <input type="text" name="numero" id="input-numero" class="form-control" placeholder="Número" value="{{ old('numero', $docente[0]->numero) }}"  >
                    </div>
                    <div class="form-group col-md">
                            <label class="form-control-label" for="input-colonia">{{ __(' ') }}</label>
                        <input type="text" name="colonia" id="input-colonia" class="form-control" placeholder="Colonia" value="{{ old('colonia', $docente[0]->colonia) }}"  >
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
                            <input type="text" name="cp" id="input-cp" class="form-control" placeholder="C.P." value="{{ old('cp', $docente[0]->cp) }}"  >
                        </div> 

                </div>
                <div class="row">
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-telefono">{{ __('Teléfono') }}</label>
                        <input type="text" name="telefono" id="input-telefono" class="form-control" placeholder="" value="{{ old('telefono', $docente[0]->telefono) }}"  >
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                        <input type="email" name="email" id="input-email" class="form-control form-control-alternative" placeholder=""value="{{ old('email',$email) }}"  >
                    </div>
                </div>
        
        
            </div>

            <hr class="my-4" />
            <h6 class="heading-small text-muted mb-4">{{ __('Información Profesional') }}</h6>
            
            <div class="pl-lg-4 prof">
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
                        <div class="form-row">
                            <div class="form-group col-md">
                                <label class="form-control-label" for="dominio">{{ __('Certificación de Dominio del Idioma') }}</label>
                                <input type="input" name="dominio" id="dominio" class="form-control form-control-alternative" placeholder=""value="{{ old('dominio') }}"  >
                            </div>
                            <div class="form-group col-md">
                                <label class="form-control-label" for="curso">{{ __('Curso de Entrenamiento para Profesores') }}</label>
                                <input type="input" name="curso" id="curso" class="form-control form-control-alternative" placeholder=""value="{{ old('curso') }}"  >
                            </div>                                    
                        </div>
                        <div class="form-row">
                            <div class="field_wrapper form-group col-md">
                                <div>
                                    <label class="form-control-label" for="didactica">{{ __('Certificaciones de Didáctica') }}</label>
                                    <input type="text" class="form-control form-control-alternative" id="didactica" name="didactica[]" value="{{ old('didactica') }}"/>
                                    <a href="javascript:void(0);" class="add_button" title="Add field"><i class="fas fa-plus text-info"></i></a>
                                </div>
                            </div>
                            <div class="form-group col-md">
                                <label class="form-control-label" for="experiencia">{{ __('Experiencia Docente') }}</label>
                                <input type="input" name="experiencia" id="experiencia" class="form-control form-control-alternative" placeholder="Años"value="{{ old('experiencia') }}"  >
                            </div>
                        </div>
                        <label class="form-control-label" for="actualizacion">{{ __('Actualizaciones Docentes') }}</label>
                        <div class="form-row">
                            <div class="form-group col-md">
                                <input type="input" name="actualizacion[]" id="actualizacion" class="form-control form-control-alternative" placeholder=""value="{{ old('experiencia') }}"  >
                            </div>
                            <div class="form-group col-md">
                                <input type="input" name="actualizacion[]" id="actualizacion" class="form-control form-control-alternative" placeholder=""value="{{ old('experiencia') }}"  >
                            </div>
                            <div class="form-group col-md">
                                <input type="input" name="actualizacion[]" id="actualizacion" class="form-control form-control-alternative" placeholder=""value="{{ old('experiencia') }}"  >
                            </div>
                        </div>
                        <div class="form-row" @if($usuarioactual->tipo != 'coordinador')style = "display:none;" @else style="display:block" @endif>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="input-rfc">{{ __('RFC') }}</label>
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="input-rfc" aria-describedby="input-rfc" name="rfc" value="{{ old('rfc',$docente[0]->rfc) }}" lang="es">
                                        <label class="custom-file-label" for="input-rfc"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row" @if($usuarioactual->tipo != 'coordinador')style = "display:none;" @else style="display:block" @endif>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="input-titulo">{{ __('Título') }}</label>
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="input-titulo" aria-describedby="input-titulo" name="titulo" value="{{ old('titulo',$docente[0]->titulo) }}">
                                        <label class="custom-file-label" for="input-titulo"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-row" @if($usuarioactual->tipo != 'coordinador')style = "display:none;" @else style="display:block" @endif>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="input-cedula">{{ __('Cédula Profesional') }}</label>
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="input-cedula" aria-describedby="input-cedula" name="cedula" value="{{ old('cedula',$docente[0]->ced_prof) }}">
                                        <label class="custom-file-label" for="input-cedula"></label>
                                    </div>
                                    {{-- <input type="file" class="form-control-file" id="input-cedula" name="cedula" value="{{ old('cedula') }}"> --}}
                                </div>
                            </div>
                        </div>
                        <div class="form-row" @if($usuarioactual->tipo != 'coordinador')style = "display:none;" @else style="display:block" @endif>
                            <div class="form-group col-md-6">
                                <label class="form-control-label" for="input-certificaciones">{{ __('Certificaciones') }}</label>
                                <div class="form-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="input-certificaciones" aria-describedby="input-certificaciones" name="certificaciones[]" value="{{ old('certificaciones') }}" multiple>
                                        <label class="custom-file-label" for="input-certificaciones" data-browse="Bestand kiezen"></label>
                                    </div>
                                    {{-- <input type="file" class="form-control-file" id="input-certificaciones" name="certificaciones[]" value="{{ old('certificaciones') }}" multiple="multiple"> --}}
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

@section('script')
    <script>
        // function llenar(){
        //     var alumn_id = 'hola.pdf';
        //     $('.prof').find('#input-cedula').val(alumn_id);
        // });
        // }
        // poner los datos en input file
        $('.custom-file-input').on('change', function(event) {
            var inputFile = event.currentTarget;
            $(inputFile).parent()
                .find('.custom-file-label')
                .html(inputFile.files[0].name);
        });


        // PARA AGREGAR CAMPOS
        $(document).ready(function(){
        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector 
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML = '<div><input type="text" name="didactica[]" value="" class="form-control form-control-alternative"/><a href="javascript:void(0);" class="remove_button" title="Remove field"><i class="fas fa-times text-danger "></i></div>'; //New input field html 
        var x = 1; //Initial field counter is 1
        $(addButton).click(function(){ //Once add button is clicked
            if(x < maxField){ //Check maximum number of input fields
                x++; //Increment field counter
                $(wrapper).append(fieldHTML); // Add field html
            }
        });
        $(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
            });
        });
    </script>
@endsection
@endsection