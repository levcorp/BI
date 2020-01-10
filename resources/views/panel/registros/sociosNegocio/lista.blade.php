<template v-if="view.lista">
<div class="col-xs-12">
    <div class="box box-info">
        <div class="box-header">
          <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                <p style="font-size: 15px; padding-left: 15px;">
                    <strong>
                        Socios de Negocio Pendiente
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
                    >Crear Socio
                    </el-button>
                  </div>
              </div>
          </div>
        </div>
        <div class="box-body">
          <el-table :data="socios.pendientes" style="width: 100%" max-height="450" highlight-current-row>
              <el-table-column width="70" align="center" label="#">
                <template slot-scope="scope">
                  <span style="margin-left: 10px">@{{ scope.row.id }}</span>
                </template>
              </el-table-column>
              <el-table-column align="center" prop="nombre" label="Nombre"></el-table-column>
              <el-table-column align="center" prop="ciudad" label="Razon Social"></el-table-column>
              <el-table-column align="center" prop="telefono" label="NIT"></el-table-column>
              <el-table-column align="center" label="Acciones" width="180">
                  <template slot-scope="scope">
                  </template>
              </el-table-column>
          </el-table>
        </div>
    </div>
</div>
<div class="col-xs-12">
    <div class="box box-info">
        <div class="box-header">
          <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                <p style="font-size: 15px; padding-left: 15px;">
                    <strong>
                        Socios de Negocio Realizados
                    </strong>
                </p>
              </div>
          </div>
        </div>
        <div class="box-body">
          <el-table :data="socios.pendientes" style="width: 100%" max-height="450" highlight-current-row>
              <el-table-column width="70" align="center" label="#">
                <template slot-scope="scope">
                  <span style="margin-left: 10px">@{{ scope.row.id }}</span>
                </template>
              </el-table-column>
              <el-table-column align="center" prop="nombre" label="Nombre"></el-table-column>
              <el-table-column align="center" prop="ciudad" label="Razon Social"></el-table-column>
              <el-table-column align="center" prop="telefono" label="NIT"></el-table-column>
              <el-table-column align="center" label="Acciones" width="180">
                  <template slot-scope="scope">
                  </template>
              </el-table-column>
          </el-table>
        </div>
    </div>
</div>
</template>