@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app" v-cloak>
    <div class="col-sm-12">
        <div class="box box-info" style="">
            <div class="box-header">
                <p style="font-size: 15px">
                    <strong>&nbsp;&nbsp;Lector de Codigos QR</strong>
                </p>
            </div>
            <div class="box-body">
                <div class="row camera">
                    <div class="col-sm-6">
                        <transition name="el-fade-in">
                        <div v-if="show.success">
                            <el-alert title="Realizado" type="success" description="Codigo QR leido correctamente" show-icon :closable="false"></el-alert>
                            <br>
                            <div v-for="error in errors">
                                <el-alert :title="error" type="error" show-icon :closable="false"></el-alert>
                                <br>
                            </div>
                            <div class="text-center">
                                <el-button @click="handleReadQR()" size="mini" icon="el-icon-check" type="primary" round>Leer Codigo</el-button>
                            </div>
                        </div>
                        </transition>
                        <transition name="el-fade-in">
                        <div v-if="show.camara">
                            <qrcode-stream @decode="handleDecode" @init="onInit"/>
                            <br>
                        </div>
                        </transition>
                        <br>
                    </div>
                    <div class="col-sm-6">
                        <el-card shadow="always" style="margin-bottom:10px;">
                            <div v-if="show.factura">
                                <div class="row" style="margin:5px;">
                                    <div class="col-sm-12">
                                        <div class="pull-left">
                                            <strong class="pull-left" style="font-size:12px;color:#606266;">
                                                NIT Emisor :
                                            </strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong class="pull-right" style="font-size:12px;color:black">
                                                @{{factura.NIT_Emisor}}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div style="border-bottom: #909399 solid 1px"></div>
                                <div class="row" style="margin:5px;">
                                    <div class="col-sm-12">
                                        <div class="pull-left">
                                            <strong class="pull-left" style="font-size:12px;color:#606266;">
                                                Número de Factura :
                                            </strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong class="pull-right" style="font-size:12px;color:black">
                                                @{{factura.Numero_Factura}}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div style="border-bottom: #909399 solid 1px"></div>
                                <div class="row" style="margin:5px;">
                                    <div class="col-sm-12">
                                        <div class="pull-left">
                                            <strong class="pull-left" style="font-size:12px;color:#606266;">
                                                Número de Autorización :
                                            </strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong class="pull-right" style="font-size:12px;color:black">
                                                @{{factura.Numero_Autorizacion}}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div style="border-bottom: #909399 solid 1px"></div>
                                <div class="row" style="margin:5px;">
                                    <div class="col-sm-12">
                                        <div class="pull-left">
                                            <strong class="pull-left" style="font-size:12px;color:#606266;">
                                                    Fecha de emisión :
                                            </strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong class="pull-right" style="font-size:12px;color:black">
                                                @{{factura.Fecha_Emision}}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div style="border-bottom: #909399 solid 1px"></div>
                                <div class="row" style="margin:5px;">
                                    <div class="col-sm-12">
                                        <div class="pull-left">
                                            <strong class="pull-left" style="font-size:12px;color:#606266;">
                                                    Total :
                                            </strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong class="pull-right" style="font-size:12px;color:black">
                                                    @{{factura.Total}}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div style="border-bottom: #909399 solid 1px"></div>
                                <div class="row" style="margin:5px;">
                                    <div class="col-sm-12">
                                        <div class="pull-left">
                                            <strong class="pull-left" style="font-size:12px;color:#606266;">
                                                Importe base para el Crédito Fiscal :
                                            </strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong class="pull-right" style="font-size:12px;color:black">
                                                @{{factura.Importe_Credito_Fiscal}}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div style="border-bottom: #909399 solid 1px"></div>
                                <div class="row" style="margin:5px;">
                                    <div class="col-sm-12">
                                        <div class="pull-left">
                                            <strong class="pull-left" style="font-size:12px;color:#606266;">
                                                Código de Control :
                                            </strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong class="pull-right" style="font-size:12px;color:black">
                                                @{{factura.Codigo_Control}}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div style="border-bottom: #909399 solid 1px"></div>
                                <div class="row" style="margin:5px;">
                                    <div class="col-sm-12">
                                        <div class="pull-left">
                                            <strong class="pull-left" style="font-size:12px;color:#606266;">
                                                    NIT / CI / CEX Comprador:
                                            </strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong class="pull-right" style="font-size:12px;color:black">
                                                    @{{factura.NIT_Comprador}}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div style="border-bottom: #909399 solid 1px"></div>
                                <div class="row" style="margin:5px;">
                                    <div class="col-sm-12">
                                        <div class="pull-left">
                                            <strong class="pull-left" style="font-size:12px;color:#606266;">
                                                    Importe ICE/IEHD/TASAS :
                                            </strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong class="pull-right" style="font-size:12px;color:black">
                                                    @{{factura.Importe_ICE}}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div style="border-bottom: #909399 solid 1px"></div>
                                <div class="row" style="margin:5px;">
                                    <div class="col-sm-12">
                                        <div class="pull-left">
                                            <strong class="pull-left" style="font-size:12px;color:#606266;">
                                                Importe por ventas no Gravadas o Gravadas :
                                            </strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong class="pull-right" style="font-size:12px;color:black">
                                                @{{factura.Importe_Ventas}}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div style="border-bottom: #909399 solid 1px"></div>
                                <div class="row" style="margin:5px;">
                                    <div class="col-sm-12">
                                        <div class="pull-left">
                                            <strong class="pull-left" style="font-size:12px;color:#606266;">
                                                Importe no Sujeto a Crédito Fiscal :
                                            </strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong class="pull-right" style="font-size:12px;color:black">
                                                @{{factura.Importe_No_Sujeto}}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                                <div style="border-bottom: #909399 solid 1px"></div>
                                <div class="row" style="margin:5px;">
                                    <div class="col-sm-12">
                                        <div class="pull-left">
                                            <strong class="pull-left" style="font-size:12px;color:#606266;">
                                                    Descuentos/Bonificaciones:
                                            </strong>
                                        </div>
                                        <div class="pull-right">
                                            <strong class="pull-right" style="font-size:12px;color:black">
                                                @{{factura.Descuentos}}
                                            </strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div v-else>
                                <el-alert
                                title="Error de Lectura"
                                type="warning"
                                :closable="false"
                                description="El codigo QR no contiene datos de facturación"
                                show-icon>
                                </el-alert>
                            </div>
                            <br>
                            <div class="text-center">
                                <el-button size="mini" round type="primary" icon="el-icon-paperclip"> Guardar</el-button>
                            </div>
                        </el-card>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
{!!Html::script('js/factura.js')!!}
@endsection
@stop
