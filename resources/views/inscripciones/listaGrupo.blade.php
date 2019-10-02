@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')
<div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center" >
    <div class="col-lg col-md">
        <h4 class="text-dark">Grupo {{ $grupo[0]->grupo }} {{ $grupo[0]->nivel }}{{ $grupo[0]->modulo }}</h4>
        <h6 class="text-dark">{{ $grupo[0]->edificio }}{{ $grupo[0]->aula }} {{ $grupo[0]->hora }}</h6>
    </div>
</div>
    <div class="container-fluid m--t"> 
        <div class="text-right">
            <a href="{{ back() }}" class="btn btn-outline-primary btn-sm mt-4">
                <span>
                    <i class="fas fa-reply"></i> &nbsp; Regresar
                    <input type="hidden" name="periodo" value="{{ $grupo[0]->periodo }}">
                </span>
            </a>
        </div>
        <div class="row">
           
            <div class="col-md">
                    {{-- @include('flash-message') --}}
            </div>
            
            </div>
        <div class="card-body">
            @include('flash-message')
        </div>
        <div class="pl-lg-4"> @php $nivel =  $grupo[0]->nivel.$grupo[0]->modulo @endphp
            <form method="post" action="{{ route('guardarLista') }}" autocomplete="off">
                @csrf
                @method('post')
                <input type="hidden" name="grupo" value="{{ $grupo[0]->id_grupo }}">
                <input type="hidden" name="periodo" value="{{ $grupo[0]->periodo }}">
                <input type="hidden" name="cupo" value="{{ $grupo[0]->cupo }}">
                <div class="row">
                        <div class="col-xl-6 " >
                                <div class="card shadow " >
                                    <div class="card-header border-3">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h6 class="heading-small text-muted mb-4">{{ __('Estudiantes Posibles a Inscripción') }}</h6>
                                            </div>
                                            
                                        </div>
                                    </div>
                                    {{-- <div class="table-responsive" > --}}
                                        <table class="table align-items-center table-flush th" id="datatable"> {{-- style="width:500px;height:500px;overflow-y:auto;" --}}
                                            <thead class="thead-light">
                                                <tr>
                                                    <th scope="col">Número <br> de Control</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Inscribir</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($aprobados as $alumno)
                                                <tr>
                                                <th scope="row">
                                                    {{ $alumno->num_control }}
                                                </th>
                                                <th scope="row">
                                                    {{ $alumno->nombres }} {{ $alumno->ap_paterno }} {{ $alumno->ap_materno }}
                                                </th>
                                                <td scope="row">
                                                    <span id="alumnoid" data-alumnoid="{{ $alumno->num_control }}" data-nombre="{{ $alumno->nombres }} {{ $alumno->ap_paterno }} {{ $alumno->ap_materno }}">
                                                        <input type="checkbox" name="inscribir[]" value="{{ $alumno->num_control }}">
                                                    </span>
                                                </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    {{-- </div> --}}
                                </div>
                            </div>
            
                    <div class="col-xl-6">
                        <div class="card shadow" >
                            <div class="card-header border-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="heading-small text-muted mb-4">{{ __('Estudiantes Inscritos') }}</h6>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush th" id="datatable2">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Núm.</th>
                                            <th scope="col">Número <br> de Control</th>
                                            <th scope="col">Nombre</th>
                                            {{-- <th scope="col">Carrera</th> --}}
                                            <th scope="col">Quitar de <br> la lista</th>
                                        </tr>
                                    </thead>
                                    <tbody>@php ($i=1)
                                        @foreach ($alumnos_en_el_grupo as $ag)
                                        <tr>
                                        <th scope="row">
                                           {{ $i }}
                                        </th>
                                        <th scope="row">
                                            {{ $ag->num_control }}
                                        </th>
                                        <th scope="row">
                                            {{ $ag->nombres }} {{ $ag->ap_paterno }} {{ $ag->ap_materno }}
                                        </th>
                                        <td scope="row">
                                            <span>
                                                <input type="checkbox" name="quitar[]" value="{{ $ag->num_control }}">    
                                            </span>{{-- <span id="alumnoid" class="quitar" data-alumnoid="{{ $ag->num_control }}" data-nombre="{{ $ag->nombres }} {{ $ag->ap_paterno }} {{ $ag->ap_materno }}"><i class="fas fa-times"></i></span> --}}
                                        </td>
                                        {{-- <input type="hidden" id="array" name="id[]" value="{{ $ag->num_control }}"> --}}
                                        </tr>@php ($i++)
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                </div>  
                <div class="text-center">
                    <button type="submit" class="btn btn-primary mt-4" id="guardar">{{ __('Guardar') }}</button>
                </div>
            </form>
        </div>
        <br><br>
        @include('layouts.footers.nav')
    </div>
{{-- modal para cupo del grupo --}}
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
                    <div class="modal-body">
                        
                        <div class="py-3 text-center">
                                <i class="fas fa-times fa-3x" style="color:#CD5C5C;"></i>
                            <h4 class="heading mt-4">¡El grupo esta lleno!</h4>
                            <p>Ya no puedes agregar m&aacute;s estudiantes al grupo, verifica que sean los que realmente quieres agregar, o agrega en un grupo distinto.</p>
                            <input type="hidden" name="alumno_id" id="alumno_id" value="">
                        </div>
                        
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger text-center ml-auto" data-dismiss="modal">Ok</button> 
                    </div>
                </div>
            </div>
        </div>
            </div>
            

    {{-- @section('script')
    <script>
        // cambiar de tabla a los alumnos conforme los inscriben 
        var i =  {{ $i }}
         $(document).ready(function(){
            $('#datatable tbody tr').on('click','#alumnoid',function(){ 
                var nc = $(this).attr('data-alumnoid');
                var nombre = $(this).attr('data-nombre');
                if (i <= 30) {
                    $(this).closest('tr').hide();
                    $('#datatable2 tbody').append('<tr> '+
                                                    '<th scope="row">'+
                                                         i +
                                                    '</th>'+
                                                    ' <th scope="row" value="'+ nc +'">'+
                                                         nc +
                                                    ' </th>'+
                                                    ' <th scope="row">'+
                                                         nombre +
                                                    ' </th>'+
                                                    ' <td scope="row">'+
                                                        '<span id="alumnoid" class="quitar" data-alumnoid="'+ nc+'" data-nombre="'+nombre+'" > <i class="fas fa-times"></i> </span>'+
                                                    ' </td> '+
                                                '</tr>  '+
                                                '<input type="hidden" name="id[]" value="'+ nc +'">');
                    i++;
                } else {
                   $('#modal-notification').modal('show')
                } 
            });
        });

        //quitar de la lista
        $(document).ready(function(){
            $('#datatable2 tbody tr').on('click','.quitar', function(){ 
                var nc = $(this).attr('data-alumnoid');
                var nombre = $(this).attr('data-nombre');
                $(this).closest('tr').hide();
                $('#datatable tbody tr').closest('tr data-alumnoid="'+nc+'"').show();
                    // $('#datatable tbody').append('<tr>'+
                    //                             '<th scope="row">'+
                    //                                 nc +
                    //                             '</th>'+
                    //                             '<th scope="row">'+
                    //                                 nombre +
                    //                             '</th>'+
                    //                             '<td scope="row">'+
                    //                                 '<span id="alumnoid" data-alumnoid="'+ nc +'" data-nombre="'+ nombre +'"><i class="fas fa-folder-plus"></i></span>'+
                    //                             '</td>'+
                    //                             '</tr>');
                //     i++;
                // } else {
                //    $('#modal-notification').modal('show')
                    
                // } 
            });
        });

        </script>
    @endsection --}}
@endsection