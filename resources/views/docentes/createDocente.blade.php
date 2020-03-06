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

<div class="pl-lg-4">
    <label class="form-control-label">{{ __('Dirección') }}</label>
        <div class="row">
            <div class="form-group col-md" id="direccion">
                <label class="form-control-label" for="input-calle"><b style="color:red;">*</b>{{ __('Calle') }}</label>
                <input type="text" name="calle" id="input-calle" class="form-control"  value="{{ old('calle') }}" >
            </div>
            <div class="form-group col-md">
                    <label class="form-control-label" for="input-numero"><b style="color:red;">*</b>{{ __('Número') }}</label>
                <input type="text" name="numero" id="input-numero" class="form-control"  value="{{ old('numero') }}" >
            </div>
            <div class="form-group col-md">
                    <label class="form-control-label" for="input-colonia"><b style="color:red;">*</b>{{ __('Colonia') }}</label>
                <input type="text" name="colonia" id="input-colonia" class="form-control"  value="{{ old('colonia') }}" >
            </div>
            <div class="form-group col-md">
                <label class="form-control-label" for="input-municipio"><b style="color:red;">*</b>{{ __('Municipio') }}</label>
                <select id="input-municipio" class="form-control" name="municipio">
                    <option selected value=""></option>
                        @foreach ($nombres_municipios as $mun)
                        <option value="{{ $mun->id }}">{{ $mun->nombre_municipio }}</option>                             
                        @endforeach
                </select>                  
            </div>
            <div class="form-group col-md">
                    <label class="form-control-label" for="input-cp"><b style="color:red;">*</b>{{ __('C. P.') }}</label>
                <input type="text" name="cp" id="input-cp" class="form-control" value="{{ old('cp') }}" >
            </div>
        </div>
    </div>
        <hr class="my-4" />
    <h6 class="heading-small text-muted mb-4">{{ __('Información Profesional') }}</h6>
@endsection

@section('informacionporTipo')
    <input type="hidden" id="tipo" name="tipo" value="docente">
    <div class="form-row">
        <div class="form-group col-md">
            <label class="form-control-label" for="input-estudios"><b style="color:red;">*</b>{{ __('Grado de Estudios') }}</label>
            <input type="text" class="form-control" id="input-estudios" name="estudios" value="{{ old('estudios') }}">
            {{-- <select id="input-estudios" class="form-control" name="estudios">
                <option selected></option>
                <option value="Licenciatura">{{ __('Licenciatura') }}</option>
            <option value="Maestría">{{ __('Maestría') }}</option>
            <option value="Doctorado">{{ __('Doctorado') }}</option>
            </select> --}}
        </div>
        <div class="form-group col-md">
            <label class="form-control-label" for="input-estatus"><b style="color:red;">*</b>{{ __('Estatus') }}</label>
            <select id="input-estatus" class="form-control" name="estatus">
                <option selected></option>
                <option value="Activo">{{ __('Activo') }}</option>
                <option value="Inactivo">{{ __('Inactivo') }}</option>
            </select>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-control-label" for="input-rfc"><b style="color:red;">*</b>{{ __('RFC') }}</label>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="input-rfc" aria-describedby="input-rfc" name="rfc" value="{{ old('rfc') }}">
                    <label class="custom-file-label" for="input-rfc"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-control-label" for="input-titulo"><b style="color:red;">*</b>{{ __('Título') }}</label>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="input-titulo" aria-describedby="input-titulo" name="titulo" value="{{ old('titulo') }}">
                    <label class="custom-file-label" for="input-titulo"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-control-label" for="input-cedula"><b style="color:red;">*</b>{{ __('Cédula Profesional') }}</label>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="input-cedula" aria-describedby="input-cedula" name="cedula" value="">
                    <label class="custom-file-label" for="input-cedula"></label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-control-label" for="input-certificaciones"><b style="color:red;">*</b>{{ __('Certificaciones') }}</label>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="input-certificaciones" aria-describedby="input-certificaciones" name="certificaciones[]" value="" multiple>
                    <label class="custom-file-label" for="input-certificaciones"></label>
                </div>
            </div>
        </div>
    </div> 
    <div class="form-row">
        <div class="form-group col-md-6">
            <label class="form-control-label" for="input-documentos"><b style="color:red;">*</b>{{ __('Documentación') }}</label>
            <div class="form-group">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="input-documentos" aria-describedby="input-documentos" name="documentos[]" value="" multiple>
                    <label class="custom-file-label" for="input-documentos"></label>
                </div>
            </div>
        </div>
    </div> 
    
    @section('script')
        <script>
        $('.custom-file-input').on('change', function(event) {
            var inputFile = event.currentTarget;
            $(inputFile).parent()
                .find('.custom-file-label')
                .html(inputFile.files[0].name);
        });
        </script>
    @endsection
@endsection