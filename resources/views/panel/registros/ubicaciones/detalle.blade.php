<transition name="fade" mode="out-in" :duration="{ enter: 250, leave: 250 }">
    <template v-if="view==2">
        <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
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
                            <div class="text-center" v-if="lista.ESTADO==false">
                                <el-button type="success" @click="handleExportForItem()" icon="el-icon-message" size="mini">Enviar</el-button>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="pull-right" v-if="lista.ESTADO==false">
                                <el-button type="primary" @click="handleAdd()" icon="el-icon-plus" size="mini">Añadir</el-button>
                            </div>
                        </div>
                    </div>
                <el-table :data="ubicaciones" style="width: 100%" height="400" highlight-current-row :default-sort="{prop: 'id', order: 'descending'}">
                    <el-table-column align="center" fixed="left" label="Ubicación" sortable width="150">
                        <template slot-scope="scope">
                            <transition name="fade" mode="out-in" :duration="{ enter: 200, leave: 200 }">
                                <template v-if="scope.row.UBICACION_FISICA==null">
                                    <el-form :inline="true">
                                        <el-input v-if="lista.ESTADO==false" @keydown.native.enter.prevent="handleUpdateUbicacion(scope.$index,scope.row)" v-model="ubicacion[scope.$index]" placeholder="Ubicación" size="mini">
                                            <template slot="suffix">
                                                <el-button size="mini" style="padding: 4.8px;margin: 2px" circle type="primary" icon="el-icon-edit" @click="handleUpdateUbicacion(scope.$index,scope.row)"></el-button>
                                            </template>
                                        </el-input>
                                    </el-form>
                                </template>
                                <template v-else>
                                    <p>
                                        <el-tag size="mini" effect="dark" type="primary">
                                            @{{scope.row.UBICACION_FISICA}}
                                        </el-tag>
                                        <el-button v-if="lista.ESTADO==false" size="mini" circle type="danger" style="padding: 4.8px;margin: 2px" icon="el-icon-delete" @click="handleDeleteUbicacion(scope.$index,scope.row)"></el-button>
                                    </p>
                                </template>
                            </transition>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" prop="ItemCode" label="Cod. SAP" sortable width="120">
                        <template slot-scope="scope">
                            <p style="font-size: 12px;">
                                <strong>
                                    @{{scope.row.ITEMCODE}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="Cod. Venta" sortable width="150">
                        <template slot-scope="scope">
                            <p style="font-size: 12px;">
                                <strong>
                                    @{{scope.row.COD_VENTA}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="Cod. Compra" sortable width="150">
                        <template slot-scope="scope">
                            <p style="font-size: 12px;">
                                <strong>
                                    @{{scope.row.COD_COMPRA}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="Descripcion" sortable width="200">
                        <template slot-scope="scope">
                            <p style="font-size: 12px;">
                                @{{scope.row.DESCRIPCION}}
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="Medida" sortable width="120">
                        <template slot-scope="scope">
                            <p style="font-size: 12px;">
                                <strong>
                                    @{{scope.row.MEDIDA}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="OnHand" sortable width="100">
                        <template slot-scope="scope">
                            <el-tag size="mini" effect="plain" type="warning">
                                @{{parseFloat(scope.row.STOCK)}}
                            </el-tag>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="Almacen" sortable width="120">
                        <template slot-scope="scope">
                            <el-tag size="mini" effect="plain" type="primary">
                                @{{scope.row.ALMACEN}}
                            </el-tag>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" fixed="right" label="Acciones" width="100" v-if="lista.ESTADO==false">
                    <template slot-scope="scope">
                        <el-button size="mini" type="danger" icon="el-icon-close" circle @click="handleDeleteItem(scope.$index, scope.row)"></el-button>
                    </template>
                    </el-table-column>
                </el-table>
                </div>
            </div>
        </div>
    </template>
</transition>
<transition name="fade" mode="out-in" :duration="{ enter: 250, leave: 250 }">
    <template v-if="view==2 && lista.ESTADO==false">
        <div class="col-xs-12 col-sm-12 col-lg-12 col-md-12">
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
                    <el-table v-loading="loading.ubicacionesNull" :data="ubicacionesNull.filter(data => !search.ubicacionesNull || data.U_Cod_Vent.toLowerCase().includes(search.ubicacionesNull.toLowerCase()) || data.ItemCode.toLowerCase().includes(search.ubicacionesNull.toLowerCase()))" style="width: 100%" max-height="400" highlight-current-row :default-sort="{prop: 'id', order: 'descending'}">
                        <el-table-column align="center" label="Cod. SAP" sortable width="120">
                            <template slot-scope="scope">
                                <p style="font-size: 12px;">
                                    <strong>
                                        @{{scope.row.ItemCode}}
                                    </strong>
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="Cod. Venta" sortable width="150">
                            <template slot-scope="scope">
                                <p style="font-size: 12px;">
                                    <strong>
                                        @{{scope.row.U_Cod_Vent}}
                                    </strong>
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="Cod. Compra" sortable width="150">
                            <template slot-scope="scope">
                                <p style="font-size: 12px;">
                                    <strong>
                                        @{{scope.row.U_Cod_comp}}
                                    </strong>
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="Descripción" sortable width="180">
                            <template slot-scope="scope">
                                <p style="font-size: 12px;">
                                    @{{scope.row.ItemName}}
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="Medida" sortable width="100">
                            <template slot-scope="scope">
                                <p style="font-size: 12px;">
                                    <strong>
                                        @{{scope.row.InvntryUom}}
                                    </strong>
                                </p>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" label="OnHand" sortable width="100">
                                <template slot-scope="scope">
                                    <el-tag size="mini" effect="plain" type="warning">
                                        @{{ parseFloat(scope.row.OnHand)}}
                                    </el-tag>
                                </template>
                            </el-table-column>
                        <el-table-column align="center" label="Almacen" sortable width="120">
                            <template slot-scope="scope">
                                <el-tag size="mini" effect="plain">
                                    @{{scope.row.WhsCode}}
                                </el-tag>
                            </template>
                        </el-table-column>
                        <el-table-column align="center" fixed="right" width="120">
                            <template slot="header" slot-scope="scope">
                                <el-input
                                    v-model="search.ubicacionesNull"
                                    size="mini"
                                    placeholder="Buscar"/>
                            </template>
                            <template slot-scope="scope">
                                <el-button size="mini" type="primary"  icon="el-icon-check" circle @click="handleStoreItem(scope.$index, scope.row)"></el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
            </div>
        </div>
    </template>
</transition>