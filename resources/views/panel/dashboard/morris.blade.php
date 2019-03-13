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
            <div class="row">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    <div class="col-sm-6">
                        <div class="pull-right">
                             <div class="dropdown">
                                 <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                     Sector
                                     <span class="caret"></span>
                                 </button>
                                 <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                     <li><a href="{{route('panel')}}">General</a></li>
                                     <li><a href="{{route('filtroSector','MAN')}}">Manufactura</a></li>
                                     <li><a href="{{route('filtroSector','M&C')}}">Mineria y Cemento</a></li>
                                     <li><a href="{{route('filtroSector','F&B')}}">Alimentos y Bebidas</a></li>
                                     <li><a href="{{route('filtroSector','CSS')}}">Construccionn y Servicios</a></li>
                                     <li><a href="{{route('filtroSector','O&G')}}">Gas y Petroleo</a></li>
                                 </ul>
                             </div>
                        </div>
                    </div>
                     <div class="col-sm-6">
                         <div class="pull-left">
                             <h4 class="text-center"><b></b> </h4>
                         </div>
                     </div>
                 </div>
        </div>
        </div>
       <div class="box-body chart-responsive">
           
            <div class="chart">
                <canvas id="canvas" style="height:450px"></canvas>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection

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
            <div class="chart" id="dinamico"></div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection()
@section('cuarto')
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
		var config = {
			type: 'line',
			data: {
				labels: [
                        @foreach ($meses as $mes)
                        "{{$mes->PERIODO}}",               
                        @endforeach
                    ],
				datasets: [{
					label: 'Ejecutado',
					backgroundColor: "rgba(91,198,238, 0.5)",
					borderColor: "rgba(91,198,238, 1)",
					data: [
                          @foreach ($meses as $mes)
                           {{$mes->EJECUTADO}},               
                          @endforeach
                    ],
                    fill:true,
					pointRadius:	5,
					pointHoverRadius: 7,
				}, {
					label: 'Meta',
					backgroundColor: "rgba(15,202,95, 0.15)",
					borderColor: "rgba(15,202,95, 1)",
					borderDash: [5, 5],
					data:[
                         @foreach ($meses as $mes)
                           {{$mes->META}},               
                          @endforeach
                    ] ,
					pointRadius:	5,
					pointHoverRadius: 7,
					fill: true,
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: '{{$titulo}}'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Año y Mes'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Cantidad'
						}
					}]
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};
	</script>
    <script>
        $(function () {
            "use strict";
            // PIVOT
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