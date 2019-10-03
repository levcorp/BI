<div class="modal fade" id="createItem"  tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Crear Articulo</h4>
            </div>
            <el-form :model="createItem" ref="FormItem" label-position="top" :rules="rulesItem" label-width="180px" size="mini">
            <div class="modal-body">
                <el-form-item prop="serie">
                    <strong>Serie</strong>
                    <el-select v-model="createItem.serie" style="width: 100%">
                        <el-option v-for="item in series" :key="item.value" :label="item.label" :value="item.value"></el-option>
                    </el-select>
                </el-form-item>
                <div class="row">
                    <div class="col-sm-6">
                        <el-form-item prop="fabricante">
                            <strong>Fabricante</strong><br>
                            <el-select
                                v-model="createItem.fabricante"
                                filterable
                                remote
                                :disabled="disable.fabricante"
                                reserve-keyword
                                placeholder="Seleccionar"
                                :remote-method="handleGetFabricantes"
                                :loading="loading.fabricante" style="width: 100%">
                                <el-option
                                v-for="item in fabricantes"
                                :key="item.FirmName"
                                :label="item.FirmName"
                                :value="item.FirmName">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </div>
                    <div class="col-sm-6">
                        <el-form-item prop="proveedor">
                            <strong>Proveedor</strong><br>
                            <el-select
                                v-model="createItem.proveedor"
                                filterable
                                remote
                                :disabled="disable.proveedor"
                                reserve-keyword
                                placeholder="Seleccionar"
                                :remote-method="handleGetProveedores"
                                :loading="loading.proveedor" style="width: 100%">
                                <el-option
                                v-for="item in proveedores"
                                :key="item.CardName"
                                :label="item.CardName"
                                :value="item.CardName">
                                </el-option>
                            </el-select>
                        </el-form-item>
                    </div>
                    <div class="col-sm-6">
                        <el-form-item prop="cod_especialidad">
                            <strong>Especialidad</strong>
                            <el-select v-model="createItem.cod_especialidad" style="width: 100%">
                                <el-option v-for="item in especialidades" :key="item.Especialidad" :label="item.Descripcion" :value="item.Especialidad"></el-option>
                            </el-select>
                        </el-form-item>
                    </div>
                    <div class="col-sm-6">
                        <el-form-item prop="medida">
                            <strong>Unidad Medida</strong>
                            <el-select v-model="createItem.medida" style="width: 100%" placeholder="Seleccionar Medida">
                                <el-option v-for="item in medidas" :key="item.value" :label="item.label" :value="item.value"></el-option>
                            </el-select>
                        </el-form-item>
                    </div>
                    <div class="col-sm-6">
                        <el-form-item prop="cod_venta">
                            <strong>Codigo Venta</strong>
                            <el-input size="mini" v-model="createItem.cod_venta"></el-input>
                        </el-form-item>
                    </div>
                    <div class="col-sm-6">
                        <el-form-item prop="cod_compra">
                            <strong>Codigo Compra</strong>
                            <el-input size="mini" v-model="createItem.cod_compra">
                                <template v-if="show.pre_cod" slot="prepend">
                                    <strong>
                                            @{{createItem.pre_cod}}
                                    </strong>
                                </template>
                            </el-input>
                        </el-form-item>
                    </div>
                </div>
                <div class="row">
                    <el-collapse-transition>
                        <div class="col-sm-6" v-if="show.upc">
                            <el-form-item prop="upc">
                                <strong>UPC</strong>
                                <el-input type="text" v-model="createItem.upc"></el-input>
                            </el-form-item>
                        </div>
                    </el-collapse-transition>
                    <div class="col-sm-6">
                        <el-form-item prop="descripcion">
                            <strong>Descripción</strong>
                            <el-input type="textarea" autosize size="mini" v-model="createItem.descripcion"></el-input>
                        </el-form-item>
                    </div>
                    <div class="col-sm-6">
                        <el-form-item prop="comentarios">
                            <strong>Comentarios</strong>
                            <el-input type="textarea" autosize size="mini" v-model="createItem.comentarios"></el-input>
                        </el-form-item>
                    </div>
                </div>  
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <el-button size="small" type="primary" @click="handleStoreItem()">Crear</el-button>
                    <el-button size="small" data-dismiss="modal">Cancelar</el-button>
                </div>
            </div>
            </el-form>
        </div>
    </div>
    <!-- /.modal-content -->
</div>
