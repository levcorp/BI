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
@section('opciones')
    <div class="box box-primary">
        <div class="box-header with-border">
        <h5 class="box-title">Opciones</h5>
            <div class="box-tools pull-right">
                 <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-4">
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
        </div>
        <!-- /.box-body -->
     </div>
@endsection
@section('primero')
    <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">Presupuesto de {{ucwords($titulo)}}</h3>

        <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
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
@section('segundo')
    <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">Oportunidades de {{ucwords($titulo)}}</h3>
            <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body chart-responsive">
            <div class="chart" id="grafica-oportunidades" style="height:350px"></div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
@section('tercero')
    <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">Oportunidad {{ucwords($titulo)}}</h3>

        <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
       <div class="box-body chart-responsive">    
            <div class="chart">
            </div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
@section('cuarto')
     <div class="box box-primary">
        <div class="box-header with-border">
        <h3 class="box-title">Porcentajes de Oportunidad {{ucwords($titulo)}}</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
        </div>
        <div class="box-body chart--responsive">
            <div class="chart" id="grafica-oportunidades-porcentaje" style="height:350px"></div>
        </div>
        <!-- /.box-body -->
    </div>
@endsection
@section('quinto')
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
                type: 'funnel',
            },
            title: false,
            plotOptions: {
                series: {
                    dataLabels: {
                         enabled: true
                    },
                    center: ['40%', '50%'],
                    neckWidth: '30%',
                    neckHeight: '30%',
                    width: '75%',
                },
                funnel:{
                    borderColor: "white",
                    states:{
                        hover:{
                            enabled:true,
                            brightness: -0.1
                        },
                    },
                    borderWidth:3
                }

            },
            legend: {
                enabled: false
            },
            series: [{
                name:"Total $ ",
                data: [
                    @foreach($oportunidades as $total)
                    ['{{$total->PosicionEstado}}', {{$total->Total}}],
                    @endforeach
                ],
                colors: ['rgba(127, 255, 212, 0.6)', 'rgba(64, 224, 208, 0.7)', 'rgba(72, 209, 204, 0.8)', 'rgba(0, 206, 209, 1)']
            }],
        });
    </script>
     <script type="text/javascript">
        Highcharts.chart('grafica-oportunidades-porcentaje', {
            chart: {
                type: 'funnel',
            },
            title: false,
            plotOptions: {
                series: {
                    dataLabels: {
                         enabled: true
                    },
                    center: ['40%', '50%'],
                    neckWidth: '30%',
                    neckHeight: '30%',
                    width: '75%',
                },
                funnel:{
                    borderColor: "white",
                    states:{
                        hover:{
                            enabled:true,
                            brightness: -0.1
                        },
                    },
                    borderWidth:3
                }

            },
            legend: {
                enabled: false
            },
            series: [{
                name:"Total $ ",
                data: [
                    @foreach($oportunidadPorcentaje as $dato)
                    ['{{$dato->PosicionEstado}}', {{$dato->Total}}],
                    @endforeach
                ],
                colors: [
                    'rgba(135, 206, 250, 0.7)', 
                    'rgba(0, 191, 255, 0.8)',
                    'rgba(30, 144, 255, 1)',
                ]
            }],
        });
    </script>
@endsection
@stop
//colors: ['rgba(173, 216, 230, 0.6)', 'rgba(135, 206, 250, 0.7)', 'rgba(0, 191, 255, 0.8)', 'rgba(30, 144, 255, 1)']
//colors: ['rgba(255, 160, 122, 0.6)', 'rgba(255, 127, 80, 0.7)', 'rgba(255, 99, 71, 0.8)', 'rgba(255, 69, 0, 1)']
//colors: ['rgba(127, 255, 212, 0.6)', 'rgba(64, 224, 208, 0.7)', 'rgba(72, 209, 204, 0.8)', 'rgba(0, 206, 209, 1)']