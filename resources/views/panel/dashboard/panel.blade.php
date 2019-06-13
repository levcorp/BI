@extends('panel.dashboard.layout') 
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
                            <li><a href="{{ route('panel') }}">General</a></li>
                            <li>
                                <a href="{{ route('newfiltroSector', 'MAN') }}"
                                    >Manufactura</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('newfiltroSector', 'M&C') }}"
                                    >Mineria y Cemento</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('newfiltroSector', 'F&B') }}"
                                    >Alimentos y Bebidas</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('newfiltroSector', 'CSS') }}"
                                    >Construccionn y Servicios</a
                                >
                            </li>
                            <li>
                                <a href="{{ route('newfiltroSector', 'O&G') }}"
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
