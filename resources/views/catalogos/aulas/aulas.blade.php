@extends('layouts.app')
@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')

    <div class="header bg-gradient-white py-5 py-lg-3">
        <div class="container">
            <div class="header-body text-center mb-2">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h3 class="text-dark" style="font-family: 'Soberana Sans'"><br><br><br></h3>{{-- aqui irá la variable del nombre del modulo en el que se esta --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
    <div class="col-xl">
        <div class="card shadow ">
            <div class="card-header border-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="mb-0">{{ __('Aulas') }}</h4>
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-sm btn-white" data-toggle="modal" data-target="#modal-form2">{{ __('Agregar ') }}<i class="fas fa-plus-circle"></i></button>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <!-- Projects table -->
                <table class="table align-items-center table-flush th">
                    <thead class="thead-light">
                        <tr>
                            <th></th>
                            <th scope="col">Aula</th>
                            <th scope="col">Edificio</th>
                            <th scope="col">Horas Disponibles</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($aulas as $aula)
                        <tr>
                            <th scope="row"></th>
                            <th scope="row">
                                {{ $aula->num_aula }}
                            </th>
                            <th scope="row">
                                {{ $aula->edificio }}
                            </th> 
                            <th>       
                               <select name = "horas">
                                   <option value="" selected></option>                                         
                                <option value="{{ $aula->hrdisponible }}">{{ $aula->hora1 }}</option>
                                <option value="{{ $aula->hrdisponible }}">{{ $aula->hora2 }}</option>
                                <option value="{{ $aula->hrdisponible }}">{{ $aula->hora3 }}</option>
                                <option value="{{ $aula->hrdisponible }}">{{ $aula->hora4 }}</option>
                                <option value="{{ $aula->hrdisponible }}">{{ $aula->hora5 }}</option>
                                <option value="{{ $aula->hrdisponible }}">{{ $aula->hora6 }}</option>
                                <option value="{{ $aula->hrdisponible }}">{{ $aula->hora7 }}</option>
                                <option value="{{ $aula->hrdisponible }}">{{ $aula->hora8 }}</option>
                                <option value="{{ $aula->hrdisponible }}">{{ $aula->hora9 }}</option>
                                <option value="{{ $aula->hrdisponible }}">{{ $aula->hora10 }}</option>
                                <option value="{{ $aula->hrdisponible }}">{{ $aula->hora11 }}</option>
                                <option value="{{ $aula->hrdisponible }}">{{ $aula->hora12 }}</option>
                                <option value="{{ $aula->hrdisponible }}">{{ $aula->hora13 }}</option> 
                               </select>
                            </th>
                            <td>
                                <a href="{{ route('editarAula',[$aula->id_aula]) }}"><i class="fas fa-edit"></i></a>
                            </td>
                            <td>
                                <a href="{{ route('eliminarAula',[$aula->id_aula]) }}"><i class="far fa-trash-alt"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

<div class="col-md-4">
    
        <div class="modal fade" id="modal-form2" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card bg-lighter shadow border-0">
                            <div class="card-body px-lg-5 py-lg-5">
                                <div class="text-center text-muted mb-4">
                                    <strong>{{ __('Nueva Aula') }}</strong>
                                </div>

                                    <form role="form" method="post" action="{{  route('agregarAula') }}" autocomplete="off">
                                        @csrf
                                        @method('post')
                                        <div class="form-group mb-3">
                                          <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                                </div>
                                                <input class="form-control" name="aula" placeholder="Número de Aula" type="text" value="{{ old('aula') }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                                </div>
                                                <input class="form-control" name="edificio" placeholder="Edificio" type="text" value="{{ old('edificio') }}">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="" name="hrdisp" id="horadis">{{ __('Horas Disponibles') }}</label>
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
                                        </div>
                                        <div class="row">       
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
                                        </div>
                                        <div class="row">       
                                            <div class="col">
                                                <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                                                    <input class="custom-control-input" id="11:00" name="horas[]" type="checkbox" value="11:00">
                                                    <label class="custom-control-label" for="11:00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('11:00') }}</label>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-check form-check-inline custom-control custom-control-alternative custom-checkbox mb-3">
                                                    <input class="custom-control-input" id="12:00" name="horas[]" type="checkbox" value="12:00">
                                                    <label class="custom-control-label" for="12:00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('12:00') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">       
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
                                        </div>
                                        <div class="row">       
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
                                        </div>
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
                                        </div>
                                        <div class="row">       
                                            <div class="col">
                                                <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                                                    <input class="custom-control-input" id="19:00" name="horas[]" type="checkbox" value="19:00">
                                                    <label class="custom-control-label" for="19:00">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('19:00') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="sumbit" class="btn btn-primary my-4">{{ __('Guardar') }}</button>
                                        </div>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

