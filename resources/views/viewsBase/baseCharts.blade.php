@php
    $labelsPeriodos = "";
    $GruposPorPeriodo = "";
@endphp
@foreach ($periodos as $periodo)
    @php
     $labelsPeriodos = $labelsPeriodos.$periodo->descripcion." ".$periodo->anio.",";
     $GruposPorPeriodo = $GruposPorPeriodo.$grupos[$periodo->id_periodo].",";
     @endphp
@endforeach
@php
    $labelsPeriodos = substr($labelsPeriodos,0,-1);
    $GruposPorPeriodo = substr($GruposPorPeriodo,0,-1);
@endphp
@section('script')
<script>
    //GRUPOS POR PERIODO
    var OrdersChart = (function() {
        // Variables
        var $datosLabel = "<?php echo $labelsPeriodos ?>";
        var $labelsP = $datosLabel.split(",");
        var $datosGrupos = "<?php echo $GruposPorPeriodo ?>";
        var $datos = $datosGrupos.split(",");
        
        var $chart = $('#chart-orders2');
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
                    labels: $labelsP,
                    datasets: [{
                        label: 'Periodos',
                        data: $datos,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
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




{{-- ESTUDIANTES POR PERIODO --}}
@php
// $labelsPeriodos = "";
$GruposPorPeriodo = "";
@endphp
@foreach ($periodos as $periodo)
@php
//  $labelsPeriodos = $labelsPeriodos.$periodo->descripcion." ".$periodo->anio.",";
 $GruposPorPeriodo = $GruposPorPeriodo.$grupos[$periodo->id_periodo].",";
 @endphp
@endforeach
@php
// $labelsPeriodos = substr($labelsPeriodos,0,-1);
$GruposPorPeriodo = substr($GruposPorPeriodo,0,-1);
@endphp
<script>
    
    var OrdersChart = (function() {
        // Variables
        var $datosLabel = "<?php echo $labelsPeriodos ?>";
        var $labelsP = $datosLabel.split(",");
        var $chart = $('#chart-orders3');
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
                    labels: $labelsP,
                    datasets: [{
                        label: 'Periodos',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
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


     //ESTUDIANTES POR CARRERA
     var OrdersChart = (function() {
        // Variables
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
                    labels: ["red", 'green', 'pink', 'yellow', 'black'],
                    datasets: [{
                        label: 'Periodos',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
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



    //ESTUDIANTES HOMBRES
    var OrdersChart = (function() {
        // Variables
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
                    labels: ["1", "2", "3}", "4"],
                    datasets: [{
                        label: 'Periodos',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
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




     //ESTUDIANTES MUJERES
     var OrdersChart = (function() {
        // Variables
        var $chart = $('#chart-orders6');
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
                    labels: ["red", 'green', 'pink', 'yellow', 'black'],
                    datasets: [{
                        label: 'Periodos',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
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



    //ESTUDIANTES POR NIVEL
    var OrdersChart = (function() {
        // Variables
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
                    labels: ["1", "2", "3}", "4"],
                    datasets: [{
                        label: 'Periodos',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
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





     //GRUPOS APROBADOS
     var OrdersChart = (function() {
        // Variables
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
                    labels: ["red", 'green', 'pink', 'yellow', 'black'],
                    datasets: [{
                        label: 'Periodos',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
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



    //ESTUDIANTES REPROBADOS
    var OrdersChart = (function() {
        // Variables
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
                    labels: ["1", "2", "3}", "4"],
                    datasets: [{
                        label: 'Periodos',
                        data: [12, 19, 3, 5, 2, 3],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
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