@extends('viewsBase.create')
@section('titlecreate')
    Agregar Estudiante
@endsection
@section('regresar')
@auth()
@if ($usuarioactual->tipo == 'coordinador')
{{ route('verEstudiantes') }}
@else 
{{ route('home') }}
@endif
@endauth

@guest()
{{ route('login') }}
@endguest
@endsection
@section('action')
{{ url("guardarEstudiante") }}
@endsection

@section('nombreTipodeInformacion') 
<div class="pl-lg-4">
    <label class="form-control-label">{{ __('Dirección') }}</label>
        <div class="row">
            <div class="form-group col-md" id="direccion">
                <label class="form-control-label" for="input-calle">{{ __('Calle') }}</label>
                <input type="text" name="calle" id="input-calle" class="form-control"  value="{{ old('calle') }}" >
            </div>
            <div class="form-group col-md">
                    <label class="form-control-label" for="input-numero">{{ __('Número') }}</label>
                <input type="text" name="numero" id="input-numero" class="form-control"  value="{{ old('numero') }}" >
            </div>
            <div class="form-group col-md">
                    <label class="form-control-label" for="input-colonia">{{ __('Colonia') }}</label>
                <input type="text" name="colonia" id="input-colonia" class="form-control"  value="{{ old('colonia') }}" >
            </div>
            <div class="form-group col-md">
                <label class="form-control-label" for="input-municipio">{{ __('Municipio') }}</label>
                <select id="input-municipio" class="form-control" name="municipio">
                    <option selected value=""></option>
                        @foreach ($nombres_municipios as $mun)
                        <option value="{{ $mun->id }}">{{ $mun->nombre_municipio }}</option>                             
                        @endforeach
                </select>                  
            </div>
            <div class="form-group col-md">
                    <label class="form-control-label" for="input-cp">{{ __('C. P.') }}</label>
                <input type="text" name="cp" id="input-cp" class="form-control" value="{{ old('cp') }}" >
            </div>
        </div>
    </div>
        <hr class="my-4" />
    <h6 class="heading-small text-muted mb-4">{{ __('Información Escolar') }}</h6>
@endsection

@section('informacionporTipo')
    <div class="form-row">
        <div class="form-group col-md-3">
            <label class="form-control-label" for="input-externo">{{ __('Estudiante Externo') }}</label>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" id="externo" name="externo" onchange="comprobar2(this);" value="true" class="custom-control-input">
                <label class="custom-control-label" for="externo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Es Estudiante Externo?</label>
            </div>
        </div>
    </div>
    <div class="form-row" id="num_control">
        <div class="form-group col-md-4"  >
            <label class="form-control-label" for="input-numControl"><b style="color:red;">*</b>{{ __('Número de Control') }}</label>
            <input type="text" name="numControl" id="input-numControl" class="form-control" placeholder="" value="{{ old('numControl') }}" data-toggle="tooltip" data-placement="bottom" title="Aseg&uacute;rate de escribir correctamente el N&uacute;mero de Control">
        </div>
    
    
        <div class="form-group col-md-6">
            <label class="form-control-label" for="input-carrera"><b style="color:red;">*</b>{{ __('Carrera') }}</label>
            <select id="input-carrera" class="form-control" name="carrera">
            <option selected value="{{ old('carrera') }}">{{ old('carrera') }}</option>
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
                <option selected value="{{ old('semestre') }}">{{ old('semestre') }}</option>
                    @for ($i = 1; $i <= 16; $i++)
                        <option value="{{ $i }}">{{ ($i) }}</option>
                    @endfor 
                </select>
        </div>
        
        </div>
        <div class="form-row">
            <div class="form-group col-md-3">
                <label class="form-control-label" for="input-sexo">{{ __('Examen de Ubicación') }}</label>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="examen" name="examen" onchange="comprobar(this);" value="true" class="custom-control-input">
                    <label class="custom-control-label" for="examen">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Realiz&oacute; examen</label>
                </div>
            </div>
            <div class="form-group col-md-3" id="inicial" style="display:none">
                <label class="form-control-label" for="input-nivel">{{ __('Nivel Donde Inicia') }}</label>
                <select id="input-nivel" class="form-control" name="nivel">
                    <option selected></option>
                        @foreach ($niveles as $nivel)
                            <option value="{{ $nivel->nivel }}{{ $nivel->modulo }}">{{ $nivel->nivel }}{{ $nivel->modulo }}&nbsp;-&nbsp; {{ $nivel->idioma }}</option>                             
                        @endforeach
                </select>                  
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
                   
               document.getElementById('num_control').style.display = "none";
               } else{
                   
               document.getElementById('num_control').style.display = "";
               }     
               }
           </script>   
@endsection


{{-- onchange="document.getElementById('activarpago').on = !this.disabled;" --}}