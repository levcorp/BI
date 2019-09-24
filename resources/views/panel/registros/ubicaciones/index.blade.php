@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app" v-cloak>
    <input type="text" :value="sucursal='{{Auth::user()->sucursal_id}}'" hidden>
    <el-collapse-transition>
        <div class="col-xs-12" v-if="view==1">
            <div class="box box-info">
                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <h3 class="box-title">Ubicaciones</h3>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <div class="pull-right" style="margin-right: 10px">
                                <el-button @click="handleCreate()" size="mini" type="primary" icon="el-icon-plus">Crear Lista</el-button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <el-table :data="lists" style="width: 100%" height="400" highlight-current-row :default-sort="{prop: 'id', order: 'descending'}">
                        <el-table-column align="center" prop="id" width="150" label="#" sortable>
                            <template slot-scope="scope">
                                @{{scope.$index+1}}
                            </template>
                        </el-table-column>
                        <el-table-column align="center" prop="FECHA_CREACION" label="Fecha Creacion" sortable>
                            <template slot-scope="scope">
                                @{{scope.row.FECHA_CREACION | moment('calendar',null,{sameElse : 'YYYY-MM-DD HH:mm'})  | capitalize({ onlyFirstLetter: true })}}
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="Usuario" sortable>
                            <template slot-scope="scope">
                                @{{scope.row.usuario.nombre+' '+scope.row.usuario.apellido}}
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="Acciones">
                            <template slot-scope="scope">
                                <el-button size="mini" plain type="primary" icon="el-icon-plus" circle @click="handleAddView(scope.$index, scope.row)"></el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
            </div>
        </div>
    </el-collapse-transition>
    <el-collapse-transition>
        <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12" v-if="view==2">
            <div class="box box-info">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="pull-left">
                                <p style="font-size: 15px">
                                    <el-button @click="handleBack()" type="primary" size="mini" circle icon="el-icon-arrow-left"></el-button>
                                    <strong>&nbsp;&nbsp;Detalle de Articulos</strong>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-center">
                                <el-button type="success" @click="handleAdd()" icon="el-icon-message" size="mini">Enviar</el-button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="pull-right">
                                <el-button type="primary" @click="handleAdd()" icon="el-icon-plus" size="mini">Añadir</el-button>
                            </div>
                        </div>
                    </div>
                <el-table :data="ubicaciones" style="width: 100%" height="400" highlight-current-row :default-sort="{prop: 'id', order: 'descending'}">
                    <el-table-column align="center" prop="ItemCode" label="Cod. SAP" sortable>
                        <template slot-scope="scope">
                            @{{scope.row.ITEMCODE}}
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="Descripcion" sortable>
                        <template slot-scope="scope">
                            @{{scope.row.DESCRIPCION}}
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="Cod. Venta" sortable>
                        <template slot-scope="scope">
                            @{{scope.row.COD_VENTA}}
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="Ubicación" sortable>
                        <template slot-scope="scope">
                            <el-form :inline="true">
                                <el-input placeholder="Ubicación" size="mini">
                                    <template slot="suffix">
                                        <el-button size="mini" style="padding: 4.8px;margin: 2px" circle type="primary" icon="el-icon-check"></el-button>
                                    </template>
                                </el-input>
                            </el-form>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="Acciones">
                    <template slot-scope="scope">
                        <el-button size="mini" type="danger" icon="el-icon-close" circle @click="handleAdd()"></el-button>
                    </template>
                    </el-table-column>
                </el-table>
                </div>
            </div>
        </div>
    </el-collapse-transition>
    <el-collapse-transition>
        <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12" v-if="view==2">
            <div class="box box-info">
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="pull-left">
                                <p style="font-size: 15px">
                                    <strong>&nbsp;&nbsp;Articulos sin Ubicacion</strong>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <el-button-group>
                                <el-button size="mini" type="primary" @click="handelChoseUbicacionNull('La Paz')" icon="el-icon-location-outline">LPZ</el-button>
                                <el-button size="mini" type="primary" @click="handelChoseUbicacionNull('Santa Cruz')" icon="el-icon-location-outline">SCZ</el-button>
                                <el-button size="mini" type="primary" @click="handelChoseUbicacionNull('Cochabamba')" icon="el-icon-location-outline">CBB</el-button>
                            </el-button-group>
                        </div>
                    </div>
                <el-table v-loading="loadUbicacionesNull" :data="ubicacionesNull.filter(data => !searchUbicacionesNull || data.U_Cod_Vent.toLowerCase().includes(searchUbicacionesNull.toLowerCase()) || data.ItemCode.toLowerCase().includes(searchUbicacionesNull.toLowerCase()))" style="width: 100%" height="400" highlight-current-row :default-sort="{prop: 'id', order: 'descending'}">
                    <el-table-column align="center" label="Cod. SAP" sortable>
                        <template slot-scope="scope">
                            <p style="font-size: 12px;">
                                <strong>
                                    @{{scope.row.ItemCode}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="Descripción" sortable>
                        <template slot-scope="scope">
                            <p style="font-size: 12px;">
                                @{{scope.row.ItemName}}
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="Cod. Venta" sortable>
                        <template slot-scope="scope">
                            <p style="font-size: 12px;">
                                <strong>
                                    @{{scope.row.U_Cod_Vent}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="Almacen" sortable>
                        <template slot-scope="scope">
                            <el-tag size="mini" effect="plain">
                                @{{scope.row.WhsCode}}
                            </el-tag>
                        </template>
                    </el-table-column>
                    <el-table-column align="center">
                        <template slot="header" slot-scope="scope">
                            <el-input
                                v-model="searchUbicacionesNull"
                                size="mini"
                                placeholder="Buscar Articulo"/>
                        </template>
                        <template slot-scope="scope">
                            <el-button size="mini" type="primary"  icon="el-icon-check" circle @click="handleAdd()"></el-button>
                        </template>
                    </el-table-column>
                </el-table>
                </div>
            </div>
        </div>
    </el-collapse-transition>
    @include('panel.registros.ubicaciones.add')
    @include('panel.registros.ubicaciones.create')
</div>
@section('script')
{!!Html::script('js/ubicaciones.js')!!}
@endsection
@stop