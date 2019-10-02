@extends('layouts.app')

@section('sidebar')
@include('layouts.navbars.sidebar')
@endsection

@section('content')

<div class="card">
        <div class="card-body">
            <div class="chart">
                <!-- Chart wrapper -->
                <canvas id="chart-orders" class="chart-canvas"></canvas>
            </div>
        </div>
    </div>


    @section('script')
   <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
    @endsection
@endsection