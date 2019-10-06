@extends('layouts.app')

@section('sidebar')
    @include('layouts.navbars.sidebar')
@endsection

@section('content')
<style>
.sinborde {
   border: 0;
 }
.ancho{
    width: 100%
}
</style>

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
    <div class="text-right mb-2">
        <a href=" {{ route('boletas') }} " class="btn btn-outline-primary btn-sm mt-3">
            <span>
                <i class="fas fa-reply"></i> &nbsp; Regresar
            </span>
        </a>
    </div> 
    <div class="mb-3">
        <a href=" {{ route('actaCalificaciones',$infoGrupo[0]->id_grupo) }} " class="btn btn-outline-default btn-sm mt-3">
            <span>
                <i class="far fa-file-alt"></i> &nbsp; Acta de Calificaciones
            </span>
        </a>
    </div> 
    
    <form method="post" action="{{ route('guardarCalificaciones') }}" autocomplete="off">
        @csrf
        @method('post')
        <input type="hidden" name="grupo" value="{{ $infoGrupo[0]->id_grupo }}">
        {{-- <input type="hidden" name="periodo" value="{{ $infoGrupo[0]->periodo }}"> --}}
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
                                        <th class="text">Boleta</th>
                                    </tr>
                                </thead>
                                <tbody> @php $i=0 @endphp
                                    @foreach ($alumnos_inscritos as $alumno) 
                                        <tr class="hide">
                                            <td id="num" class="num_control pt-3-half" contenteditable="false">{{ $alumno->num_control }}</td>
                                            <input type="hidden" name="calif{{ $i }}[]" value="{{ $alumno->num_control }}">
                                            <th class="pt-3-half">{{ $alumno->ap_paterno }} {{ $alumno->ap_materno }} {{ $alumno->nombres }} </th>
                                            <td class="calif1 pt-3-half ">
                                                <input type="text" name="calif{{ $i }}[]" class="sinborde ancho"  @if($alumno->calif1==null) value="0" @else value="{{ $alumno->calif1 }}"@endif>
                                            </td>
                                            <td class="calif2 pt-3-half">
                                                <input type="text" name="calif{{ $i }}[]" class="sinborde ancho" @if($alumno->calif2==null) value="0" @else value="{{ $alumno->calif2 }}"@endif>
                                            </td>
                                            <td class="calif3 pt-3-half">
                                                <input type="text" name="calif{{ $i }}[]" class="sinborde ancho" @if($alumno->calif3==null) value="0" @else value="{{ $alumno->calif3 }}"@endif>
                                            </td>
                                            <td class="faltas pt-3-half">
                                                <input type="text" name="calif{{ $i }}[]" class="sinborde ancho" @if($alumno->faltas==null) value="0" @else value="{{ $alumno->faltas }}"@endif>
                                            </td>
                                            <th class="pt-3-half">{{ $alumno->calif_f }}</th>
                                            <td>
                                                <a href="{{ route('boletaIndividual',[$infoGrupo[0]->id_grupo,$alumno->num_control]) }}"><i class="fas fa-file-download"></i></a>
                                            </td>
                                        </tr>
                                        @php $i++ @endphp
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
    <br><br>
    @include('layouts.footers.nav')
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


{{-- <td id="c1" class="1 pt-3-half" @if($alumno->calif1==null) contenteditable="true" @else contenteditable="false"@endif >@if ( $alumno->calif1 == null ) 0 @else{{ $alumno->calif1 }} @endif</td>
                                            <td id="c2" class="2 pt-3-half"  @if($alumno->calif2==null) contenteditable="true" @else contenteditable="false"@endif >@if ( $alumno->calif2 == null ) 0 @else{{ $alumno->calif2 }} @endif</td>
                                            <td id="c3" class="3 pt-3-half" @if($alumno->calif3==null) contenteditable="true" @else contenteditable="false"@endif>@if ( $alumno->calif3 == null ) 0 @else{{ $alumno->calif3 }} @endif</td>
                                            <td class="pt-3-half" contenteditable="true">faltas</td> --}}

