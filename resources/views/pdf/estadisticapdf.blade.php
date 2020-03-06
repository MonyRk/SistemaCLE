<!DOCTYPE html>
<html>

<head>
    <style>
        table,
        th,
        td {
            table-layout: fixed;
            border: 1px solid #F57C00;
            border-collapse: collapse;
            
        }

        .alto-30 {
            height: 30px;
        }
    </style>

</head>

<body>

    <div align="center">
        <img src="{{ asset('argon') }}/img/brand/cabeceraL.png" alt="cabecera" title="cabecera">
        <p>{{ $membrete[0]->descripcion }}</p>
    </div>
<br>
    <table style="width:100%">
        <thead>
            <tr>
                <th scope="col" colspan="5" align="center" bgcolor="#F57C00">
                    <h4 style="color:white">TOTAL DE NIVELES DE INGL&Eacute;S <br>
                        {{ $periodo[0]->descripcion }} {{ $periodo[0]->anio }}
                    </h4>
                </th>
            </tr>
            <tr bgcolor="#FDDDBB">
                <th scope="col" class="alto-30" align="center">Niveles</th>
                <th scope="col" class="alto-30" align="center">Lunes a Viernes</th>
                <th scope="col" class="alto-30" align="center">S&aacute;bados</th>
                <th scope="col" class="alto-30" align="center">Total Grupos</th>
                <th scope="col" class="alto-30" align="center">Total Estudiantes</th>
            </tr>

        </thead>
        <tbody>
            @php
                $i = 0;
                $semanales = 0;
                $sabatinos = 0;
                $alumnos = 0;
            @endphp
           @foreach ($niveless as $nivel)
                <tr class="text-center" @if ($i==1||$i==3||$i==5) bgcolor="#FDDDBB" @endif>
                    <td scope="col" class="alto-30" align="center">{{ $nivel->nivel }}{{ $nivel->modulo }}</td>
                    <td scope="col" class="alto-30" align="center" >{{ $grupos_semanales[$i] }}</td>
                    <td scope="col" class="alto-30" align="center">{{ $grupos_sabatinos[$i] }}</td>
                    <td scope="col" class="alto-30" align="center">{{ $grupos_semanales[$i]+$grupos_sabatinos[$i] }}</td>
                    <td scope="col" class="alto-30" align="center">{{ $estudiantes[$i]->num_estudiantes }}</td> 
                    {{-- $estudiantes[$i] --}}
                </tr>
                @php
                    $semanales = $semanales + $grupos_semanales[$i];
                    $sabatinos = $sabatinos + $grupos_sabatinos[$i];
                    $alumnos = $alumnos + $estudiantes[$i]->num_estudiantes; // $estudiantes[$i]
                    $i++;
                @endphp
            @endforeach
            <tr class="text-center" bgcolor="#FDDDBB">
                <th scope="col" class="alto-30" align="center">Totales</th>
                <th scope="col" class="alto-30" align="center"> {{ $semanales }} </th>
                <th scope="col" class="alto-30" align="center"> {{ $sabatinos }} </th>
                <th scope="col" class="alto-30" align="center"> {{ $semanales+$sabatinos }} </th>
                <th scope="col" class="alto-30" align="center"> {{ $alumnos }} </th>
            </tr>
        </tbody>
    </table>
<br>
<p align="center">Vo. Bo. <br><br><br><br>
    <strong>M.E. GABRIELA AGUILAR ORTIZ</strong> <br>
    <small>JEFA DEL DEPTO. DE GESTI&Oacute;N TECNOL&Oacute;GICA Y VINCULACI&Oacute;N</small> 
</p>
</body>

</html>