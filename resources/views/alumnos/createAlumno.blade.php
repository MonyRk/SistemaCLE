@extends('viewsBase.create')
@section('titlecreate')
    Agregar Estudiante
@endsection
@section('action')
{{ url("guardarEstudiante") }}
@endsection

@section('nombreTipodeInformacion')
    <h6 class="heading-small text-muted mb-4">{{ __('Información Escolar') }}</h6>
@endsection

@section('informacionporTipo')
    <div class="form-row">
        <div class="form-group col-md-4">
            <label class="form-control-label" for="input-numControl">{{ __('Número de Control') }}</label>
            <input type="text" name="numControl" id="input-numControl" class="form-control" placeholder="" value="{{ old('numControl') }}">
        </div>
        <div class="form-group col-md-6">
            <label class="form-control-label" for="input-carrera">{{ __('Carrera') }}</label>
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
                <label class="form-control-label" for="input-semestre">{{ __('Semestre') }}</label>
                <select  id="input-semestre" class="form-control" name="semestre">
                <option selected value="{{ old('semestre') }}">{{ old('semestre') }}</option>
                    @for ($i = 1; $i <= 12; $i++)
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
                {{-- <div class="form-group col-md-3 text-center">
                    <label for="activarpago" class="form-control-label">{{ __('Realizó Examen de ubicación') }}</label>
                    <div>
                        <label class="custom-toggle" >
                            <input type="checkbox" id="activarpago" onchange="comprobar(this);">
                            <span class="custom-toggle-slider rounded-circle"></span>
                        </label>
                    </div>
                </div> --}}
            {{-- <div class="form-group col-md-3" id="folio" {{-- style="display:none" }}>
                <label for="foliopago" class="form-control-label"> {{ __('Folio de Pago') }}</label>
                <input type="text" name="foliopago" id="foliopago" class="form-control" placeholder=""  value="{{ old('foliopago') }}">
            </div>
            <div class="form-group col-md-3" id="monto" {{--style="display:none">
                <label for="foliopago" class="form-control-label"> {{ __('Monto de Pago') }}</label>
                <input type="text" name="monto" id="monto" class="form-control" placeholder=""  value="{{ old('monto') }}">
            </div> --}}
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
           </script>   
@endsection


{{-- onchange="document.getElementById('activarpago').on = !this.disabled;" --}}