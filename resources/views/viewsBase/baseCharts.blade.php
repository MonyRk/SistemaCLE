{{-- //GRUPOS POR MODALIDAD --}}
@section('script')
@php
    $grupos_sem="";
@endphp
@foreach ($grupos_semanales as $semanal)
@php
$grupos_sem = $grupos_sem.','.$semanal
@endphp
@endforeach
@php
    $grupos_sem = substr($grupos_sem,1)
@endphp

<script>
     var OrdersChart = (function() {
        // Variables
        var $datosSemanal= "<?php echo $grupos_sem ?>"
        var $datos = $datosSemanal.split(",");

        var $chart = $('#chart-orders9');
        var $ordersSelect = $('[name="ordersSelect"]');
        // Methods
        // Init chart
        function initChart($chart) {
            // Create chart
            var ordersChart = new Chart($chart, {
                type: 'bar',
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(value) {
                                    if (!(value % 10)) {
                                        //return '$' + value + 'k'
                                        return value
                                    }
                                }
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(item, data) {
                                var label = data.datasets[item.datasetIndex].label || '';
                                var yLabel = item.yLabel;
                                var content = '';

                                if (data.datasets.length > 1) {
                                    content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                                }

                                content += '<span class="popover-body-value">' + yLabel + '</span>';

                                return content;
                            }
                        }
                    }
                },
                data: {
                        labels: ["A1","A2M1","A2M2","B1M1","B1M2"],
                    datasets: [{
                        label: 'Niveles',
                        data: $datos,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });
            // Save to jQuery object
            $chart.data('chart', ordersChart);
        }
        // Init chart
        if ($chart.length) {
            initChart($chart);
        }

    })();

</script>


@php
    $grupos_sab="";
@endphp
@foreach ($grupos_sabatinos as $sabatinos)
@php
$grupos_sab = $grupos_sab.','.$sabatinos
@endphp
@endforeach
@php
    $grupos_sab = substr($grupos_sab,1)
@endphp

<script>
     var OrdersChart = (function() {
        // Variables
        var $datosSabados= "<?php echo $grupos_sab ?>"
        var $datos = $datosSabados.split(",");

        var $chart = $('#chart-orders10');
        var $ordersSelect = $('[name="ordersSelect"]');
        // Methods
        // Init chart
        function initChart($chart) {
            // Create chart
            var ordersChart = new Chart($chart, {
                type: 'bar',
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(value) {
                                    if (!(value % 10)) {
                                        //return '$' + value + 'k'
                                        return value
                                    }
                                }
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(item, data) {
                                var label = data.datasets[item.datasetIndex].label || '';
                                var yLabel = item.yLabel;
                                var content = '';

                                if (data.datasets.length > 1) {
                                    content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                                }

                                content += '<span class="popover-body-value">' + yLabel + '</span>';

                                return content;
                            }
                        }
                    }
                },
                data: {
                        labels: ["A1","A2M1","A2M2","B1M1","B1M2"],
                    datasets: [{
                        label: 'Niveles',
                        data: $datos,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });
            // Save to jQuery object
            $chart.data('chart', ordersChart);
        }
        // Init chart
        if ($chart.length) {
            initChart($chart);
        }

    })();

</script>



{{-- //ESTUDIANTES POR CARRERA --}}
{{-- @section('script') --}}
@php
    $alumnos_carrera="";
@endphp
@foreach ($carreras as $carrera)
@php
$alumnos_carrera = $alumnos_carrera.','.$carrera
@endphp
@endforeach
@php
    $alumnos_carrera = substr($alumnos_carrera,1)
@endphp

<script>
     var OrdersChart = (function() {
        // Variables
        var $datosCarrera = "<?php echo $alumnos_carrera ?>"
        var $datos = $datosCarrera.split(",");

        var $chart = $('#chart-orders4');
        var $ordersSelect = $('[name="ordersSelect"]');
        // Methods
        // Init chart
        function initChart($chart) {
            // Create chart
            var ordersChart = new Chart($chart, {
                type: 'bar',
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(value) {
                                    if (!(value % 10)) {
                                        //return '$' + value + 'k'
                                        return value
                                    }
                                }
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(item, data) {
                                var label = data.datasets[item.datasetIndex].label || '';
                                var yLabel = item.yLabel;
                                var content = '';

                                if (data.datasets.length > 1) {
                                    content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                                }

                                content += '<span class="popover-body-value">' + yLabel + '</span>';

                                return content;
                            }
                        }
                    }
                },
                data: {
                    labels: ['Eléctrica','Electrónica','Civil','Mécanica','Industrial','Química','Gestión','Sist.','Admon.'],
                    datasets: [{
                        label: 'Carreras',
                        data: $datos,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                        ],
                        borderWidth: 1
                    }]
                }
            });
            // Save to jQuery object
            $chart.data('chart', ordersChart);
        }
        // Init chart
        if ($chart.length) {
            initChart($chart);
        }

    })();

</script>





{{-- //ESTUDIANTES POR GENERO --}}
{{-- @php
    $generos
@endphp --}}

<script>
    //ESTUDIANTES POR GENERO
    var OrdersChart = (function() {
        // Variables
        var $datosGeneros = "<?php echo $generos ?>"
        var $datos = $datosGeneros.split(",");

        var $chart = $('#chart-orders5');
        var $ordersSelect = $('[name="ordersSelect"]');
        // Methods
        // Init chart
        function initChart($chart) {
            // Create chart
            var ordersChart = new Chart($chart, {
                type: 'bar',
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(value) {
                                    if (!(value % 10)) {
                                        //return '$' + value + 'k'
                                        return value
                                    }
                                }
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(item, data) {
                                var label = data.datasets[item.datasetIndex].label || '';
                                var yLabel = item.yLabel;
                                var content = '';

                                if (data.datasets.length > 1) {
                                    content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                                }

                                content += '<span class="popover-body-value">' + yLabel + '</span>';

                                return content;
                            }
                        }
                    }
                },
                data: {
                    labels: ['Mujeres','Hombres'],
                    datasets: [{
                        label: 'Generos',
                        data: $datos,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                            
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                            
                        ],
                        borderWidth: 1
                    }]
                }
            });
            // Save to jQuery object
            $chart.data('chart', ordersChart);
        }
        // Init chart
        if ($chart.length) {
            initChart($chart);
        }

    })();
</script>
{{-- //ESTUDIANTES POR NIVEL --}}
@php
    $alumnos_nivel="";
@endphp
@foreach ($niveles as $nivel)
@php
$alumnos_nivel = $alumnos_nivel.','.$nivel
@endphp
@endforeach
@php
    $alumnos_nivel = substr($alumnos_nivel,1)
@endphp

<script>


    //ESTUDIANTES POR NIVEL
    var OrdersChart = (function() {
        // Variables
        var $datosNivel = '<?php echo($alumnos_nivel) ?>';
        var $datos = $datosNivel.split(",");

        var $chart = $('#chart-orders7');
        var $ordersSelect = $('[name="ordersSelect"]');
        // Methods
        // Init chart
        function initChart($chart) {
            // Create chart
            var ordersChart = new Chart($chart, {
                type: 'bar',
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(value) {
                                    if (!(value % 10)) {
                                        //return '$' + value + 'k'
                                        return value
                                    }
                                }
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(item, data) {
                                var label = data.datasets[item.datasetIndex].label || '';
                                var yLabel = item.yLabel;
                                var content = '';

                                if (data.datasets.length > 1) {
                                    content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                                }

                                content += '<span class="popover-body-value">' + yLabel + '</span>';

                                return content;
                            }
                        }
                    }
                },
                data: {
                    labels: ["A1","A2M1","A2M2","B1M1","B1M2"],
                    datasets: [{
                        label: 'Niveles',
                        data: $datos,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)'
                        ],
                        borderWidth: 1
                    }]
                }
            });
            // Save to jQuery object
            $chart.data('chart', ordersChart);
        }
        // Init chart
        if ($chart.length) {
            initChart($chart);
        }

    })();

</script>
@php
    $indices_alumnos = "";
    $indices_alumnos = $reprobados.','.$aprobados;
@endphp
<script>



     //APROBADOS Y REPROBADOS
     var OrdersChart = (function() {
        // Variables
        var $datosIndices = '<?php echo($indices_alumnos) ?>';
        var $datosI = $datosIndices.split(",");

        var $chart = $('#chart-orders8');
        var $ordersSelect = $('[name="ordersSelect"]');
        // Methods
        // Init chart
        function initChart($chart) {
            // Create chart
            var ordersChart = new Chart($chart, {
                type: 'bar',
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                callback: function(value) {
                                    if (!(value % 10)) {
                                        //return '$' + value + 'k'
                                        return value
                                    }
                                }
                            }
                        }]
                    },
                    tooltips: {
                        callbacks: {
                            label: function(item, data) {
                                var label = data.datasets[item.datasetIndex].label || '';
                                var yLabel = item.yLabel;
                                var content = '';

                                if (data.datasets.length > 1) {
                                    content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                                }

                                content += '<span class="popover-body-value">' + yLabel + '</span>';

                                return content;
                            }
                        }
                    }
                },
                data: {
                    labels: ["Reprobados","Aprobados"],
                    datasets: [{
                        label: 'Indices',
                        data: $datosI,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                            
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)'
                        
                        ],
                        borderWidth: 1
                    }]
                }
            });
            // Save to jQuery object
            $chart.data('chart', ordersChart);
        }
        // Init chart
        if ($chart.length) {
            initChart($chart);
        }

    })();
</script>
@endsection