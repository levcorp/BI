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
@include('panel.registros.ubicaciones.detalle')
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