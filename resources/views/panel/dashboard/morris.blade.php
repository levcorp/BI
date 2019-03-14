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
                <canvas id="grafica-especialidad-meses" style="height:350px"></canvas>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
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
            <div class="chart" id="tabla-especialidad-meses"></div>
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
            <div class="chart" id="grafica-oportunidades"></div>
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
			var ctx = document.getElementById('grafica-especialidad-meses').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};
	</script>
    <script>
        var pivot = new WebDataRocks({
            container: "#tabla-especialidad-meses",
            //Mostrar Menu
            toolbar: false,
            report: {
                dataSource: {
                    data: {!!$todo!!}
                },
                slice: {
                    rows: [
                        {
                        uniqueName: "SECTOR"
                        },
                        {
                        uniqueName: "ESPECIALIDAD"
                        }
                    ],
                    columns: [{
                        uniqueName: "MES",
                        }
                    ],
                    measures: [
                        {
                        uniqueName: "META",
                        aggregation: "sum",
                        format: "currency"
                        },
                        {
                        uniqueName: "EJECUTADO",
                        aggregation: "sum",
                        format: "currency"
                        },
                    ]
                },
            },
            formats: [{
            name: "currency",
            currencySymbol: "$",
            currencySymbolAlign: "left",
            thousandsSeparator: ",",
            decimalPlaces: 2
            }],
        });
    </script>
    <script type="text/javascript">
        Highcharts.chart('grafica-oportunidades', {
            chart: {
                type: 'funnel'
            },
            title: {
                text: 'Sales funnel'
            },
            plotOptions: {
                series: {
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b> ({point.y:,.0f})',
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black',
                        softConnector: true
                    },
                    center: ['40%', '50%'],
                    neckWidth: '30%',
                    neckHeight: '25%',
                    width: '80%',
                    animation: true,
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Unique users',
                data: [
                    ['Website visits', 15654],
                    ['Downloads', 4064],
                    ['Requested price list', 1987],
                    ['Invoice sent', 976],
                    ['Finalized', 846]
                ],
                borderColor: ['rgba(47,126,216, 1)', 'rgba(13,35,58, 1)', 'rgba(139,188,33, 1)', 'rgba(145,0,0, 1)', 'rgba(26,173,206, 1)'],

                colors: ['rgba(47,126,216, 0.5)', 'rgba(13,35,58, 0.5)', 'rgba(139,188,33, 0.5)', 'rgba(145,0,0, 0.5)', 'rgba(26,173,206, 0.5)']
            }]
        });
    </script>
@endsection
@stop