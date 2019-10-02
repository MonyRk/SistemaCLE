@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')
<div class="header pb-2 pt-5 pt-lg-8 d-flex align-items-center text-center" >
    <div class="col-lg col-md">
        <h4 class="text-dark">Editar Aula</h4>
    </div>
</div>
    
<div class="container-fluid m--t">
        <div class="text-right">
                <a href="{{ route('verAulas') }}" class="btn btn-outline-primary btn-sm mt-4">
                    <span>
                        <i class="fas fa-reply"></i> &nbsp; Regresar
                    </span>
                </a>
            </div>
    <div class="row">   
        <div class="col-md pt-3">
            @include('flash-message')
        </div>
    </div>
    <div class="row">
        <div class="card-body px-lg-5 py-lg-5">
            <form role="form" method="post" action="{{  route('actualizarAula',$aula1[0]->id_aula) }}" autocomplete="off">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col">
                        <label class="form-control-label" for="input-aula">N&uacute;mero de Aula</label>
                        <input class="form-control" id="input-aula" name="aula" type="text" value="{{ old('aula',$aula1[0]->num_aula) }}">
                    </div>
                    <div class="col">
                        <label class="form-control-label" for="input-edificio">Edificio</label>                    
                        <input class="form-control" name="edificio" id="input-edificio" placeholder="" type="text" value="{{ old('edificio',$aula1[0]->edificio) }}">
                    </div>
                </div><br>
                <div class="row">
                    <div class="col">
                        <label class="form-control-label" name="hrdisp" id="horadis">{{ __('Horas Disponibles') }}</label>
                    </div>
                </div>
                <div class="row">       
                    <div class="col">
                        <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="07:00" name="horas[]" type="checkbox" value="07:00">
                            <label class="custom-control-label" for="07:00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('7:00') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check form-check-inline custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="08:00" name="horas[]" type="checkbox" value="08:00">
                            <label class="custom-control-label" for="08:00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('8:00') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="09:00" name="horas[]" type="checkbox" value="09:00">
                            <label class="custom-control-label" for="09:00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('9:00') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check form-check-inline custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="10:00" name="horas[]" type="checkbox" value="10:00">
                            <label class="custom-control-label" for="10:00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('10:00') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="11:00" name="horas[]" type="checkbox" value="11:00">
                            <label class="custom-control-label" for="11:00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('11:00') }}</label>
                        </div>
                    </div>
                </div><br>
                <div class="row"> 
                    <div class="col">
                        <div class="form-check form-check-inline custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="12:00" name="horas[]" type="checkbox" value="12:00">
                            <label class="custom-control-label" for="12:00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('12:00') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="13:00" name="horas[]" type="checkbox" value="13:00">
                            <label class="custom-control-label" for="13:00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('13:00') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check form-check-inline custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="14:00" name="horas[]" type="checkbox" value="14:00">
                            <label class="custom-control-label" for="14:00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('14:00') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="15:00" name="horas[]" type="checkbox" value="15:00">
                            <label class="custom-control-label" for="15:00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('15:00') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check form-check-inline custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="16:00" name="horas[]" type="checkbox" value="16:00">
                            <label class="custom-control-label" for="16:00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('16:00') }}</label>
                        </div>
                    </div>
                </div><br>
                <div class="row">       
                    <div class="col">
                        <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="17:00" name="horas[]" type="checkbox" value="17:00">
                            <label class="custom-control-label" for="17:00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('17:00') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check form-check-inline custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="18:00" name="horas[]" type="checkbox" value="18:00">
                            <label class="custom-control-label" for="18:00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('18:00') }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                            <input class="custom-control-input" id="19:00" name="horas[]" type="checkbox" value="19:00">
                            <label class="custom-control-label" for="19:00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('19:00') }}</label>
                        </div>
                    </div>
                    <div class="col"></div>
                    <div class="col"></div>
                </div>
                <div class="text-center">
                    <button type="sumbit" class="btn btn-primary my-4">{{ __('Guardar Cambios') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
                
<br><br>
@include('layouts.footers.nav')



@endsection