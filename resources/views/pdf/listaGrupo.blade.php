<!DOCTYPE html>
<html>
<head>
<style>
table, th, td{
    table-layout: fixed;
    border: 1px solid black;
    border-collapse: collapse;
    font-size: 8pt;
    /* width: 250px; */
    border-collapse: collapse;
}

.col-small {
    width: 8%;
    word-wrap: break-word;
    /* border-collapse: collapse; */
}

.col-3-transparent {
    width: 3%;
    word-wrap: break-word;
    border: 0;
    /* border-collapse: collapse; */
}

.col-med {
    width: 28%;
    word-wrap: break-word;
    /* border-collapse: collapse; */
}
.col-17 {
    width: 14%;
    word-wrap: break-word;
    /* border-collapse: collapse; */
}

.col-3 {
    width: 3%;
    word-wrap: break-word;
    /* border-collapse: collapse; */
}

/* tr{
    height: 8px;
} */
</style>

</head>
<body>
<br><br><br><br>
<table style="width:100%">
    <thead>
        <tr>
            <th align="center" colspan="44">{{ $membrete[0]->descripcion }}</th>
        </tr>
        <tr>
            <th scope="col" class="col-3-transparent">&nbsp;</th>
            <th scope="col" colspan="2">Group: <strong>{{ $datosGrupo[0]->grupo }}</strong> </th>
            <th scope="col" colspan="13">Level: <strong>{{ $datosGrupo[0]->nivel }}{{ $datosGrupo[0]->modulo }}</strong></th>
            <th scope="col" colspan="14"><strong>{{ $datosGrupo[0]->hora }}</strong></th>
            <th scope="col" colspan="14"> Classroom: <strong>{{ $datosGrupo[0]->edificio}}{{$datosGrupo[0]->num_aula}}</strong></th>
        </tr>
        <tr>
            <th></th>
            <th scope="col" colspan="3">Teacher: <strong>{{ $datosGrupo[0]->nombres }} {{ $datosGrupo[0]->ap_paterno }} @if ($datosGrupo[0]->ap_materno!=null){{ $datosGrupo[0]->ap_materno }} @endif</strong></th>
            <th scope="col" colspan="20"><strong>@if ($datosGrupo[0]->modalidad == 'Semanal'){{ 'Monday to Friday' }} @else Saturday @endif</strong></th>
            <th scope="col" colspan="20"><strong>@if( $datosGrupo[0]->descripcion == 'ENE-JUN' ) JAN-JUN @else AUG-DEC @endif {{ $datosGrupo[0]->anio }}</strong></th>
        
        </tr>
        <tr>
            {{-- <th ROWSPAN=2 scope="col" class="col-3">&nbsp;</th> --}}
            <th ROWSPAN=2 scope="col" class="col-3">No.</th>
            <th ROWSPAN=2 scope="col" class="col-small">No. de <br> Control</th>
            <th ROWSPAN=2 scope="col" class="col-med">Student's Name</th>
            <th ROWSPAN=2 scope="col" class="col-17">College <br> Career</th>
            <th scope="col" style="width:50%" colspan="40">Month:</th>
        </tr>
        <tr>
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
    </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($alumnos_en_el_grupo as $alumno) 
                    
                    <tr>
                        {{-- <td class="col-3-transparent"></td> --}}
                        <td>
                            {{ $i }}
                        </td>
                        <td scope="row">
                            {{ $alumno->num_control }}
                        </td>
                        <td scope="row">
                            {{ $alumno->ap_paterno }} @if($alumno->ap_materno != null) {{ $alumno->ap_materno }} @endif {{ $alumno->nombres }}
                        </td>
                        <td scope="row">
                            @if($alumno->carrera=='Ingeniería en Sistemas Computacionales')Ing. Sist. Com. @endif
                            @if($alumno->carrera=='Ingeniería en Gestión Empresarial')Ing. Gesti&oacute;n E. @endif
                            @if($alumno->carrera=='Licenciatura en Administración')Ing. Sist. Com. @endif
                            @if($alumno->carrera=='Ingeniería Civil')Ing. Civil @endif
                            @if($alumno->carrera=='Ingeniería Industrial')Ing. Industrial @endif
                            @if($alumno->carrera=='Ingeniería Mecánica')Ing. Mec&aacute;nica @endif
                            @if($alumno->carrera=='Ingeniería Eléctrica')Ing. El&eacute;ctrica @endif
                            @if($alumno->carrera=='Ingeniería Electrónica')Ing. Electr&oacute;nica @endif
                            @if($alumno->carrera=='Ingeniería Química')Ing. Qu&iacute;mica @endif
                            @if($alumno->carrera=='Externo')Externo @endif
                            {{-- @else
                                @if($alumno->carrera=='Ingeniería en Gestión Empresarial')Ing. Gesti&oacute;n E.
                                @else
                                    @if($alumno->carrera=='Licenciatura en Administración')Lic. Admin.
                                    @else    
                                        {{ $alumno->carrera }}
                                    @endif
                                @endif
                            @endif --}}
                            
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