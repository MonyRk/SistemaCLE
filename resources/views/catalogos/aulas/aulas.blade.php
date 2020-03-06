@extends('layouts.app')
@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')

<div class="container-fluid m--t">
<div class="row">   
    <div class="col-md pt-3">
            @include('flash-message')
    </div>
</div>
<div class="text-right">
    <a href="{{ route('catalogos') }}" class="btn btn-outline-primary btn-sm mt-4">
        <span>
            <i class="fas fa-reply"></i> &nbsp; Regresar
        </span>
    </a>
</div>
<div class="row mt-4">
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
                            <th scope="col">Edificio</th>
                            <th scope="col">Aula</th>
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
                                {{ $aula->edificio }}
                            </th>
                            <th scope="row">
                                {{ $aula->num_aula }}
                            </th> 
                            <th>       
                               <select  name = "horas" id="horas" style="font-size: 1rem; line-height: 1.5; display: block; width: 50%;height: 1.75rem; padding: .625rem .75rem; transition: all .2s cubic-bezier(.68, -.55, .265, 1.55); color: #8898aa; border: 1px solid #cad1d7;border-radius: .375rem; background-color: #fff; background-clip: padding-box; box-shadow: none;">
                                   <option value="" selected></option> 
                                   @if ($aula->hora1 != null) <option value="{{ $aula->hrdisponible }}">{{ $aula->hora1 }}</option> @endif 
                                   @if ($aula->hora2 != null) <option value="{{ $aula->hrdisponible }}">{{ $aula->hora2 }}</option> @endif 
                                   @if ($aula->hora3 != null) <option value="{{ $aula->hrdisponible }}">{{ $aula->hora3 }}</option> @endif 
                                   @if ($aula->hora4 != null) <option value="{{ $aula->hrdisponible }}">{{ $aula->hora4 }}</option> @endif 
                                   @if ($aula->hora5 != null) <option value="{{ $aula->hrdisponible }}">{{ $aula->hora5 }}</option> @endif 
                                   @if ($aula->hora6 != null) <option value="{{ $aula->hrdisponible }}">{{ $aula->hora6 }}</option> @endif
                                   @if ($aula->hora7 != null) <option value="{{ $aula->hrdisponible }}">{{ $aula->hora7 }}</option> @endif 
                                   @if ($aula->hora8 != null) <option value="{{ $aula->hrdisponible }}">{{ $aula->hora8 }}</option> @endif 
                                   @if ($aula->hora9 != null) <option value="{{ $aula->hrdisponible }}">{{ $aula->hora9 }}</option> @endif 
                                   @if ($aula->hora10 != null) <option value="{{ $aula->hrdisponible }}">{{ $aula->hora10 }}</option> @endif 
                                   @if ($aula->hora11 != null) <option value="{{ $aula->hrdisponible }}">{{ $aula->hora11 }}</option> @endif 
                                   @if ($aula->hora12 != null) <option value="{{ $aula->hrdisponible }}">{{ $aula->hora12 }}</option> @endif
                                   @if ($aula->hora13 != null) <option value="{{ $aula->hrdisponible }}">{{ $aula->hora13 }}</option> @endif
                                   @if ($aula->sabatino != null) <option value="{{ $aula->hrdisponible }}">{{ $aula->sabatino }}</option> @endif
                               </select>
                            </th>
                            <td>
                                <a href="{{ route('editarAula',$aula->id_aula) }}" class="text-primary" ><i class="fas fa-edit"></i></a>
                            </td>
                            @php
                                $aula_de_grupos = App\Grupo::where('aula',$aula->id_aula)->get();
                            @endphp
                            @if($aula_de_grupos->isEmpty())
                                <td>
                                    <a href="" id="aulaid" data-aulaid="{{ $aula->id_aula }}" class="text-danger" data-toggle="modal" data-target="#modal-notification" ><i class="far fa-trash-alt"></i></a>
                                </td>
                            @else
                                <td class="text-center" >
                                    <a href="" class="text-primary" data-toggle="modal" data-target="#modal-notification2" ><i class="far fa-question-circle"></i></a>
                                </td>
                            @endif
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $aulas->links() }}
        </div>
    </div>
</div>
<br><br>
@include('layouts.footers.nav')
</div>
{{-- modal para crear --}}

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
                                            <div class="col">
                                                <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                                                    <input class="custom-control-input" id="sabados" name="sabados" type="checkbox" value="sabados">
                                                    <label class="custom-control-label" for="sabados">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Sábados') }}</label>
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

{{-- modal para eliminar --}}


<div class="col-md-4">
    <div class="modal fade" id="modal-notification" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-" role="document">
            <div class="modal-content bg-gradient-white">
                
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-notification">¡Espera!</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    
                </div>
                <form action="{{ route('eliminarAula','test') }}" method="POST" class="delete" id="deleteForm">
                @csrf
                @method('delete')
                <div class="modal-body">
                    
                    <div class="py-3 text-center">
                            <i class="fas fa-times fa-3x" style="color:#CD5C5C;"></i>
                        <h4 class="heading mt-4">¡Da tu confirmaci&oacute;n para Eliminar!</h4>
                        <p>¿Realmente deseas eliminar los datos del aula?</p>
                        <input type="hidden" name="aula_id" id="aula_id" value="">
                    </div>
                    
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-outline-danger">S&iacute;, Eliminar</button>
                    <button type="button" class="btn btn-link text-gray ml-auto" data-dismiss="modal">No, Cambi&eacute; de opinion</button> 
                </div>
                </form>
            </div>
        </div>
    </div>
</div>



  {{-- modal para informar que ya no se puede hacer nada --}}
  <div class="col-md-4">
        <div class="modal fade" id="modal-notification2" tabindex="-1" role="dialog" aria-labelledby="modal-notification" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-" role="document">
                <div class="modal-content">
                    
                    <div class="modal-header">
                        <h6 class="modal-title" id="modal-title-notification">¡Información!</h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                        
                    </div>
                   
                    <div class="modal-body">
                        
                        <div class="py-3 text-center">
                                <i class="fas fa-exclamation fa-3x text-warning" style=""></i>
                <h4 class="heading mt-4">Los datos de esta aula no se puede Eliminar</h4>
                <p>Los datos que contiene estan asociados a otros, si se elimina podr&iacute;a perderse informaci&oacute;n importante adem&aacute;s de generar inconsistencia de datos.</p>
                            <input type="hidden" name="grupo_id" id="grupo_id" value="">
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                        {{-- <button type="submit" class="btn btn-outline-warning">Entendido</button> --}}
                        <button type="button" class="btn btn-outline-warning ml-auto" data-dismiss="modal">Entendido</button> 
                    </div>
                </div>
            </div>
        </div>

            </div>


@section('script')
<script>
    // para eliminar
 $('#modal-notification').on('show.bs.modal', function(event){
     var button = $(event.relatedTarget) 
     var a_id = button.attr('data-aulaid')
     var modal = $(this)
     modal.find('.modal-body #aula_id').val(a_id);
 } )



// para poner las horas de las aulas

 </script>
@endsection


@endsection

