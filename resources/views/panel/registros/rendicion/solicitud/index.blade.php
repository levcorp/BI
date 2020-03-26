@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app" v-cloak>
    <input type="text" v-model="values.sucursal_id='{{Auth::user()->sucursal_id}}'" hidden>
    <input type="text" v-model="values.usuario_id='{{Auth::user()->id}}'" hidden>
    <div class="col-sm-12">
        <div class="box box-info">
            <template v-if="show.index">
                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <p style="font-size: 15px">
                                <strong>
                                    Solicitud de Fondos
                                </strong>
                            </p>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <div class="pull-right" style="margin-top-right: 10px">
                                <el-button
                                size="mini"
                                type="primary"
                                icon="el-icon-plus"
                                @click="handleCreateSolicitud()"
                                round
                                >Crear Solicitud de Fondos
                                </el-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <el-table :data="solicitudes" style="width: 100%" height="450" highlight-current-row>
                        <el-table-column width="70" align="center" label="#">
                            <template slot-scope="scope">
                                <span style="margin-top-left: 10px">@{{ scope.row.id }}</span>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="RESPONSABLE_ID" label="Responsable"></el-table-column>
                        <el-table-column align="center" prop="CONCEPTO" label="Concepto"></el-table-column>
                        <el-table-column align="center" prop="FECHA_ASIGNACION" label="Fecha de Asignación"></el-table-column>
                        <el-table-column align="center" label="Acciones" width="180">
                            <template slot-scope="scope">
                                <el-button circle icon="el-icon-edit" size="mini" type="primary" @click="handleEditSolicitud(scope.$index, scope.row)"></el-button>
                                <el-button circle size="mini" type="success" icon="el-icon-delete" @click="handleShowSolicitud(scope.$index, scope.row)"></el-button>
                                <el-button circle size="mini" type="danger" icon="el-icon-delete" @click="handleDeleteSolicitud(scope.$index, scope.row)"></el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
            </template>
            <template v-if="show.create">
                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <p style="font-size: 15px">
                                <el-button @click="handleBackIndex()" type="primary" size="mini" circle icon="el-icon-arrow-left"></el-button>
                                <strong>
                                    Solicitud de fondos a cuenta de rendición 
                                </strong>
                            </p>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <div class="pull-right" style="margin-top-right: 10px">
                                <el-button
                                size="mini"
                                type="success"
                                icon="el-icon-check"
                                @click="handleCreateSolicitud()"
                                round
                                >Guardar
                                </el-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body" style="margin:0px 20px;">
                    <div class="row" style="margin-top:15px;">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="pull-right"> 
                                        <label for="" style="margin-top:5px;"> Fecha de Solicitud :</label>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <el-date-picker style="width:100%;" placeholder="Elija una fecha" size="small" v-model="solicitud.FECHA_SOLICITUD"></el-date-picker>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="pull-right"> 
                                        <label for="" > Fecha de desembolso requerido :</label>
                                    </div>
                                </div>
                                <div class="col-sm-7">
                                    <el-date-picker style="width:100%;" placeholder="Elija una fecha" size="small" v-model="solicitud.FECHA_DESEMBOLSO"></el-date-picker>
                                </div>
                            </row>
                        </div>
                    </div>
                    <div class="row" style="margin-top:15px;">
                        <div class="col-sm-2">
                            <div class="pull-right"> 
                                <label for="" style="margin-top:5px;"> Descripcion :</label>
                            </div>
                        </div>
                        <div class="col-sm-10">
                            <el-input type="text" placeholder="Llenar campo" size="small" v-model="solicitud.DESCRIPCION"></el-input>
                        </div>
                    </div>
                    <div class="row" style="margin-top:15px;">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="pull-right"> 
                                        <label for="" style="margin-top:5px;"> Importe Solicitado :</label>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <el-input type="number" size="small" placeholder="Llenar campo" v-model="solicitud.IMPORTE_SOLICITADO"></el-input>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label style="margin-top:5px;color:#409EFF;">@{{values.literal | uppercase}} 00/100 BOLIVIANOS</label>
                        </div>
                    </div>
                    <div class="row" style="margin-top:15px;">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="pull-right"> 
                                        <label for="" style="margin-top:5px;">Solicitado por :</label>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <el-input disabled type="text" size="small" :value="data.usuario.nombre+' '+data.usuario.apellido"></el-input>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="pull-right"> 
                                        <label for=""  style="margin-top:5px;">Cedula de Identidad :</label>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <el-input disabled type="text" size="small" :value="data.usuario.ci"></el-input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:15px;">
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="pull-right"> 
                                        <label for="" style="margin-top:5px;">Autorizado por</label>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <el-select style="width:100%;" clearable v-model="solicitud.AUTORIZADO_ID" filterable placeholder="Seleccionar Usuario" size="small">
                                        <el-option
                                            v-for="item in data.usuarios"
                                            :key="item.nombre+' '+item.apellido"
                                            :label="item.nombre+' '+item.apellido"
                                            :value="item.id">
                                            <span style="float: left">@{{ item.nombre+' '+item.apellido }}</span>
                                            <span style="float: right; color: #8492a6; font-size: 13px"><i class="el-icon-user"></i></span>
                                        </el-option>
                                    </el-select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                             <div class="row">
                                <div class="col-sm-4">
                                    <div class="pull-right"> 
                                        <label for="">Comentarios de Autorización :</label>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <el-input type="text"  placeholder="Llenar campo" size="small" v-model="solicitud.COMENTARIOS"></el-input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row"  style="margin-top:15px;">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="pull-right"> 
                                        <label for="" style="margin-top:5px;">Concepto o motivos de la solicitud:</label>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <el-input
                                        type="textarea"
                                        size="small"
                                        :autosize="{ minRows: 2, maxRows: 4}"
                                        placeholder="Llenar campo"
                                        v-model="solicitud.MOTIVO">
                                    </el-input>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top:15px;">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-3">
                                    <div class="pull-right"> 
                                        <label for="" style="margin-top:5px;">Medio de Pago :</label>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <el-select style="width:100%;" v-model="solicitud.MEDIO_PAGO" size="small" placeholder="Elija una Opción">
                                        <el-option
                                        v-for="item in data.medio"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value">
                                        </el-option>
                                    </el-select>
                                </div>
                                <div class="col-sm-4">
                                    <el-input v-if="show.abono" type="text" size="small" v-model="solicitud.CUENTA"></el-input>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                             <div class="row">
                                <div class="col-sm-3">
                                    <div class="pull-right"> 
                                        <label for="" style="margin-top:5px;">Banco</label>
                                    </div>
                                </div>
                                <div class="col-sm-9">
                                    <el-input type="text"  size="small" v-model="solicitud.BANCO" placeholder="Llenar campo"></el-input>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
@section('script')
{!!Html::script('js/solicitud.js')!!}
@endsection
@stop
