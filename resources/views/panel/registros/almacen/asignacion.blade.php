<el-collapse-transition>
  <template v-if="show.error">
    <el-alert title="Ningun fabricante seleccionado" type="error" show-icon center  @close="handleCloseError()"></el-alert>
  </template>
</el-collapse-transition>
<div style="margin:10px;"></div>
<div class="row">
  <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6">
    <div class="text-center">
      <el-form :inline="true" :rules="rulesAsignacion" :model="createAsignacion" ref="createAsignacionForm">
        <el-form-item prop="USUARIO">
          <el-select size="mini" clearable filterable v-model="createAsignacion.USUARIO" placeholder="Seleccionar Usuario">
           <el-option
              v-for="item in usuarios"
             :key="item.id"
             :label="item.Nombre+' '+item.Apellido"
             :value="item.id">
           </el-option>
         </el-select>
        </el-form-item>
        <el-form-item>
          <el-button size="mini" round type="primary" icon="el-icon-document-checked" @click="handleStoreAsignacion()">Guardar</el-button>
        </el-form-item>
      </el-form>
    <el-transfer
      style="text-align: left; display: inline-block;"
      filterable
      filter-placeholder="Buscar Fabricante"
      v-model="createAsignacion.FABRICANTES"
      :props="{key: 'FirmCode',label: 'FirmName'}"
      :titles="['Fabricantes', 'Asignar']"
      :data="fabricantes">
    </el-transfer>
    </div>
  </div>
  <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
    <div class="row">
        <div v-for="asignacion in asignaciones">
          <div class="col-12 col-sm-6 col-md-6 col-xs-12">
            <el-card shadow="hover" style="margin-bottom:10px;">
              <p style="color:#409EFF">
                <strong>
                  @{{asignacion.usuario.nombre+' '+asignacion.usuario.apellido}}
                </strong>
                <el-button @click="handleEditAsignacion(asignacion)" class="pull-right" style="padding:3px;" size="mini" circle type="primary" icon="el-icon-edit"/>
              </p>
              <div v-for="fabricante in asignacion.fabricantes">
                <div style="border:solid 0.5px #E4E7ED; margin:6px 0px;width:100%"></div>
                <p style="font-size:11px">
                  @{{fabricante.FABRICANTE}}
                  <el-button @click="handleDeleteFabricante(fabricante.id)" class="pull-right" style="padding:2px;" size="mini" circle type="danger" icon="el-icon-close"/>
                </p>
              </div>
            </el-card>
          </div>
        </div>
    </div>
  </div>
</div>
@include('panel.registros.almacen.editAsignacion')
