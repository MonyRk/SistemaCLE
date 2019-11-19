<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resultados Evaluacion</title>

    <style>
        table,
        th,
        td {
            table-layout: fixed;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .col-peq{
            width: 250px;
        }
    </style>

    
<script type="text/javascript" src="http://www.gstatic.com/charts/loader.js"></script>
@php
$k=0; $promedio=0; $promedio_final=0; $p=0; $promedios=""; $clasificacion_preguntas="";
@endphp
@foreach ($datos_clasificacion as $clasificacion)
    @foreach ($datos_respuesta as $respuesta)
            @php 
            $total = 0;
            $total = $resultados[$k]*$respuesta->valor 
            @endphp
        @php
            $promedio = $promedio + $total;
        @endphp
        @php $k++ @endphp
    @endforeach
    @php
        $p = $promedio/5;
        $promedios = $promedios.','.$p;
        $clasificacion_preguntas = $clasificacion_preguntas.','.$clasificacion->clasificacion;
        $promedio_final= $promedio_final+($promedio/5);
        $promedio=0;
    @endphp
@endforeach
@php
$clasificacion_preguntas = substr($clasificacion_preguntas,1);
$promedios = substr($promedios,1);
@endphp
{{-- {{ dd($clasificacion_preguntas,$promedios)}} --}}
<script>

        google.charts.load('current', {packages: ['corechart', 'bar']});
            google.charts.setOnLoadCallback(drawStacked);
    
            function drawStacked() {
                var $datosClasificacion = "<?php echo $clasificacion_preguntas ?>"
                var $clasificacion = $datosClasificacion.split(",");
    
                var $datosPromedios = "<?php echo $promedios ?>"
                var $dpromedios = $datosPromedios.split(",");
    
                var data = google.visualization.arrayToDataTable([
                    ['Elements','Details', { role: 'style' },{ role: 'annotation' }],
                    ['Enfoque de Enseñanza',parseInt($dpromedios[0],10), 'color: #FF6384',$datos[0]],
                    ['Clima Afectivo',parseInt($dpromedios[1],10), 'color: #36A2EB',$datos[1]],            
                    ['Proceso de Enseñanza', parseInt($dpromedios[2],10),'color: #FFCE56',$datos[2]],      
                    ['Estrategias de Retroalimentacion',parseInt($dpromedios[3],10), 'color: #FFCE56',$datos[8] ] // CSS-style declaration
                ]);
                var options = {
                    title: 'Estudiantes por Carrera',
                    hAxis: {
                    title: 'Carreras',
                    },
                    vAxis: {
                    title: 'Número de Estudiantes'
                    }
                };
    
                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
    
    
    
    </script>
    
</head>

<body onload="init()">
    <div align="center">
        <img src="{{ asset('argon') }}/img/brand/cabeceraSM.png" alt="cabecera" title="cabecera">
    </div>
    
    <div align="center" >
        <div class="col-lg col-md">
            <h6 class="text-dark">Resultados Evaluaci&oacute;n Docente Periodo {{ $periodo[0]->descripcion }} {{ $periodo[0]->anio }}</h6>
            <h4 class="text-dark">{{ $docente[0]->nombres }} {{ $docente[0]->ap_paterno }} @if ( $docente[0]->ap_materno ) {{ $docente[0]->ap_materno }} @endif</h4>
        </div>
    </div>
        
    <table id="tabledata" style="width:80%" align="center">
        <thead>
            <tr>
                <th>Clasificaci&oacute;n </th>
                <th class="col-peq">Promedio</th>
            </tr>
        </thead>
        <tbody> 
            
            @foreach ($datos_clasificacion as $clasificacion)
                <tr>
                    <td>
                        {{ $clasificacion->clasificacion }}
                    </td>
                    @foreach ($datos_respuesta as $respuesta)
                            @php 
                            $total = 0;
                            $total = $resultados[$k]*$respuesta->valor 
                            @endphp
                        @php $k++ @endphp
                        @php
                        $promedio = $promedio + $total;
                    @endphp
                    @endforeach
                    @php
                        $p = $promedio/5;
                        $promedios = $promedios.','.$p;
                        $clasificacion_preguntas = $clasificacion_preguntas.','.$clasificacion->clasificacion;
                        $promedio_final= $promedio_final+($promedio/5);
                        $promedio=0;
                    @endphp
                    <td align="center">{{ $p }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    
<br><br><br>
    <div id="chart_div" align="center"></div>

</body>



    
        @php
            $rango_desempeño = $datos_respuesta[0]->valor/3
        @endphp
                
       
        <div class="col-lg col-md">
            <h5>El promedio final de la Evaluación Docente es de: {{ $promedio_final/count($datos_clasificacion) }} <br>
                <br> Indicador que el desempeño es:
                @if ($promedio_final/count($datos_clasificacion) <= $rango_desempeño )
                    NO ACEPTABLE
                @endif
                @if ($promedio_final/count($datos_clasificacion) > $rango_desempeño && $promedio_final/count($datos_clasificacion) <= $rango_desempeño*2 )
                    ACEPTABLE
                @endif
                @if ($promedio_final/count($datos_clasificacion) > $rango_desempeño*2 && $promedio_final/count($datos_clasificacion) <= $rango_desempeño*3 )
                    BUENO
                @endif
            </h5>
    </div>

