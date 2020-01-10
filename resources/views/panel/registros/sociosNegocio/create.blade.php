<template v-if="view.create">
    <div class="col-xs-12">
        <div class="box box-info">
            <div class="box-header">
              <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                    <p style="font-size: 15px; padding-left: 15px;">
                        <el-button size="mini" type="primary" icon="el-icon-arrow-left"
                        @click="handleBackLista()" circle></el-button>
                        <strong>
                            &nbsp;Formulario de Socio de Negocio
                        </strong>
                    </p>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                      <div class="pull-right" style="margin-right: 10px">
                        <el-button
                        size="mini"
                        round
                        type="primary"
                        icon="el-icon-plus"
                        @click="handleCreateSocio()"
                        >Crear Socio Negocio
                        </el-button>
                      </div>
                  </div>
              </div>
            </div>
            <el-form ref="form"  size="mini" label-position="top" :model="socio.create" label-width="180px">
            <div class="box-body" style="margin-left: 25px;margin-right: 25px;">
                    <el-card shadow="never" style="border: #d9ebff solid 1px">
                        <div class="row">
                            <div class="col-sm-3">
                                <el-form-item>
                                    <strong style="font-size: 12px;">Tipo</strong><br>
                                    <el-select style="width: 100%" clearable size="mini" v-model="socio.create.Tipo" placeholder="Tipo Socio de Negocio">
                                        <el-option
                                        v-for="item in datos.CardType"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                            <div class="col-sm-3">
                                <el-form-item>
                                    <strong style="font-size: 12px;">Serie</strong><br>
                                    <el-select style="width: 100%" clearable size="mini" v-model="socio.create.Serie" placeholder="Serie">
                                        <el-option
                                        v-for="item in datos.SeriesFilter"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                        </div>
                    </el-card>
                    <br>
                    <el-card shadow="never" style="border: #d9ebff solid 1px">
                        <div class="row">
                            <div class="col-sm-4">
                                <el-form-item>
                                    <strong style="font-size: 12px;">Nombre</strong><br>
                                    <el-input style="width: 100%" size="mini" v-model="socio.create.Nombre"></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-sm-4">
                                <el-form-item>
                                    <strong style="font-size: 12px;">Nombre Extranjero</strong><br>
                                    <el-input style="width: 100%" size="mini" v-model="socio.create.NombreExtranjero"></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-sm-4">
                                <el-form-item>
                                    <strong style="font-size: 12px;">Grupo</strong><br>
                                    <el-select style="width: 100%" clearable size="mini" v-model="socio.create.Grupo" placeholder="Grupo">
                                        <el-option
                                        v-for="item in datos.grupo"
                                        :key="item.GroupCode"
                                        :label="item.GroupName"
                                        :value="item.GroupCode">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                            <div class="col-sm-4">
                                <el-form-item>
                                    <strong style="font-size: 12px;">Moneda</strong><br>
                                    <el-select style="width: 100%" clearable size="mini" v-model="socio.create.Moneda" placeholder="Grupo">
                                        <el-option
                                        v-for="item in datos.moneda"
                                        :key="item.value"
                                        :label="item.label"
                                        :value="item.value">
                                        </el-option>
                                    </el-select>
                                </el-form-item>
                            </div>
                            <div class="col-sm-4">
                                <el-form-item>
                                    <strong style="font-size: 12px;">NIT</strong><br>
                                    <el-input style="width: 100%" size="mini" v-model="socio.create.NIT"></el-input>
                                </el-form-item>
                            </div>
                        </div>
                    </el-card>
                    <br>
                    <el-card shadow="never" style="border: #d9ebff solid 1px">
                        <div class="row">
                            <div class="col-sm-3">
                                <el-form-item>
                                    <strong style="font-size: 12px;">Teléfono 1</strong><br>
                                    <el-input style="width: 100%" size="mini" v-model="socio.create.Telefono1"></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-sm-3">
                                <el-form-item>
                                    <strong style="font-size: 12px;">Teléfono 2</strong><br>
                                    <el-input style="width: 100%" size="mini" v-model="socio.create.Telefono2"></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-sm-3">
                                <el-form-item>
                                    <strong style="font-size: 12px;">Fax</strong><br>
                                    <el-input style="width: 100%" size="mini" v-model="socio.create.Fax"></el-input>
                                </el-form-item>
                            </div>
                            <div class="col-sm-3">
                                <el-form-item>
                                    <strong style="font-size: 12px;">Pagina Web</strong><br>
                                    <el-input style="width: 100%" size="mini" v-model="socio.create.Web"></el-input>
                                </el-form-item>
                            </div>
                        </div>
                    </el-card>
                    <br>
                        @include('panel.registros.sociosNegocio.addContacto')
                    <br>
                        @include('panel.registros.sociosNegocio.addDireccion')
                    <br>
                </div>
            </el-form>
        </div>
    </div>
</template>