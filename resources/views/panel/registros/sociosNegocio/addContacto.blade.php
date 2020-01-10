<el-card shadow="never" style="border: #d9ebff solid 1px;min-height: 220px;">
    <transition name="el-fade-in">
        <div v-if="view.listContacto">
            <template>
                <div class="row" style="margin-bottom: 5px;">
                    <div class="col-sm-6">
                        <div class="pull-left">
                            <p>
                                <strong>
                                    Lista de Contactos
                                </strong>
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="pull-right">
                            <el-button @click="handleShowCreateContacto" style="padding:6px;font-size: 11px;" round size="mini" icon="el-icon-plus" type="primary">Crear Contacto</el-button>
                        </div>
                    </div>
                </div>
                <el-table :header-cell-style="handleStyleHead" :cell-style="handleStyleCell" border :data="socio.create.Contacto" style="width: 100%"> 
                    <el-table-column prop="IDContacto" label="ID Contacto" >
                    </el-table-column>
                    <el-table-column prop="Nombre" label="Nombre">
                    </el-table-column>
                    <el-table-column prop="Apellido" label="Apellido">
                    </el-table-column>
                    <el-table-column prop="Celular" label="Celular ">
                    </el-table-column>
                    <el-table-column prop="Correo" label="Correo">
                    </el-table-column>
                    <el-table-column prop="Telefono" label="Telefono">
                    </el-table-column>
                </el-table>
            </template>
        </div>
    </transition>
    <transition name="el-fade-in">
        <div v-if="view.contacto">
            <template>
                <div class="row" >
                    <div class="col-sm-4">
                        <el-form-item>
                            <strong style="font-size: 12px;">ID Contacto</strong><br>
                            <el-input style="width: 100%" size="mini" v-model="socio.create.Nombre"></el-input>
                        </el-form-item>
                    </div>
                    <div class="col-sm-4">
                        <el-form-item>
                            <strong style="font-size: 12px;">Nombre</strong><br>
                            <el-input style="width: 100%" size="mini" v-model="socio.create.Nombre"></el-input>
                        </el-form-item>
                    </div>
                    <div class="col-sm-4">
                        <el-form-item>
                            <strong style="font-size: 12px;">Apellido</strong><br>
                            <el-input style="width: 100%" size="mini" v-model="socio.create.Nombre"></el-input>
                        </el-form-item>
                    </div>
                    <div class="col-sm-4">
                        <el-form-item>
                            <strong style="font-size: 12px;">Celular</strong><br>
                            <el-input style="width: 100%" size="mini" v-model="socio.create.Nombre"></el-input>
                        </el-form-item>
                    </div>
                    <div class="col-sm-4">
                        <el-form-item>
                            <strong style="font-size: 12px;">Correo</strong><br>
                            <el-input style="width: 100%" size="mini" v-model="socio.create.Nombre"></el-input>
                        </el-form-item>
                    </div>
                    <div class="col-sm-4">
                        <el-form-item>
                            <strong style="font-size: 12px;">Telefono</strong><br>
                            <el-input style="width: 100%" size="mini" v-model="socio.create.Nombre"></el-input>
                        </el-form-item>
                    </div>
                    <div class="col-sm-12" style="text-align: center">
                        <el-button @click="handleBackListaContacto" round size="mini" type="info">Cancelar</el-button>
                        <el-button round size="mini" type="primary">Crear</el-button>
                    </div>
                </div>
            </template>
        </div>
    </transition>
</el-card>