<!DOCTYPE html>
<html>

<head>
    <style>
        table,
        th,
        td {
            table-layout: fixed;
            border: 1px solid black;
            border-collapse: collapse;
            
        }

        .alto-30 {
            height: 30px;
        }

        .alto-50 {
            height: 50px;
        }

        #caja {
            width: 100%;
            height: 50px;
        }

        #texto-uno {
            float: left;
            padding-left: 8%;  
            line-height: 10%;
            text-transform: uppercase
        }

        #texto-dos {
            float: right;
            padding-right: 5%;
            line-height: 20%;
            text-transform: uppercase
        }
    </style>

</head>

<body>

    {{-- <h2>Grupo: {{ $alumnos_en_el_grupo[0]->grupo }}</h2> --}}
    <div align="center">
        <img src="{{ asset('argon') }}/img/brand/cabeceraSM.png" alt="cabecera" title="cabecera">
    </div>
    <br><br><br>
    {{-- <h4>Grupo: {{ $alumnos_en_el_grupo[0]->grupo }}</h4> --}}

    <table style="width:100%">
        <thead>
            <tr>
                <th scope="col" colspan="5" align="center">
                    <H3>BOLETA DE CALIFICACIONES</H3>
                </th>

            </tr>
            <tr>
                <th scope="col" colspan="3" class="alto-30" align="center"><small>Estudiante: </small>{{ $datosEstudiante[0]->ap_paterno }} @if ($datosEstudiante[0]->ap_materno!=null){{ $datosEstudiante[0]->ap_materno }} {{ $datosEstudiante[0]->nombres }}@endif</th>
                <th scope="con" colspan="2" class="alto-30" align="center"><small>Carrera:</small> {{ $datosEstudiante[0]->carrera }}</th>

            </tr>
            <tr>
                <th scope="col" class="alto-30" align="center"><small>N&uacute;mero de Control:</small> {{ $datosEstudiante[0]->num_control }}</th>
                <th scope="col" class="alto-30" align="center"><small>Grupo:</small> {{ $datosGrupo[0]->grupo }}</th>
                <th scope="col" class="alto-30" align="center"><small>Nivel:</small> {{ $datosGrupo[0]->nivel }}{{ $datosGrupo[0]->modulo }}</th>
                <th scope="col" class="alto-30" align="center"><small>Idioma:</small> {{ $datosGrupo[0]->idioma }}</th>
                <th scope="col" class="alto-30" align="center"><small>Hora:</small> {{ $datosGrupo[0]->hora }}</th>
            </tr>
            <tr>
                <th scope="col" class="alto-30" align="center"><small>Modalidad:</small> {{ $datosGrupo[0]->modalidad }}</th>
                <th scope="col" class="alto-30" align="center"><small>Periodo:</small> {{ $datosGrupo[0]->periodo }} {{ $datosGrupo[0]->anio }}</th>

                <th scope="col" colspan="3" class="alto-30" align="center"><small>Docente:</small> {{ $datosGrupo[0]->nombres }} {{ $datosGrupo[0]->ap_paterno }} @if ($datosGrupo[0]->ap_materno!=null){{ $datosGrupo[0]->ap_materno }} @endif</th>

            </tr>
            <tr>
                <th scope="col" class="alto-30" align="center">Parcial 1</th>
                <th scope="col" class="alto-30" align="center">Parcial 2</th>
                <th scope="col" class="alto-30" align="center">Parcial 3</th>
                <th scope="col" class="alto-30" align="center">Faltas</th>
                <th scope="col" class="alto-30" align="center">Calificaci&oacute;n Final</th>
            </tr>

        </thead>
        <tbody>
            <tr class="text-center">
                <td scope="col" class="alto-50" align="center">{{ $datosEstudiante[0]->calif1 }}</td>
                <td scope="col" class="alto-50" align="center">{{ $datosEstudiante[0]->calif2 }}</td>
                <td scope="col" class="alto-50" align="center">{{ $datosEstudiante[0]->calif3 }}</td>
                <td scope="col" class="alto-50" align="center">{{ $datosEstudiante[0]->faltas }}</td>
                <td scope="col" class="alto-50" align="center">{{ $datosEstudiante[0]->calif_f }}</td>
            </tr>
        </tbody>
    </table>


<br><br><br>

<p align="center">Vo. Bo.</p>
<br><br><br><br><br>
<div id="caja">
    <div id="texto-uno">
        {{ $datosGrupo[0]->nombres }} {{ $datosGrupo[0]->ap_paterno }} @if ($datosGrupo[0]->ap_materno!=null){{ $datosGrupo[0]->ap_materno }} @endif
    </div>
    <div id="texto-dos">
        LIC. JUANA ISABEL RAM&Iacute;REZ HERN&Aacute;NDEZ
    </div>
    <br>
    <div id="texto-uno">
        <small> DOCENTE
    </div>
    <div id="texto-dos">
        JEFA DE LA DIVISI&Oacute;N DE ESTUDIOS PROFESIONALES</small>
    </div>
</div>

</body>

</html>