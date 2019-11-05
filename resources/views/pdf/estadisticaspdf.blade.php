<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Datos Estadisticos</title>

    @php
    // ESTUDIANTES POR CARRERA
    $alumnos_carrera="";
    foreach ($carreras as $carrera){
    $alumnos_carrera = $alumnos_carrera.','.$carrera;
    }
    $alumnos_carrera = substr($alumnos_carrera,1);

    // ESTUDIANTES POR NIVEL
    $alumnos_nivel="";
    foreach ($niveles as $nivel){
    $alumnos_nivel = $alumnos_nivel.','.$nivel; 
    }
    $alumnos_nivel = substr($alumnos_nivel,1);

    //INDICES DE APROBACION
    $indices_alumnos = "";
    $indices_alumnos = $aprobados.','.$reprobados;
    @endphp 

    <script type="text/javascript" src="http://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

// ESTUDIANTES POR CARRERA

    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawStacked);

    function drawStacked() {
        var $datosCarrera = "<?php echo $alumnos_carrera ?>"
        var $datos = $datosCarrera.split(",");

        var data = google.visualization.arrayToDataTable([
            ['Elements','Details', { role: 'style' },{ role: 'annotation' }],
            ['Eléctrica',parseInt($datos[0],10), 'color: #FF6384',$datos[0]],
            ['Electrónica',parseInt($datos[1],10), 'color: #36A2EB',$datos[1]],            // RGB value
            ['Civil', parseInt($datos[2],10),'color: #FFCE56',$datos[2]],            // English color name
            ['Mecánica', parseInt($datos[3],10),'color: #A0FF40',$datos[3]],
            ['Industrial',parseInt($datos[4],10), 'color: #9966FF',$datos[4] ],
            ['Química',parseInt($datos[5],10), 'color: #FF9F40',$datos[5] ],
            ['Gestión',parseInt($datos[6],10), 'color: #FF6384',$datos[6]],
            ['Sistemas',parseInt($datos[7],10), 'color: #36A2EB',$datos[7]],
            ['Administración',parseInt($datos[8],10), 'color: #FFCE56',$datos[8] ] // CSS-style declaration
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

// ESTUDIANTES POR GENERO
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawStacked1);

    function drawStacked1() {
        var $datosGeneros = "<?php echo $generos ?>"
        var $datos = $datosGeneros.split(",");

        var data = google.visualization.arrayToDataTable([
            ['Elements','Details', { role: 'style' },{ role: 'annotation' }],
            ['Mujeres',parseInt($datos[0],10),'color: #FF6384',$datos[0]],
            ['Hombres',parseInt($datos[1],10), 'color: #36A2EB',$datos[1]], // CSS-style declaration
        ]);
        var options = {
            title: 'Estudiantes por Género',
            width: 600,
            height: 400,
            hAxis: {
            title: 'Generos',
            },
            vAxis: {
            title: 'Número de Estudiantes'
            }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
    }

// ESTUDIANTES POR NIVEL
    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawStacked2);

    function drawStacked2() {
        var $datosNivel = '<?php echo($alumnos_nivel) ?>';
        var $datos = $datosNivel.split(",");

        var data = google.visualization.arrayToDataTable([
            ['Elements','Details', { role: 'style' },{ role: 'annotation' }],
            ['A1', parseInt($datos[0],10), 'color: #FF6384',$datos[0]],
            ['A2M1',parseInt($datos[1],10), 'color: #36A2EB',$datos[1] ],
            ['A2M2',parseInt($datos[2],10), 'color: #FFCE56',$datos[2] ],
            ['B1M1',parseInt($datos[3],10), 'color: #A0FF40',$datos[3]],
            ['B1M2',parseInt($datos[4],10), 'color: #9966FF',$datos[4]],
        ]);
        var options = {
            title: 'Estudiantes por Nivel',
            width: 800,
        height: 400,
            hAxis: {
            title: 'Niveles',
            },
            vAxis: {
            title: 'Número de Estudiantes'
            }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
    }

// INDICES DE APROBACION
google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(drawStacked3);

    function drawStacked3() {
        var $datosIndices = '<?php echo($indices_alumnos) ?>';
        var $datosI = $datosIndices.split(",");

        var data = google.visualization.arrayToDataTable([
            ['Elements','Details', { role: 'style' },{ role: 'annotation' }],
            ['Aprobados', parseInt($datosI[0],10), '#FF6384',$datosI[0]],
            ['No Aprobados',parseInt($datosI[1],10), 'color: #36A2EB',$datosI[1] ],
        ]);
        var options = {
            title: 'Índices de Aprobación',
            width: 600,
            height: 400,
            vAxis: {
            title: 'Número de Estudiantes'
            }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
    }

    </script>
</head>

<body onload="init()">
        
        <div align="center">
            <img src="{{ asset('argon') }}/img/brand/cabeceraSM.png" alt="cabecera" title="cabecera">
        </div>

        <h4 class="text-dark" align="center">Ingresos Estimados de la CLE del Periodo {{ $periodo[0]->descripcion }} {{ $periodo[0]->anio }}</h4>
        <h2 class="text-center mt-3" align="center">$ {{ $ingresos*814 }}.00</h2>

        <h4 class="mt-6 text-center" align="center">Total de Estudiantes inscritos durante el periodo {{ $periodo[0]->descripcion }} {{ $periodo[0]->anio }}</h4>
        <h2 class="text-center mt-3" align="center"> {{ $ingresos }}</h2>

        <h4 class="text-dark" align="center">Datos Estadisticos del Periodo {{ $periodo[0]->descripcion }} {{ $periodo[0]->anio }}</h4>

        <!-- Identify where the chart should be drawn. -->
        <div id="chart_div" align="center"></div>
        <div id="chart_div1" align="center"></div>
        <div id="chart_div2" align="center"></div>
        <div id="chart_div3" align="center"></div>
    </body>

</html>