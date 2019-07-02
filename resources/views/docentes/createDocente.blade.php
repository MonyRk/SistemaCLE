@extends('viewsBase.create')
@section('action')
    {{ url("guardarDocente") }}
@endsection
@section('nombreTipodeInformacion')
    <h6 class="heading-small text-muted mb-4">{{ __('Información Profesional') }}</h6>
@endsection

@section('informacionporTipo')
    <div class="form-row">
        <div class="form-group col-md">
            <label class="form-control-label" for="input-rfc">{{ __('RFC') }}</label>
            <input type="text" name="rfc" id="input-rfc" class="form-control" placeholder="" value="{{ old('rfc') }}">
        </div>
        <div class="form-group col-md">
            <label class="form-control-label" for="input-estudios">{{ __('Grado de Estudios') }}</label>
            <select id="input-estudios" class="form-control" name="estudios">
            <option selected></option>
            <option value="Licenciatura">{{ __('Licenciatura') }}</option>
            <option value="Maestría">{{ __('Maestría') }}</option>
            <option value="Doctorado">{{ __('Doctorado') }}</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md">
            <label class="form-control-label" for="input-titulo">{{ __('Titulo') }}</label>
            <input type="text" id="input-titulo" class="form-control" name="titulo" value="{{ old('titulo') }}"> 
        </div>
        <div class="form-group col-md">
            <label class="form-control-label" for="input-cedula">{{ __('Cédula Profesional') }}</label>
            <input type="text" id="input-cedula" class="form-control" name="cedula" value="{{ old('cedula') }}"> 
        </div>
    </div>

@endsection