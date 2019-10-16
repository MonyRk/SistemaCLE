@extends('viewsBase.create')
@section('regresar')
    {{ route('verDocentes') }}
@endsection
@section('titlecreate')
    Agregar Docente
@endsection
@section('action')
    {{ url("guardarDocente") }}
@endsection
@section('nombreTipodeInformacion')
    <h6 class="heading-small text-muted mb-4">{{ __('Información Profesional') }}</h6>
@endsection

@section('informacionporTipo')
<input type="hidden" id="tipo" name="tipo" value="docente">
<div class="form-row">  
        <div class="form-group col-md">
            <label class="form-control-label" for="input-estudios">{{ __('Grado de Estudios') }}</label>
            <input type="text" class="form-control" id="input-estudios" name="estudios" value="{{ old('estudios') }}">
            {{-- <select id="input-estudios" class="form-control" name="estudios">
            <option selected></option>
            <option value="Licenciatura">{{ __('Licenciatura') }}</option>
            <option value="Maestría">{{ __('Maestría') }}</option>
            <option value="Doctorado">{{ __('Doctorado') }}</option>
            </select> --}}
        </div>
        <div class="form-group col-md">
            <label class="form-control-label" for="input-estatus">{{ __('Estatus') }}</label>
            <select id="input-estatus" class="form-control" name="estatus">
            <option selected></option>
            <option value="Activo">{{ __('Activo') }}</option>
            <option value="Inactivo">{{ __('Inactivo') }}</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md">
            <label class="form-control-label" for="input-rfc">{{ __('RFC') }}</label>
            <div class="form-group">
                <input type="file" class="form-control-file" id="input-rfc" name="rfc" value="{{ old('rfc') }}">
                </div>
         </div>
        </div>
         <div class="form-row">
         <div class="form-group col-md">
            <label class="form-control-label" for="input-titulo">{{ __('Título') }}</label>
            <div class="form-group">
                <input type="file" class="form-control-file" id="input-titulo" name="titulo" value="{{ old('titulo') }}">
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md">
            <label class="form-control-label" for="input-cedula">{{ __('Cédula Profesional') }}</label>
            <div class="form-group">
                <input type="file" class="form-control-file" id="input-cedula" name="cedula" value="{{ old('cedula') }}">
            </div>
        </div>
    </div>
    
@endsection