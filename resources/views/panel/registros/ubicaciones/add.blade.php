<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <el-form :inline="true" ref="formArticulos" :model="search" :rules="rulesArticulos">
                            <el-form-item label="Buscar Articulo" prop="codVenta">
                                <el-input @keydown.native.enter.prevent="handleSearchCodVenta()" size="mini" v-model="search.codVenta" placeholder="Codigo Venta"></el-input>
                            </el-form-item>
                            <el-form-item prop="ciudad">
                                <el-dropdown type="primary" @command="handleChoseSucursal">
                                    <el-button type="primary" size="mini">
                                        @{{ciudad.add?ciudad.add:ciudad.init}}<i class="el-icon-arrow-down el-icon--right"></i>
                                    </el-button>
                                    <el-dropdown-menu slot="dropdown">
                                        <el-dropdown-item v-if="ciudad.init=='La Paz'" command="La Paz">La Paz</el-dropdown-item>
                                        <el-dropdown-item v-if="ciudad.init=='Santa Cruz'" command="Cochabamba">Cochabamba</el-dropdown-item>
                                        <el-dropdown-item v-if="ciudad.init=='Santa Cruz'" command="Santa Cruz">Santa Cruz</el-dropdown-item>
                                    </el-dropdown-menu>
                                </el-dropdown>
                            </el-form-item>
                            <el-form-item>
                                <el-button size="mini" @click="handleSearchCodVenta()" type="primary" icon="el-icon-search" circle></el-button>
                            </el-form-item>
                        </el-form>
                    </div>
                </div>
                <el-table height="400" v-loading="loading.articulos" :data="articulos" style="width: 100%" highlight-current-row :default-sort="{prop: 'id', order: 'descending'}">
                    <el-table-column align="center" label="Cod. SAP" width="120">
                        <template slot-scope="scope">
                            <p style="font-size: 12px;">
                                <strong>
                                    @{{scope.row.ItemCode}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="Cod. Venta" width="150">
                        <template slot-scope="scope">
                            <p style="font-size: 12px;">
                                <strong>
                                    @{{scope.row.U_Cod_Vent}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="Cod. Compra" width="150">
                        <template slot-scope="scope">
                            <p style="font-size: 12px;">
                                <strong>
                                    @{{scope.row.U_Cod_comp}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="Descripción" width="180">
                        <template slot-scope="scope">
                            <p style="font-size: 12px;">
                                @{{scope.row.ItemName}}
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="Medida" width="100">
                        <template slot-scope="scope">
                            <p style="font-size: 12px;">
                                <strong>
                                    @{{scope.row.InvntryUom}}
                                </strong>
                            </p>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" label="OnHand" width="100">
                            <template slot-scope="scope">
                                <el-tag size="mini" effect="plain" type="warning">
                                    @{{ parseFloat(scope.row.OnHand)}}
                                </el-tag>
                            </template>
                        </el-table-column>
                    <el-table-column align="center" label="Almacen" width="120">
                        <template slot-scope="scope">
                            <el-tag size="mini" effect="plain">
                                @{{scope.row.WhsCode}}
                            </el-tag>
                        </template>
                    </el-table-column>
                    <el-table-column align="center" fixed="right" width="100" label="Añadir">
                        <template slot-scope="scope">
                            <el-button size="mini" type="primary" icon="el-icon-check" circle @click="handleStoreItem(scope.$index, scope.row)"></el-button>
                        </template>
                    </el-table-column>
                </el-table>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <el-button size="small" type="primary" data-dismiss="modal">Cerrar</el-button>
                </div>
            </div>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
