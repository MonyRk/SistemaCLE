@extends('layouts.app')
@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')

<div class="container-fluid">
<div class="row">   
    <div class="col-md pt-3">
            @include('flash-message')
    </div>
</div>
    <div class="text-right pb-4">
        <a href="{{ route('catalogos') }}" class="btn btn-outline-primary btn-sm mt-4">
            <span>
                <i class="fas fa-reply"></i> &nbsp; Regresar
            </span>
        </a>
    </div>
<div class="row">
    <div class="col-xl">
        <div class="card shadow ">
            <div class="card-header border-3">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="mb-0">{{ __('Periodos') }}</h4>
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
                            <th scope="col">Periodo</th>
                            <th scope="col">Año</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($periodos as $periodo)
                        <tr>
                            <th scope="row"></th>
                            <th scope="row">
                                {{ $periodo->descripcion }}
                            </th>
                            <th scope="row">
                                {{ $periodo->anio }}
                            </th> 
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $periodos->links() }}
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
                                    <strong>{{ __('Nuevo Periodo') }}</strong>
                                </div>

                                    <form role="form" method="post" action="{{  route('agregarPeriodo') }}" autocomplete="off">
                                        @csrf
                                        @method('post')
                                        <div class="form-group mb-3">
                                          <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                                </div>
                                                <select name="periodo" id="periodo" class="form-control">
                                                    <option value="">Periodo</option>
                                                    <option value="ENE-JUN">ENE-JUN</option>
                                                    <option value="AGO-DIC">AGO-DIC</option>
                                                    <option value="Verano">Verano</option>
                                                    <option value="Invierno">Invierno</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                                </div>
                                                <input class="form-control" name="anio" placeholder="Año" type="text" value="{{ old('anio') }}">
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


@endsection

