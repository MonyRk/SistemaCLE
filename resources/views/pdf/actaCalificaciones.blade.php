<!DOCTYPE html>
<html>

<head>
    @php
        setlocale (LC_TIME, "es_ES");
    @endphp
    <style>
        table,
        th,
        td {
            table-layout: fixed;
            border: 1px solid black;
            border-collapse: collapse;
            /* width: 250px; */
        }

        .sinborde {
            border: none;
        }

        .dias {
            border-top: 1px solid black;
            border-right: 1px solid black;
            border-bottom: 0px;
            border-left: 1px solid black;
        }

        .hora {
            border-top: 0px;
            border-right: 0px;
            border-bottom: 1px solid black;
            border-left: 1px solid black;
        }

        .aula {
            border-top: 0px;
            border-right: 1px solid black;
            border-bottom: 1px solid black;
            border-left: 0px;
        }

        .col-small {
            width: 13%;
            word-wrap: break-word;
            /* border-collapse: collapse; */
        }

        .col-med {
            width: 35%;
            word-wrap: break-word;
            /* border-collapse: collapse; */
        }

        .col-17 {
            width: 25%;
            word-wrap: break-word;
            /* border-collapse: collapse; */
        }

        .col-3 {
            width: 5%;
            word-wrap: break-word;
            /* border-collapse: collapse; */
        }
        #texto-dos {
            float: right;
            padding-right: 30%;
            line-height: 20%;
            /* text-transform: uppercase */
        }
    </style>

</head>

<body>
    <div align="center">
        <img src="{{ asset('argon') }}/img/brand/cabeceraSM.png" alt="cabecera" title="cabecera">
    </div>
    <br><br>

    <table style="width:100%; border:none;">
        <thead style="border:none;">
            <tr>
                <th scope="col" colspan="14" style="border:none;">ACTA DE CALIFICACIONES</th>
            </tr>
            <tr>
                <td scope="col" colspan="10" style="border:none;">DEPARTAMENTO: <strong>COORDINACI&Oacute;N DE LENGUAS EXTRANJERAS</strong> </td>
                <td scope="col" colspan="4" style="border:none;">FOLIO: <strong></strong></td>
            </tr>
            <tr>
                <td scope="col" colspan="10" style="border:none;">MATERIA: <strong>{{ $infoGrupo[0]->idioma }}</strong></td>
                <td scope="col" colspan="4" style="border:none;">CLAVE: </td>
            </tr>
            <tr>
                <td scope="col" colspan="10" style="border:none;">PROFESOR: <strong>{{ $infoGrupo[0]->nombres }} {{ $infoGrupo[0]->ap_paterno }} @if ($infoGrupo[0]->ap_materno!=null){{ $infoGrupo[0]->ap_materno }} @endif</strong></td>
                <td scope="col" colspan="4" style="border:none;">GRUPO: <strong>{{ $infoGrupo[0]->grupo }}</strong> </td>
            </tr>
            <tr>
                <td scope="col" colspan="10" style="border:none;">PERIODO: <strong>{{ $infoGrupo[0]->descripcion }} {{ $infoGrupo[0]->anio }}</strong></td>
                <td scope="col" colspan="4" style="border:none;">ALUMNOS: <strong>{{ count($alumnos_inscritos) }}</strong></td>
            </tr>

        </thead>
        <tbody>
            <tr>
                <td scope="col" colspan="2" class="dias" align="center">LUNES</td>
                <td scope="col" colspan="2" class="dias" align="center">MARTES</td>
                <td scope="col" colspan="2" class="dias" align="center">MIERCOLES</td>
                <td scope="col" colspan="2" class="dias" align="center">JUEVES</td>
                <td scope="col" colspan="2" class="dias" align="center">VIERNES</td>
                <td scope="col" colspan="2" class="dias" align="center">SABADO</td>
                <td scope="col" colspan="2" class="dias" align="center">DOMINGO</td>
            </tr>
            <tr>
                @for ($i = 0; $i < 7; $i++) 
                    <td scope="col" class="hora" align="center">HORA</td>
                    <td scope="col" class="aula" align="center">AULA</td>
                @endfor

            </tr>
            <tr>
                @for ($i = 0; $i < 5; $i++) 
                    <td align="center">@if($infoGrupo[0]->modalidad=='Semanal') {{ substr($infoGrupo[0]->hora,0,-3) }}@endif</td>
                    <td align="center">@if($infoGrupo[0]->modalidad=='Semanal') {{ $infoGrupo[0]->edificio }}{{ $infoGrupo[0]->aula }}@endif</td>
                @endfor

                @for ($i = 0; $i < 2; $i++) 
                    <td align="center">@if($infoGrupo[0]->modalidad=='Sabatino') {{ substr($infoGrupo[0]->hora,0,-3) }}@endif</td>
                    <td align="center">@if($infoGrupo[0]->modalidad=='Sabatino') {{ $infoGrupo[0]->edificio }}{{ $infoGrupo[0]->aula }}@endif</td>
                @endfor


            </tr>
        </tbody>
    </table>
    <table style="width:100%" id="datatable">
        <thead class="thead-light">
            <tr>
                <th scope="col" class="col-3"><small>No.</small></th>
                <th scope="col" class="col-small"><small>No. DE <br>CONTROL</small></th>
                <th scope="col" class="col-med"><small>NOMBRE DEL ALUMNO</small></th>
                <th scope="col" class="col-17"><small>CARRERA</small></th>
                <th scope="col"><small>REP.</small></th>
                <th scope="col"><small>ORD.</small></th>
                <th scope="col"><small>COMP.</small></th>
                <th scope="col"><small>ESP.</small></th>
            </tr>
        </thead>
        <tbody>
            @php
            $i=1;
            @endphp
            @foreach ($alumnos_inscritos as $alumno)

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
            </tr>
            @php
            $i++
            @endphp
            @endforeach
        </tbody>
    </table>
<br>
    <p>
        Este documento no es válido si tiene tachaduras o enmendaduras
        <br>
        Oaxaca de Ju&aacute;rez, Oax, a {{ strftime("%e") }} de {{ strftime("%B") }} de {{ strftime("%Y") }}															
        </p>
        <p id="texto-dos">
            Firma del Profesor:
        </p>
</body>

</html>