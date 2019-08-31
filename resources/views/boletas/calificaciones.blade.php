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
    <div class="text-right">
        <a href=" {{ route('boletas') }} " class="btn btn-outline-primary mt-3">
            <span>
                <i class="fas fa-reply"></i> &nbsp; Regresar
            </span>
        </a>
    </div> <br>
    <div>
        <!-- Editable table -->
<div class="card">
        
        {{-- <div class="card-body"> --}}
          <div id="table" class="table-editable">
            
            <table class="table table-bordered table-responsive-md table-striped text-center table align-items-center table-flush th">
              <thead>
                <tr class="card-header">
                  <th class="text-center">N&uacute;mero <br>de Control </th>
                  <th class="text-center">Estudiante</th>
                  <th class="text-center">Parcial 1</th>
                  <th class="text-center">Parcial 2</th>
                  <th class="text-center">Parcial 3</th>
                  <th class="text-center">Final</th>
                </tr>
              </thead>
              <tbody>
               
                <tr class="hide">
                  <td class="pt-3-half" contenteditable="true">Elisa Gallagher</td>
                  <td class="pt-3-half" contenteditable="true">31</td>
                  <td class="pt-3-half" contenteditable="true">Portica</td>
                  <td class="pt-3-half" contenteditable="true">United Kingdom</td>
                  <td class="pt-3-half" contenteditable="true">London</td>
                  <td class="pt-3-half">Final</td>
                  
                </tr>
              </tbody>
            </table>
          </div>
        {{-- </div> --}}
      </div>
      <!-- Editable table -->
    </div>
        {{-- <div class="text-right">
            <a href="" class="btn btn-primary mt-2 mb-2">
                <span>
                    <i class="fas fa-file-download"></i>
                </span>
            </a>
        </div>
   

    <form method="post" action="{{ route('calificar',$alumno[0]->num_control) }}" autocomplete="off">
        @csrf
        @method('post')
        <div class="col-xl" >
                <div class="card shadow " >
                    <div class="card-header border-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h1 class="heading-small text-muted mb-4 text-center">
                                    Estudiante: <strong>{{ $alumno[0]->nombres }} {{ $alumno[0]->ap_paterno }}  @if($alumno[0]->ap_materno) {{ $alumno[0]->ap_materno }} @endif</strong>
                                </h1>
                            </div>
                            
                        </div>
                    </div>
                    <div class="table-responsive" >
                        <table class="table align-items-center table-flush th" id="tabledata"> {{ --style="width:500px;height:500px;overflow-y:auto;"-- }}
                            <thead class="thead-light">
                                <tr>  
                                    <th >Nivel: <strong>{{ $alumno[0]->nivel }}{{ $alumno[0]->modulo }}</strong></th>
                                    <th >Idioma: <strong>{{ $alumno[0]->idioma }}</strong></th>
                                    <th colspan="2">Grupo: <strong>{{ $alumno[0]->grupo }}</strong></th>     
                                </tr>
                                <tr>
                                    <th >Hora: <strong>{{ $alumno[0]->hora }}</strong></th>
                                    <th >Periodo: <strong>{{ $alumno[0]->descripcion }} {{ $alumno[0]->anio }}</strong></th>
                                    <th colspan="2">Docente: <strong>{{ $docente[0]->nombres }} {{ $docente[0]->ap_paterno }} @if($alumno[0]->ap_materno) {{ $docente[0]->ap_materno }} @endif</strong></th>
                                </tr>
                            </thead>
                            <tbody class="table-bordered text-center">
                                <tr>
                                    <td  name= "c[]" id="1" >@if ( $calificacion[0]->calif1 == null ) 0 @else {{ $calificacion[0]->calif1 }} @endif</td>
                                    <td  name= "c[]" id="2" value="">@if ( $calificacion[0]->calif1 == null ) 0 @else {{ $calificacion[0]->calif2 }} @endif</td>
                                    <td  name= "c[]" id="3" value="">@if ( $calificacion[0]->calif1 == null ) 0 @else {{ $calificacion[0]->calif3 }} @endif</td>
                                    <th  id="fin"></th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
       
    <div class="text-center">
        <button type="submit" class="btn btn-primary mt-4">{{ __('Guardar') }}</button>
    </div>
</form>
</div> --}}

    @section('script')
        <script>
        $(function () {
            var suma = 0;
            $("#tabledata td").click(function (e) {
                e.preventDefault(); // <-- consume event
                e.stopImmediatePropagation();
        
            $this = $(this);

            if ($this.data('editing')) return;  
        
            var val = $this.text();
        
            $this.empty()
            $this.data('editing', true);       
            console.log($('<input type="text" class="editfield" name="calif[]">').val(val).appendTo($this));
            // $('<input type="text" class="editfield">').val(val).appendTo($this);
        });

        putOldValueBack = function () {
            
            $("#tabledata .editfield").each(function(){
                $this = $(this);
                var val = $this.val(); 
                var td = $this.closest('td');
                td.empty().html(val).data('editing', false);
                suma = suma + parseInt(val);
                var calif = suma/3;
                console.log(calif);
                $("#3").closest('th').append('<th scope="row" id="fin">'+calif+'</th>');
            });

            
        }


        $(document).click(function (e) {
            putOldValueBack();
            
        });
    });

        
    
        </script>
    @endsection
@endsection