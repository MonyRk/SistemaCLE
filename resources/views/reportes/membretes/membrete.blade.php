@extends('layouts.app')

@section('sidebar')
@include('layouts.navbars.sidebar')
@endsection

@section('content')

<div class="container-fluid mt-4">
    <div class="text-right">
        <a href="{{ route('catalogos') }}" class="btn btn-outline-primary btn-sm mt-4">
            <span>
                <i class="fas fa-reply"></i> &nbsp; Regresar
            </span>
        </a>
    </div>
    <div>
        <br><br>
    <form method="post" action="" autocomplete="off">
        @csrf
        @method('post')
        <div class="row">    
            <div class="col-xl">
                <div class="col-xl">
                    <div class="card shadow ">
                        <div class="table-responsive">
                            <table id="tabledata" class="table align-items-center table-flush th">
                                <thead class="thead-light">
                                    <tr class="card-header">
                                        <th class="text">Membrete </th>
                                        <th class="text">Editar</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    {{-- @foreach ($alumnos_inscritos as $alumno)  --}}
                                        <tr class="hide">
                                        <td>{{ $membrete[0]->descripcion }}</td>
                                            <td>
                                                <a href="" data-idm="{{ $membrete[0]->id }}" data-m="{{ $membrete[0]->descripcion }}" data-toggle="modal" data-target="#modal-edit"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    {{-- @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <br><br>
    @include('layouts.footers.nav')
</div>

<div class="col-md-6">
    <div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
        <div class="modal-dialog modal- modal-dialog-centered " role="document">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <div class="card bg-lighter shadow border-0">
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <strong>{{ __('Editar Membrete') }}</strong>
                            </div>

                            <form role="form" method="post" action="{{  route('guardarPregunta','test') }}" autocomplete="off">
                                @csrf
                                @method('patch')
                                
                                <div class="form-group mb-3">
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <input class="form-control" name="pregunta" id="descripcionEdit" placeholder="Pregunta" type="text" value="{{ old('pregunta') }}">
                                    </div>
                                </div>                               
                                <input type="hidden" id="idme" name="idme" value="">
                                <div class="text-center">
                                    <button type="sumbit" class="btn btn-primary my-4">{{ __('Actualizar') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script>
// {{-- editar --}}
    $('#modal-edit').on('show.bs.modal', function(event) {
        // console.log('open');
        var button = $(event.relatedTarget)
        var idmem = button.attr('data-idm')
        // var idmem = button.data('idpreg')
        var descripcion = button.attr('data-m')
        // console.log(idmem);
        var modal = $(this)
        modal.find('.modal-body #descripcionEdit').val(descripcion);
        modal.find('.modal-body #idme').val(idmem);
    });


        

</script>
@endsection


@endsection