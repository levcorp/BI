@extends('panel.dashboard.layout') 
@section('boxes')
<div class="row">
@foreach($porcentajeEspecialidad as $especialidad)
    <div class="col-lg-2 col-xs-6 {{$especialidad->ESPECIALIDAD =='AUTO' ? 'col-lg-offset-1' :''}} " style="background-color=white;">
        <div style="background-color:white">
            <p  class="text-center"><b>{{$especialidad->nombre}}</b></p>
            <svg id="Porcentaje-{{$especialidad->ESPECIALIDAD}}" width="100%" height="100%"></svg>
        </div>
        <div class="small-box" style="background-color:white">
            <div class="inner text-center">
                <h5>Meta : <b>${{number_format($especialidad->META,2)}}</b></h5>
                <h5>Ejecutado : <b>${{number_format($especialidad->EJECUTADO,2)}}</b></h5>
            </div>
        </div>
    </div>
@endforeach
</div>
@endsection
@section('opciones')
<div class="box box-primary">
    <div class="box-body">
        <div class="row">
            <div class="col-lg-2 col-xs-6">
                <div class="pull-right">
                    <div class="dropdown">
                        <button
                            class="btn btn-info dropdown-toggle"
                            type="button"
                            id="dropdownMenu1"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="true"
                        >
                            Sector
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="{{ route('dashboard') }}">General</a></li>
                            <li>
                                <a href="{{ route('filtroSector', 'MAN') }}"
                                    >Manufactura</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('filtroSector', 'M&C') }}"
                                    >Mineria y Cemento</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('filtroSector', 'F&B') }}"
                                    >Alimentos y Bebidas</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('filtroSector', 'CSS') }}"
                                    >Construccionn y Servicios</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('filtroSector', 'O&G') }}"
                                    >Gas y Petroleo</a
                                >
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-xs-6">
                <div class="pull-left">
                    <h4 class="text-center">{{$titulo}}</h4>
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
        <h3 class="box-title">Presupuesto de {{ ucwords($titulo) }}</h3>

        <div class="box-tools pull-right">
            <button
                type="button"
                class="btn btn-box-tool"
                data-widget="collapse"
            >
                <i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <div class="box-body chart-responsive">
        <div class="chart">
            <canvas
                id="grafica-especialidad-meses"
                style="height:350px"
            ></canvas>
        </div>
    </div>
    <!-- /.box-body -->
</div>
@endsection 
@section('cuarto')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Oportunidades de {{ ucwords($titulo) }}</h3>
        <div class="box-tools pull-right">
            <button
                type="button"
                class="btn btn-box-tool"
                data-widget="collapse"
            >
                <i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <div class="box-body chart-responsive">
        <div
            id="grafica-oportunidades"
            style="height:350px"
        ></div>
    </div>
    <!-- /.box-body -->
</div>
@endsection @section('segundo')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Oportunidad por Porcentaje {{ ucwords($titulo) }}</h3>

        <div class="box-tools pull-right">
            <button
                type="button"
                class="btn btn-box-tool"
                data-widget="collapse"
            >
                <i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <div class="box-body chart-responsive">
        <div class="chart">
            <canvas
                id="grafica-oportunidad-porcentaje"
                style="height:350px"
            ></canvas>
        </div>
    </div>
    <!-- /.box-body -->
</div>
@endsection 
@section('tercero')
<!--
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">
            Porcentajes de Oportunidad {{ ucwords($titulo) }}
        </h3>

        <div class="box-tools pull-right">
            <button
                type="button"
                class="btn btn-box-tool"
                data-widget="collapse"
            >
                <i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <div class="box-body chart--responsive">
        <div
            class="chart"
            id="grafica-oportunidades-porcentaje"
            style="height:350px"
        ></div>
    </div>
</div>
-->
@endsection 
@section('quinto')
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Area Chart</h3>

        <div class="box-tools pull-right">
            <button
                type="button"
                class="btn btn-box-tool"
                data-widget="collapse"
            >
                <i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove">
                <i class="fa fa-times"></i>
            </button>
        </div>
    </div>
    <div class="box-body table-responsive">
        <div id="tabla-especialidad-meses"></div>
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
        toolbar: true,
        beforetoolbarcreated: customizeToolbar,
        global: {
		// replace this path with the path to your own translated file
		localization: "https://cdn.webdatarocks.com/loc/es.json"
	    },
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
                            uniqueName: "ESPECIALIDAD",
                            "filter": {
                            "members": [
                                "color.[blue]"
                            ]
                        } 
                    }
                ],
                columns: [{
                    uniqueName: "MES",
                    sort: "unsorted"
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
    function customizeToolbar(toolbar) {
    // get all tabs
    var tabs = toolbar.getTabs();
        toolbar.getTabs = function () {
            // delete the first tab
            delete tabs[0];
            delete tabs[1];
            delete tabs[2];
            
            return tabs;
        }
    }
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
            colors: ['rgba(222,103,54, 0.7)', 'rgba(103,193,236, 0.7)',
             'rgba(230,185,13, 0.7)', 'rgba(123,188,83, 0.7)']
        }],
    });
</script>
<script>
    var barChartData = {
    			labels:['Prospeccion', 'Presupuestaria', 'Propuesta', 'En Negociacion'],
    			datasets: [{
    				label: '30%',
    				backgroundColor: "red",
    				data: [
    				   @foreach($oportunidadPorcentaje as $oportunidad)
                            @if($oportunidad->PExito == 0.3 )
                            {{$oportunidad->Total}},
                            @endif
                        @endforeach
    				],
                    backgroundColor:"rgba(255, 159, 64, 0.4)",
                    borderColor:"rgb(255, 159, 64)",
                    borderWidth:3,
    			}, {
    				label: '50%',
    				backgroundColor: "blue",
    				data: [
    					  @foreach($oportunidadPorcentaje as $oportunidad)
                            @if($oportunidad->PExito == 0.5)
                            {{$oportunidad->Total}},
                            @endif
                        @endforeach
    				],
                    backgroundColor:"rgba(75, 192, 192, 0.4)",
                    borderColor:"rgb(75, 192, 192)",
                    borderWidth: 3
                    
    			}, {
    				label: '70%',
    				backgroundColor: "green",
    				data: [
    					  @foreach($oportunidadPorcentaje as $oportunidad)
                            @if($oportunidad->PExito == 0.7)
                            {{$oportunidad->Total}},
                            @endif
                        @endforeach
    				],
                    backgroundColor:"rgba(54, 162, 235, 0.4)",
                    borderColor:"rgb(54, 162, 235)",
                    borderWidth:3,
    			},
                
                ]

    		};
    			var ctx2 = document.getElementById('grafica-oportunidad-porcentaje').getContext('2d');
    			window.myBar = new Chart(ctx2, {
    				type: 'bar',
    				data: barChartData,
    				options: {
    					tooltips: {
    						mode: 'index',
    						intersect: false
    					},
    					responsive: true,
    					scales: {
    						xAxes: [{
    							stacked: true,
    						}],
    						yAxes: [{
    							stacked: true
    						}]
    					}
    				}
    			});
</script>
<script>
@foreach($porcentajeEspecialidad as $especialidad)
    var configuracion{{$especialidad->ESPECIALIDAD}} = liquidFillGaugeDefaultSettings();
        configuracion{{$especialidad->ESPECIALIDAD}}.circleColor = "{{$especialidad->color[0]}}";
        configuracion{{$especialidad->ESPECIALIDAD}}.textColor = "{{$especialidad->color[0]}}";
        configuracion{{$especialidad->ESPECIALIDAD}}.waveTextColor = "white";
        configuracion{{$especialidad->ESPECIALIDAD}}.waveColor = "{{$especialidad->color[1]}}";
        configuracion{{$especialidad->ESPECIALIDAD}}.circleThickness = 0.1;
        configuracion{{$especialidad->ESPECIALIDAD}}.textVertPosition = 0.5;
        configuracion{{$especialidad->ESPECIALIDAD}}.waveAnimateTime = 3000;
        configuracion{{$especialidad->ESPECIALIDAD}}.textSize = 0.75;
        configuracion{{$especialidad->ESPECIALIDAD}}.waveHeight = 0.1;
    var gauge{{$especialidad->ESPECIALIDAD}} = 
        loadLiquidFillGauge("Porcentaje-{{$especialidad->ESPECIALIDAD}}", 
                            {{$especialidad->EJECUTADO/($especialidad->META==0 ? 1 : $especialidad->META) }}*100,
                            configuracion{{$especialidad->ESPECIALIDAD}}); 
@endforeach
</script>
<script>
     toastr.options = {
                        "closeButton": true,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-bottom-right",
                        "preventDuplicates": false,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                      };
    toastr.info("{{Session::get("mensaje")}}");
</script>
@endsection 

@stop
