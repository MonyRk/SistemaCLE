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
            word-wrap: break-word;
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
        .ancho-40{
            width: 40px;
        }
        .ancho-50{
            width: 50px;
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
    $i=1;
@endphp
    <table style="width:100%">
       
            <thead>
                <tr>
                    <th scope="col" class="ancho-30">No.</th>
                    <th scope="col"> Nombre</th>
                    <th scope="col" class="ancho-40">Sexo</th>
                    <th scope="col" class="ancho-40">Edad</th>
                    <th scope="col" class="alto-50" align="center">&Uacute;ltimo Grado de Estudios</th>
                    <th scope="col" class="alto-50" align="center">Certificaci&oacute;n del Dominio del Idioma</th>
                    <th scope="col" class="alto-50" align="center">Curso de Entrenamiento para Profesores (Teacher's Training Course)</th>
                    <th scope="col" class="alto-50" align="center">Certificaciones de Did&aacute;ctica</th>
                    <th scope="col" class="alto-50 ancho-50" align="center">Años de Experiencia Docente</th>
                    <th scope="col" class="alto-50" align="center">3 &Uacute;ltimas Actualizaciones Docentes</th>
                
                </tr>
            </thead>
            <tbody>
                @foreach ($docentes as $docente)
                <tr class="text-center">
                    <td scope="col" class="alto-50 ancho-30" align="center">{{ $i++ }}</td>
                    <td scope="col" class="alto-50" align="center">{{ $docente->nombres }} {{ $docente->ap_paterno }} {{ $docente->ap_materno }}</td>
                    <td scope="col" class="alto-50 ancho-40" align="center">{{ $docente->sexo }}</td>
                    <td scope="col" class="alto-50 ancho-40" align="center">{{ $docente->edad }}</td>
               
                    <td scope="col" class="alto-50" align="center">{{ $docente->grado_estudios }}</td>
                    <td scope="col" class="alto-50" align="center">{{ $docente->dominio_idioma }}</td>
                    <td scope="col" class="alto-50" align="center">{{ $docente->curso }}</td>
                
                    <td scope="col" class="alto-50" align="center">
                        @php $didacticas = ""; $didacticas = explode(';',$docente->didactica); @endphp
                        @foreach ($didacticas as $nombre_didactica)
                            {{ $nombre_didactica }}
                        @endforeach
                    </td>
                    <td scope="col" class="alto-50 ancho-50" align="center">{{ $docente->experiencia }}</td>
                    <td scope="col" class="alto-50" align="center">
                        @php $actualizaciones = ""; $actualizaciones = explode(';',$docente->actualizacion); @endphp
                        @foreach ($actualizaciones as $nombre_actualizacion)
                            {{ $nombre_actualizacion }}
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
      
    </table>

</body>

</html>