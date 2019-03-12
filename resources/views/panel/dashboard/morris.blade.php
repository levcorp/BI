@extends('panel.dashboard.layout')
@section('titulo')
    <h1>
        Morris Charts
        <small>Preview sample</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Charts</a></li>
        <li class="active">Morris</li>
    </ol>
@endsection
@section('primero')
    <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">Area Chart</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
        </div>
        <div class="box-body chart-responsive">
        <div class="chart" id="revenue-chart" style="height: 300px;"></div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
@section('segundo')
    <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">Area Chart</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
        </div>
        <div class="box-body table-responsive">
            <div class="chart" id="dinamico"></div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection()
@section('tercero')
    <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">Area Chart</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
        </div>
        <div class="box-body table-responsive">
            <div class="chart" id="estatico"></div>
        </div>
        <!-- /.box-body -->
    </div>
@section('script')
    <script>
        $(function () {
            "use strict";
            // AREA CHART
            var area = new Morris.Area({
            element: 'revenue-chart',
            resize: true,
            data: [
            @foreach ($meses as $mes)
                {
                mes: '{{$mes->PERIODO}}', 
                Meta: {{$mes->META}} , 
                Ejecutado: {{$mes->EJECUTADO}}
                },               
            @endforeach
            ],
            xkey: 'mes',
            ykeys: ['Ejecutado','Meta'],
            labels: ['Ejecutado','Meta'],
            lineColors: ['#a0d0e0', '#3c8dbc'],
            hideHover: 'auto',
            smooth: true,
            lineWidth:5,
            });
            
            $("#dinamico").pivotUI(
            {!! $todo !!},{
                aggregatorName: "Sum over Sum",
                rendererName: "Heatmap"
            });
            var utils = $.pivotUtilities;
            var heatmap =  utils.renderers["Heatmap"];
            var sumOverSum =  utils.aggregators["Sum"];
            $("#estatico").pivot(
            {!!$todo!!}, {
                rows: ["SECTOR"],
                cols: ["PERIODO"],
                aggregator: sumOverSum(["META"]),
                renderer: heatmap
            });
           
            
        });
    </script>  
@endsection
@stop