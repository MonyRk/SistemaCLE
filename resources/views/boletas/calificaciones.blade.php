@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')


<div class="container-fluid m--t">
    <div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center" >
        <div class="col-lg col-md">
            <h4 class="text-dark">Grupo {{ $infoGrupo[0]->grupo }} {{ $infoGrupo[0]->nivel }}{{ $infoGrupo[0]->modulo }}</h4>
            <h6 class="text-dark">{{ $infoGrupo[0]->edificio }}{{ $infoGrupo[0]->aula }} {{ $infoGrupo[0]->hora }}</h6>
        </div>
    </div>
    <div class="msj">
        @include('flash-message')
    </div>
    <div class="text-right mb-5">
        <a href=" {{ route('boletas') }} " class="btn btn-outline-primary mt-3">
            <span>
                <i class="fas fa-reply"></i> &nbsp; Regresar
            </span>
        </a>
    </div> 
    
    <form id="formtable">
            @csrf
        {{-- @method('post') --}}
        <div class="row">    
            <div class="col-xl">
                <div class="col-xl">
                    <div class="card shadow ">
                        <div class="table-responsive">
                            <table id="tabledata" class="table align-items-center table-flush th">
                                <thead class="thead-light">
                                    <tr class="card-header">
                                        <th class="text">N&uacute;mero <br>de Control </th>
                                        <th class="text">Estudiante</th>
                                        <th class="text">Parcial 1</th>
                                        <th class="text">Parcial 2</th>
                                        <th class="text">Parcial 3</th>
                                        <th class="text">Faltas</th>
                                        <th class="text">Final</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alumnos_inscritos as $alumno) 
                                        <tr class="hide">
                                            <td id="num" class="num_control pt-3-half" contenteditable="false">{{ $alumno->num_control }}</td>
                                            {{-- <input type="hidden" name="nc" value="{{ $alumno->num_control }}"> --}}
                                            <th class="pt-3-half" contenteditable="false">{{ $alumno->ap_paterno }} {{ $alumno->ap_materno }} {{ $alumno->nombres }} </th>
                                            <td id="c1" class="1 pt-3-half" @if ($alumno->calif1 == null) contenteditable="true" @else contenteditable="false" @endif>@if ( $alumno->calif1 == null ) 0 @else{{ $alumno->calif1 }} @endif</td>
                                            <td id="c2" class="2 pt-3-half" @if ($alumno->calif2 == null) contenteditable="true" @else contenteditable="false" @endif>@if ( $alumno->calif2 == null ) 0 @else{{ $alumno->calif2 }} @endif</td>
                                            <td id="c3" class="3 pt-3-half" @if ($alumno->calif3 == null) contenteditable="true" @else contenteditable="false" @endif>@if ( $alumno->calif3 == null ) 0 @else{{ $alumno->calif3 }} @endif</td>
                                            <td class="pt-3-half" contenteditable="true">faltas</td>
                                            <th class="pt-3-half">@php $f =0; $f= round(($alumno->calif1+$alumno->calif2+$alumno->calif3)/3) @endphp {{ $f }}</th>
                                            {{-- <input type="hidden" name="num_control[{{ $alumno->num_control }}]" value="{{ $alumno->calif1 }}"> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" id="guardar" class="btn btn-primary mt-4">Guardar</button>
        </div>
    </form>
</div>

    @section('script')
        <script>
            var json="";
            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('#formtable').on('submit',function(e){
                    e.preventDefault();
                    // var todo= [];


                    // todo
                    // $('#tabledata tbody tr').each(function(index){
                    //     var uno = [];
                    //     $(this).find('td').each(function(index) {
                    //         uno [index]= $(this).html() + ",";
                    //     });
                    //      todo[index]=uno;
                    // });
                    //  console.log(todo);

                    // funtion guardar(tablaid){
                    //     var t = $('#'+tablaid+'')
                    // }


                    $("table tbody tr").each(function () {
                        json ="";
                        $(this).find("td").each(function () {
                            $this=$(this);
                            json+=',"'+$this.attr("id")+'":"'+$this.html()+'"'
                        });
                        obj=JSON.parse('{'+json.substr(1)+'}');
                        console.log(obj);
                    });
                    // var arr = obj.pushItem
                    

                    // console.log(json);
                    $.ajax({
                        type:'POST',
                        url:"{{ route('guardarCalificaciones') }}",
                        data:json,
                        // dataType:'json',
                        success:function(data){
                            // var datos = data.responseText;
                            console.log(data);
                            // $('.msj').append('<div class="alert alert-danger alert-block">'+
                            //                 '<button type="button" class="close" data-dismiss="alert">×</button>'+
                            //                 '<strong>Exito</strong>'+
                            //                 '</div>')
                        },
                        
                    });
                });
            });
        </script>
    @endsection
@endsection




