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
        .ancho-30{
            width: 30px;
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
    {{-- <div align="center">
        <img src="{{ asset('argon') }}/img/brand/cabeceraSM.png" alt="cabecera" title="cabecera">
    </div> --}}
    <br><br>
@php
    $i=0;
@endphp
    <table style="width:100%">
       @foreach ($docentes as $docente)
            <thead>
                
            </thead>
            <tbody>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col"> Nombre</th>
                    <th scope="col" class="width-30">Sexo</th>
                    <th scope="col" class="width-30">Edad</th>
                </tr>
                <tr class="text-center">
                    <td scope="col" class="alto-50" align="center">{{ $i++ }}</td>
                    <td scope="col" class="alto-50" align="center">{{ $docente->nombres }} {{ $docente->ap_paterno }} {{ $docente->ap_materno }}</td>
                    <td scope="col" class="alto-50 width-30" align="center">{{ $docente->sexo }}</td>
                    <td scope="col" class="alto-50 width-30" align="center">{{ $docente->edad }}</td>
                </tr>
                <tr>
                    <th scope="col" class="alto-50" align="center">&Uacute;ltimo Grado de Estudios</th>
                    <th scope="col" class="alto-50" align="center">Certificaci&oacute;n del Dominio del Idioma</th>
                    <th scope="col" class="alto-50" align="center" colspan="2">Curso de Entrenamiento para Profesores (Teacher's Training Course)</th>
                </tr>
                <tr>
                    <td scope="col" class="alto-50" align="center">{{ $docente->grado_estudios }}</td>
                    <td scope="col" class="alto-50" align="center">{{ $docente->dominio_idioma }}</td>
                    <td scope="col" class="alto-50" align="center" colspan="2">{{ $docente->curso }}</td>
                </tr>
                <tr>
                    <th scope="col" class="alto-50" align="center">Certificaciones de Did&aacute;ctica</th>
                    <th scope="col" class="alto-50" align="center">Años de Experiencia Docente</th>
                    <th scope="col" class="alto-50" align="center" colspan="2">3 &Uacute;ltimas Actualizaciones Docentes</th>
                </tr>
                <tr>
                    <td scope="col" class="alto-50" align="center">
                        @php $didacticas = ""; $didacticas = explode(';',$docente->didactica); @endphp
                        @foreach ($didacticas as $nombre_didactica)
                            {{ $nombre_didactica }}
                        @endforeach
                    </td>
                    <td scope="col" class="alto-50" align="center">{{ $docente->experiencia }}</td>
                    <td scope="col" class="alto-50" align="center" colspan="2">
                        @php $actualizaciones = ""; $actualizaciones = explode(';',$docente->actualizacion); @endphp
                        @foreach ($actualizaciones as $nombre_actualizacion)
                            {{ $nombre_actualizacion }}
                        @endforeach
                    </td>
                </tr>
                <br>
            </tbody>
       @endforeach
    </table>

</body>

</html>