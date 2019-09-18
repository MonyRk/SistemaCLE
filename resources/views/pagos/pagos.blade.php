@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')
<div class="container-fluid m--t">
    <div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center" >
        <div class="col-lg col-md">
            <h4 class="text-dark">Pagos</h4>
        </div>
    </div>
    <div class="card-body">
        @include('flash-message')
    </div>

    <div class="text-right">
        
        <a href="{{ route('inicio') }}" class="btn btn-outline-primary mt-4">
            <span>
                <i class="fas fa-reply"></i> &nbsp; Regresar
            </span>
        </a>
    </div>
    <div class="row mt-3">
        <div class="col-xl">
            <div class="col-xl">
                <div class="card shadow ">
                    <div class="card-header border-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="mb-0"></h4>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush th" id="datatable">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Número <br> de Control</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Folio de Pago</th>
                                    <th scope="col">Monto de Pago</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Verificar</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection