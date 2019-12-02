@extends('layouts.table')
@section('style')
@endsection
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app" v-cloak>
    <transition name="el-fade-in">
        <div v-if="show.facturacion">
            <div class="col-sm-12" >
                <div class="box box-info" v-loading="loading.facturacion" style="min-height: 400px;">
                    <div class="box-header">
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div v-for="item in datos">
                                <div>
                                    <div class="col-sm-6"> 
                                        <el-card>
                                            <div class="row">
                                                <div class="text-center">
                                                    <p style="font-size: 14px;letter-spacing: 1px">
                                                        <strong>
                                                            @{{
                                                                !item.Sector ? 'Nulo' : item.Sector=='F&B' ? 
                                                                'Alimentos y Bebidas' : item.Sector=='M&C' ?
                                                                'Mineria y Cemento' : item.Sector=='MAN' ?  
                                                                'Manufactura' : item.Sector=='O&G' ?
                                                                'Gas y Petroleo' : item.Sector =='CSS' ? 
                                                                'Construcción y Servicios' : item.Sector
                                                            }}
                                                        </strong>
                                                    </p>
                                                </div>
                                            </div>
                                            <div style="width: 100%;background-color:#C0C4CC;height: 1px;margin-bottom: 8px;"></div>
                                            <div class="row" style="margin:10px;">
                                                <div class="col-sm-12" style="margin: 3px;">
                                                    <div class="row">
                                                        <div class="col-sm-8" style="font-size: 13px;color:#606266;">
                                                            <strong>
                                                                Facturación Enero - @{{item.MesFaAnteriorLiteral}} - @{{item.GESTION}} 
                                                            </strong>
                                                        </div>
                                                        <div class="col-sm-4 text-center" style="background-color: #ecf4ff;color:#86b9fa">
                                                            <strong>
                                                                @{{item.TOTAL_FACTURAS ? item.TOTAL_FACTURAS:'0' | currency('$', 2)}}
                                                            </strong> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" style="margin: 3px;">
                                                    <div class="row" >
                                                        <div class="col-sm-8" style="font-size: 13px;color:#606266;">
                                                            <strong>
                                                                Facturacion @{{item.MesFaLiteral}}  - @{{item.GESTION}} 
                                                            </strong>
                                                        </div>
                                                        <div class="col-sm-4 text-center" style="background-color: #ecf4ff;color:#86b9fa">
                                                            <strong>
                                                                @{{item.TOTAL_FACTURASA ? item.TOTAL_FACTURASA:'0' | currency('$', 2)}}
                                                            </strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" style="margin: 3px;">
                                                    <div class="row">
                                                        <div class="col-sm-8" style="font-size: 13px;color:#606266;">
                                                            <strong>
                                                                Pedidos @{{item.MesOVALiteral}} - @{{item.GESTION}} 
                                                            </strong>
                                                        </div>
                                                        <div class="col-sm-4 text-center" style="background-color: #ecf4ff;color:#86b9fa">
                                                            <strong>
                                                                @{{item.TOTAL_OVA ? item.TOTAL_OVA:'0'| currency('$', 2)}} 
                                                            </strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" style="margin: 3px;">
                                                    <div class="row">
                                                        <div class="col-sm-8" style="font-size: 13px;color:#606266;">
                                                            <strong>
                                                                Pedidos Futuros - @{{item.GESTION}}
                                                            </strong>
                                                        </div>
                                                        <div class="col-sm-4 text-center" style="background-color: #ecf4ff;color:#86b9fa">
                                                            <strong>
                                                                @{{item.TOTAL_OV ? item.TOTAL_OV :'0'| currency('$', 2)}}
                                                            </strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" style="margin: 3px;">
                                                    <div class="row">
                                                        <div class="col-sm-8" style="font-size: 13px;color:#606266;">
                                                            <strong>
                                                                Oportunidades @{{item.MesCierreLiteral}} - @{{item.GESTION}}
                                                            </strong>
                                                        </div>
                                                        <div class="col-sm-4 text-center" style="background-color: #ecf4ff;color:#86b9fa">
                                                            <strong>
                                                                @{{item.OPORTUNIDADESTOTAL_MES ? item.OPORTUNIDADESTOTAL_MES : '0'| currency('$', 2)}}
                                                            </strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" style="margin: 3px;">
                                                    <div class="row">
                                                        <div class="col-sm-8" style="font-size: 13px;color:#606266;">
                                                            <strong>
                                                                Opotunidades Futuras - @{{item.GESTION}}
                                                            </strong>
                                                        </div>
                                                        <div class="col-sm-4 text-center" style="background-color: #ecf4ff;color:#86b9fa">
                                                            <strong>
                                                                @{{item.OPORTUNIDADESTOTAL_GESTION ? item.OPORTUNIDADESTOTAL_GESTION:'0'| currency('$', 2)}}
                                                            </strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12" style="margin: 3px;">
                                                    <div style="width: 100%;background-color:#C0C4CC;height: 1px;margin-bottom: 8px;"></div>
                                                    <div class="row">
                                                        <div class="col-sm-8" style="font-size: 13px;color:#606266;">
                                                            <strong>
                                                                Estimado Cierre Gestion - @{{item.GESTION}}
                                                            </strong>
                                                        </div>
                                                        <div class="col-sm-4 text-center" style="background-color: #e1f3d9;color:#67c239">
                                                            <strong>
                                                                @{{item.Total ?  item.Total:'0' | currency('$', 2)}}                                                        
                                                            </strong>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 text-center" style="margin-top:10px;">
                                                    <el-button @click="handleShowPedidos(item)" round type="primary" size="mini" icon="el-icon-notebook-2">Pedidos</el-button>
                                                    <el-button @click="handleShowOportunidades(item)" round type="primary" size="mini" icon="el-icon-notebook-1">Oportunidades</el-button>
                                                </div>
                                            </div>
                                        </el-card>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
    @include('panel.registros.facturacion.oportunidades')
    @include('panel.registros.facturacion.pedidos')
    @include('panel.registros.facturacion.detallePedido')
    @include('panel.registros.facturacion.detalleOportunidad')
</div>
@section('script')
{!!Html::script('js/facturacion.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop
