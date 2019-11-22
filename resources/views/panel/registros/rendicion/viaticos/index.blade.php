@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app" v-cloak>
    <input type="text" v-model="values.sucursal_id='{{Auth::user()->sucursal_id}}'" hidden>
    <input type="text" v-model="values.usuario_id='{{Auth::user()->id}}'" hidden>
    <div class="col-sm-12">
        <div class="box box-info">
            <template v-if="show.indexRendiciones">
                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <p style="font-size: 15px">
                                <strong>
                                    Rendición Viaticos
                                </strong>
                            </p>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <div class="pull-right" style="margin-right: 10px">
                                <el-button
                                size="mini"
                                type="primary"
                                icon="el-icon-plus"
                                @click="handleCreateRendicion()"
                                round
                                >Crear Rendicion
                                </el-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <el-table :data="rendiciones" style="width: 100%" height="450" highlight-current-row>
                        <el-table-column width="70" align="center" label="#">
                            <template slot-scope="scope">
                                <span style="margin-left: 10px">@{{ scope.row.id }}</span>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="RESPONSABLE_ID" label="Responsable"></el-table-column>
                        <el-table-column align="center" prop="CONCEPTO" label="Concepto"></el-table-column>
                        <el-table-column align="center" prop="FECHA_ASIGNACION" label="Fecha de Asignación"></el-table-column>
                        <el-table-column align="center" label="Acciones" width="180">
                            <template slot-scope="scope">
                                <el-button circle icon="el-icon-edit" size="mini" type="primary" @click="handleEditRendicion(scope.$index, scope.row)"></el-button>
                                <el-button circle size="mini" type="danger" icon="el-icon-delete" @click="handleDeleteRendicion(scope.$index, scope.row)"></el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
            </template>
            <template v-if="show.createRendicion">
                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <p style="font-size: 15px">
                                <el-button @click="handleBackIndex()" type="primary" size="mini" circle icon="el-icon-arrow-left"></el-button>
                                <strong>
                                    Crear Rendición de Viaticos
                                </strong>
                            </p>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <div class="pull-right" style="margin-right: 10px">
                                <el-button
                                size="mini"
                                type="success"
                                icon="el-icon-check"
                                @click="handleCreateRendicion()"
                                round
                                >Guardar
                                </el-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    
                </div>
            </template>
        </div>
    </div>
</div>
@section('script')
{!!Html::script('js/rendicionViaticos.js')!!}
@endsection
@stop
