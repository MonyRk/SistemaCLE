@extends('viewsBase.create')
@section('action')
{{ url("guardarAlumno") }}
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
            <option value="Ingeniería en Sist. Computacionales">{{ __('Ing. Sistemas Computacionales') }}</option>
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
            <div class="col-md-3"></div>
                <div class="form-group col-md-3">
                    <label for="activarpago" class="form-control-label">{{ __('Activar Folio de Pago') }}</label>
                    <div><label class="custom-toggle" >
                            <input type="checkbox" id="activarpago" onchange="comprobar(this);">
                            <span class="custom-toggle-slider rounded-circle"></span>
                          </label>
                        </div>
                </div>
               
                <div class="form-group col-md-6" id="folio" style="display:none">
                    <label for="foliopago" class="form-control-label"> {{ __('Folio de Pago') }}</label>
                    <input type="text" name="foliopago" id="foliopago" class="form-control" placeholder=""  value="">
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
@endsection


{{-- onchange="document.getElementById('activarpago').on = !this.disabled;" --}}