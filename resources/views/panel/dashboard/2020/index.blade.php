@extends('panel.dashboard.layout')
@section('opciones')

@endsection
@section('body')
<div class="row" id="app" v-cloak>
    <div class="col-md-12">
        <el-card v-loading="loading.presupuesto">
            <div slot="header" class="clearfix">
                <span>
                    <strong>
                        Presupuesto Mercados
                    </strong>
                </span>
                <el-popover style="float: right" placement="bottom" width="80" trigger="hover">
                    <div class="text-center">
                        <el-button @click="handleGetOption('General','General')" size="mini" type="text">General
                        </el-button><br>
                        <div style="border-top: 1px solid #DCDFE6; margin: 0px;padding: 0px;"></div>
                        <el-button @click="handleGetOption('CSS','Construccion y Servicios')" size="mini" type="text">
                            Construccion y Servicios
                        </el-button><br>
                        <div style="border-top: 1px solid #DCDFE6; margin: 0px;padding: 0px;"></div>
                        <el-button @click="handleGetOption('F&B','Alimentos y Bebidas')" size="mini" type="text">
                            Alimentos y Bebidas
                        </el-button>
                        <br>
                        <div style="border-top: 1px solid #DCDFE6; margin: 0px;padding: 0px;"></div>
                        <el-button @click="handleGetOption('M&C','Mineria y Cemento')" size="mini" type="text">Mineria y
                            Cemento</el-button>
                        <br>
                        <div style="border-top: 1px solid #DCDFE6; margin: 0px;padding: 0px;"></div>
                        <el-button @click="handleGetOption('O&G','Gas y Petroleo')" size="mini" type="text">Gas y
                            Petroleo</el-button>
                        <br>
                        <div style="border-top: 1px solid #DCDFE6; margin: 0px;padding: 0px;"></div>
                        <el-button @click="handleGetOption('MAN','Manufactura')" size="mini" type="text">Manufactura
                        </el-button>
                    </div>
                    <el-button size="mini" slot="reference">@{{button.name}}</el-button>
                </el-popover>
            </div>

            <apexchart type="area" height="350" :options="chartOptions" :series="series"></apexchart>
        </el-card>
        <br>
    </div>
    <!--<div class="col-md-12">
        <el-card v-loading="loading.presupuesto">
            <div slot="header" class="clearfix">
                <span>
                    <strong>
                        Presupuesto Especialidades
                    </strong>
                </span>
                <el-popover style="float: right" placement="bottom" width="80" trigger="hover">
                    <div class="text-center">
                        <el-button @click="handleGetOption('General')" size="mini" type="text">Automatización
                        </el-button><br>
                        <div style="border-top: 1px solid #DCDFE6; margin: 0px;padding: 0px;"></div>
                        <el-button @click="handleGetOption('M&C')" size="mini" type="text">Instrumentación</el-button>
                        <br>
                        <div style="border-top: 1px solid #DCDFE6; margin: 0px;padding: 0px;"></div>
                        <el-button @click="handleGetOption('F&B')" size="mini" type="text">Media Tensión</el-button><br>
                        <div style="border-top: 1px solid #DCDFE6; margin: 0px;padding: 0px;"></div>
                        <el-button @click="handleGetOption('CSS')" size="mini" type="text">Mecanica</el-button><br>
                        <div style="border-top: 1px solid #DCDFE6; margin: 0px;padding: 0px;"></div>
                        <el-button @click="handleGetOption('O&G')" size="mini" type="text">Eléctrica</el-button>
                    </div>
                    <el-button size="mini" slot="reference">@{{button.name}}</el-button>
                </el-popover>
            </div>

            <apexchart type="area" height="350" :options="chartOptions" :series="series"></apexchart>
        </el-card>
    </div>-->
</div>

@section('script')
{!!Html::script('js/panel.js')!!}
@endsection
@stop