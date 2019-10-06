<!DOCTYPE html>
<html>
<head>
<style>
/* table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  table-layout: fixed;
}


th, td {
    width: 100px;
    word-wrap: break-word;
} */
table, th, td{
    table-layout: fixed;
    border: 1px solid black;
    border-collapse: collapse;
    /* width: 250px; */
}

.col-small {
    width: 10%;
    word-wrap: break-word;
    /* border-collapse: collapse; */
}
.col-med {
    width: 30%;
    word-wrap: break-word;
    /* border-collapse: collapse; */
}
.col-17 {
    width: 17%;
    word-wrap: break-word;
    /* border-collapse: collapse; */
}

.col-3 {
    width: 3%;
    word-wrap: break-word;
    /* border-collapse: collapse; */
}
</style>

</head>
<body>

{{-- <h2>Grupo: {{ $alumnos_en_el_grupo[0]->grupo }}</h2> --}}
<div class="text-center">
    <img src="{{ asset('argon') }}/img/brand/cabeceraSM.png" alt="cabecera" title="cabecera">
</div>
<br><br>
{{-- <h4>Grupo: {{ $alumnos_en_el_grupo[0]->grupo }}</h4> --}}

<table style="width:100%">
    <thead>
        <tr>
            <th scope="col">Group: {{ $datosGrupo[0]->grupo }}</th>
            <th scope="col">Level: {{ $datosGrupo[0]->nivel }}{{ $datosGrupo[0]->modulo }}</th>
            <th scope="col">{{ $datosGrupo[0]->descripcion }} {{ $datosGrupo[0]->anio }}</th>
        </tr>
        <tr>
            <th scope="col">Teacher: {{ $datosGrupo[0]->nombres }} {{ $datosGrupo[0]->ap_paterno }} @if ($datosGrupo[0]->ap_materno!=null){{ $datosGrupo[0]->ap_materno }} @endif</th>
            <th scope="col">{{ $datosGrupo[0]->hora }}</th>
            <th scope="col">{{ $datosGrupo[0]->modalidad }}</th>
        </tr>
    </thead>
</table>
<br>
<table style="width:100%" id="datatable">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" class="col-3">No.</th>
                        <th scope="col" class="col-small">No. de <br>Control</th>
                        <th scope="col" class="col-med">Student's Name</th>
                        <th scope="col" class="col-17">Degree</th>
                        <th scope="col" style="width:50%" colspan="25">Month:</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($alumnos_en_el_grupo as $alumno) 
                    
                    <tr>
                        <td>
                            {{ $i }}
                        </td>
                        <td scope="row">
                            {{ $alumno->num_control }}
                        </td>
                        <td scope="row">
                           {{ $alumno->nombres }} {{ $alumno->ap_paterno }} @if($alumno->ap_materno != null) {{ $alumno->ap_materno }} @endif
                        </td>
                        <td scope="row">
                            @if($alumno->carrera=='Ingeniería en Sistemas Computacionales')Ing. Sist. Com. 
                            @else
                                @if($alumno->carrera=='Ingeniería en Gestión Empresarial')Ing. Gesti&oacute;n E.
                                @else
                                    @if($alumno->carrera=='Licenciatura en Administración')Lic. Admin.
                                    @else    
                                        {{ $alumno->carrera }}
                                    @endif
                                @endif
                            @endif
                            
                        </td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        <td scope="row"></td>
                        
                    </tr>
                    @php
                        $i++
                    @endphp
                    @endforeach
                </tbody>
            </table>

</body>
</html>
                    <div class="table-responsive">
                        <!-- Projects table -->
                        
                        
                    </div>
                </div>
            </div>
        </div>
{{-- endsection contenido --}}
        
    </div>
</body>
</html>