@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')
<div class="container-fluid m--t">
        <div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center">
            <div class="col-lg col-md">
                <h4 class="text-dark">Constancias de Liberaci&oacute;n CLE</h4>
            </div>
        </div>
        <div class="card-body">
            @include('flash-message')
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    
        <div class="text-right">
            <a href="{{ route('inicio') }}" class="btn btn-outline-primary btn-sm mt-2">
                <span>
                    <i class="fas fa-reply"></i> &nbsp; Regresar
                </span>
            </a>
        </div>
        <form action="{{ route('generarLiberacionCle') }}" method="GET">
            <div class="row">
                <div class="col-lg-4"></div>
                <div class="col-lg-4 text-center">
                    <div class="row">
                        <div class="form-group col-md">
                            <label class="form-control-label" for="numControl">{{ __('Número de Control') }}</label>
                            <input id="numControl" class="form-control" name="numControl">
                        </div>
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-plan">{{ __('Plan de Estudios') }}</label>
                        <select id="input-plan" class="form-control" name="plan">
                            <option selected value="">Elegir Opcion</option>
                            <option value="ICIV-2010-208">ICIV-2010-208</option>
                            <option value="ISIC-2010-224">ISIC-2010-224</option>
                            <option value="LADM-2010-234">LADM-2010-234</option>
                            <option value="IELC-2010-211">IELC-2010-211</option>
                            <option value="IMEC-2010-228">IMEC-2010-228</option>
                            <option value="IQUI-2010-232">IQUI-2010-232</option>
                            <option value="IIND-2010-227">IIND-2010-227</option>
                            <option value="IGEM-2009-201">IGEM-2009-201</option>
                            <option value="IELE-2010-209">IELE-2010-209</option>
                        </select>                  
                    </div>
                    <div class="form-group col-md">
                        <label class="form-control-label" for="input-nivel">{{ __('Nivel Final') }}</label>
                        <select id="input-nivel" class="form-control" name="nivel">
                            <option selected value="">Elegir Opcion</option>
                            <option value="A2M2">A2</option>
                            <option value="B1M2">B1</option>
                        </select>   
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-lg mt-4"><span><i class="fas fa-arrow-right"></i></span></button>
                    </div>
                </div>
                <div class="col-lg-4"></div>
            </div>
        </form>
        <br><br><br><br>
        @include('layouts.footers.nav')
    </div>
    
    
@endsection