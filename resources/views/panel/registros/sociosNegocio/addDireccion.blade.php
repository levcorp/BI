<el-card shadow="never" style="border: #d9ebff solid 1px;min-height: 220px;">
    <transition name="el-fade-in">
        <div v-if="view.listDireccion">
            <template>
                <div class="row" style="margin-bottom: 5px;">
                    <div class="col-sm-6">
                        <div class="pull-left">
                            <p>
                                <strong>
                                    Lista de Direcciones
                                </strong>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="pull-right">
                            <el-button @click="handleShowCreateDireccion" style="padding:6px;font-size: 11px;" round size="mini" icon="el-icon-plus" type="primary">Crear Dirección</el-button>
                        </div>
                    </div>
                </div>
                <el-table :header-cell-style="handleStyleHead" border :data="socio.create.Direccion" style="width: 100%"> 
                    <el-table-column prop="IDDireccion" label="ID Dirección">
                    </el-table-column>
                    <el-table-column prop="Calle" label="Calle/Número">
                    </el-table-column>
                    <el-table-column prop="Ciudad" label="Ciudad">
                    </el-table-column>
                    <el-table-column prop="Estado" label="Estado">
                    </el-table-column>
                    <el-table-column prop="Pais" label="Pais">
                    </el-table-column>
                </el-table>
            </template>
        </div>
    </transition>
    <transition name="el-fade-in">
        <div v-if="view.direccion">
            <template>
                <div class="row">
                    <div class="col-sm-4">
                        <el-form-item>
                            <strong style="font-size: 12px;">ID Dirección</strong><br>
                            <el-input style="width: 100%" size="mini" v-model="socio.create.Nombre"></el-input>
                        </el-form-item>
                    </div>
                    <div class="col-sm-4">
                        <el-form-item>
                            <strong style="font-size: 12px;">Calle / Número</strong><br>
                            <el-input style="width: 100%" size="mini" v-model="socio.create.Nombre"></el-input>
                        </el-form-item>
                    </div>
                    <div class="col-sm-4">
                        <el-form-item>
                            <strong style="font-size: 12px;">Ciudad</strong><br>
                            <el-input style="width: 100%" size="mini" v-model="socio.create.Nombre"></el-input>
                        </el-form-item>
                    </div>
                    <div class="col-sm-4">
                        <el-form-item>
                            <strong style="font-size: 12px;">Estado</strong><br>
                            <el-input style="width: 100%" size="mini" v-model="socio.create.Nombre"></el-input>
                        </el-form-item>
                    </div>
                    <div class="col-sm-4">
                        <el-form-item>
                            <strong style="font-size: 12px;">Pais</strong><br>
                            <el-input style="width: 100%" size="mini" v-model="socio.create.Nombre"></el-input>
                        </el-form-item>
                    </div>
                    <div class="col-sm-12" style="text-align: center">
                        <el-button @click="handleBackListaDireccion" round size="mini" type="info">Cancelar</el-button>
                        <el-button round size="mini" type="primary">Crear</el-button>
                    </div>
                </div>
            </template>
        </div>
    </transition>
</el-card>