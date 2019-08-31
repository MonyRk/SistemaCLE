@extends('layouts.app')
@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection
@section('content')

    <div class="container-fluid">
        <div class="row">
            <!-- espacio de busqueda-->
            <div class="col-md">
                @include('flash-message')
            </div>
            <div class="col-md">
                    <div class="text-right">
        
                            <a href="{{ route('periodoinscripciones') }}" class="btn btn-outline-primary mt-4">
                                <span>
                                    <i class="fas fa-reply"></i> &nbsp; Regresar
                                </span>
                            </a>
                        </div>
                <div class="">
                    <div class="text-right">
                        <form action=" {{ route('buscarGrupoInscripcion') }} " method="GET" class="navbar-search navbar-search-dark form-inline mr-5 d-none d-md-flex ml-lg-9"  style="margin-top: 15px" >
                            <div class="form-group mb-0">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input name="buscar" class="form-control" placeholder="Buscar" type="text">
                                    <input type="hidden" name="per" value="{{ $p[0]->id_periodo }}">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<br>
            <!-- header de la tabla-->
        <div class="row">    
            <div class="col-xl">
                <div class="col-xl">
                    <div class="card shadow ">
                        <div class="card-header border-3">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h4 class="mb-0">{{ __('Grupos del periodo ') }}{{ $p[0]->descripcion }} {{ $p[0]->anio }}</h4>
                                </div> 
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table align-items-center table-flush th">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Grupo</th>
                                        <th scope="col">Nivel</th>{{--viene nivel y modulo --}}
                                        <th scope="col">Idioma</th>
                                        <th scope="col">Aula</th>
                                        <th scope="col">Hora</th>
                                        <th scope="col">Docente</th>
                                        <th scope="col">Inscribir</th>
                                        <th scope="col">Lista</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($grupos as $grupo)
                                    <tr>
                                        <th scope="row">
                                           <span> {{ $grupo->grupo }}</span>
                                        </th>
                                        <th>
                                            {{ $grupo->nivel }}{{ $grupo->modulo }}
                                        </th>
                                        <th>
                                            {{ $grupo->idioma }}
                                        </th>
                                        <th>
                                            {{ $grupo->edificio }}{{ $grupo->num_aula }}
                                        </th>
                                        <th>
                                            {{ $grupo->hora }}
                                        </th>
                                        <th> 
                                            {{ $grupo->nombres }} {{ $grupo->ap_paterno }} {{ $grupo->ap_materno }}
                                        </th>
                                        <td>
                                            <a href="{{ route('inscribirEstudiantes',$grupo->id_grupo) }}"><i class="far fa-list-alt"></i></a>
                                        </td>
                                        <td>
                                            <a href=""><i class="fas fa-file-download"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $grupos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div> 


@endsection
 



