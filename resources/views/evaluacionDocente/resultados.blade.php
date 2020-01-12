@extends('layouts.app')

@section('sidebar')
@php
$usuarioactual = \Auth::user();
@endphp
@if ($usuarioactual->tipo == 'coordinador')
@include('layouts.navbars.sidebar')
@endif
@if ($usuarioactual->tipo == 'docente')
@include('layouts.navbars.sidebarDocentes')
@endif
@endsection


@section('content')
<style>
    .col-med {
        width: 50%;
        word-wrap: break-word;
    }
    .padre {
  background-color: #fafafa;
  margin: 1rem;
  padding: 1rem;
  border: 2px solid #ccc;
  /* IMPORTANTE */
  text-align: center;
}
</style>
<div class="container-fluid m--t">
    <div class="card-body">
        @include('flash-message')
        @if ($errors->any())
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>	
                <ul>
                    @foreach($errors->all() as $error)
                        <li> {{ $error }}</li>
                    @endforeach
                </ul>  
            </div> 
        @endif
    </div> 
    <div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center" >
        <div class="col-lg col-md">
            <h6 class="text-dark">Resultados Evaluaci&oacute;n Docente Periodo {{ $periodo[0]->descripcion }} {{ $periodo[0]->anio }}</h6>
            <h4 class="text-dark">{{ $docente[0]->nombres }} {{ $docente[0]->ap_paterno }} @if ( $docente[0]->ap_materno ) {{ $docente[0]->ap_materno }} @endif</h4>
        </div>
    </div>
    <div class="text-right mb-2">
        <a href=" {{ route('inicio') }} " class="btn btn-outline-primary btn-sm mt-3">
            <span>
                <i class="fas fa-reply"></i> &nbsp; Regresar
            </span>
        </a>
    </div> 
    <div class="row">    
        <div class="col-xl">
            <div class="col-xl">
                <div class="card shadow ">
                    <div class="table-responsive">
                        <table id="tabledata" class="table align-items-center table-flush th">
                            <thead class="thead-light">
                                <tr class="card-header">
                                    <th></th>
                                    <th class="text col-med" rowspan="2">Clasificaci&oacute;n </th>
                                    {{-- <th class="text col-med" colspan="5">Puntuacion por Respuesta</th> --}}
                                    <th rowspan="2">Promedio</th>
                                </tr>
                                {{-- <tr>
                                    @foreach ($datos_respuesta as $respuesta)
                                    <th class="text">{{ $respuesta->respuesta }}</th>
                                    @endforeach
                                    
                                </tr> --}}
                            </thead>
                            <tbody> @php $k=0; $promedio=0; $promedio_final=0; $p=0; $promedios=""; $clasificacion_preguntas="";@endphp
                                @foreach ($datos_clasificacion as $clasificacion)
                                    <tr>
                                        <th></th>
                                        <th>
                                            {{ $clasificacion->clasificacion }}
                                        </th>
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
                                        <th>{{ $p }}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
            
    <div class="row mt-6">
        <div class="col-xl-12">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Resultados Evaluaci&oacute;n</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <canvas id="chart-orders4" width="800" height="00" class="chart-canvas"></canvas>

                    </div>
                </div>
            </div>
        </div>
        @php
            $rango_desempeño = $datos_respuesta[0]->valor/3
        @endphp
                
        @section('script')
            @php
                $clasificacion_preguntas = substr($clasificacion_preguntas,1);
                $promedios = substr($promedios,1);
            @endphp
            
            <script>
                    var OrdersChart = (function() {
                    // Variables
                    var $datosClasificacion = "<?php echo $clasificacion_preguntas ?>"
                    var $clasificacion = $datosClasificacion.split(",");

                    var $datosPromedios = "<?php echo $promedios ?>"
                    var $dpromedios = $datosPromedios.split(",");
            
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
                                labels: $clasificacion,
                                datasets: [{
                                    label: 'Clas.',
                                    data: $dpromedios,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)'
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
        
    </div>
    <div class="header pb-1 pt-4 pt-lg-7 d-flex align-items-center text-center mt-6" >
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
    </div>
    {{-- <form action="{{ route('descargarResultados') }}" method="get">
        <input type="hidden" name="docente" value="{{ $docente[0]->curp_docente }}">
        <input type="hidden" name="periodo" value="{{ $periodo[0]->id_periodo }}">
        <button type="submit"  class="btn btn-outline-info btn-sm mt-4">
            <span>
                <i class="fas fa-file-download"></i> &nbsp; Descargar Resultados
            </span>
        </button>
    </form> --}}
</div>
<br><br>
@include('layouts.footers.nav')

@endsection

@push('js')
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
<script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush