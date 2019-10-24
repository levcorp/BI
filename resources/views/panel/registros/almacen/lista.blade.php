<div class="box box-info">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
          <p style="font-size: 15px">
              <strong>&nbsp;&nbsp;Datos de Almacen</strong>
          </p>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
            <div class="pull-right" style="margin-right: 10px">
              <el-button round size="mini" type="primary" icon="el-icon-plus" @click="handleCreateList()">Crear Lista</el-button>
            </div>
        </div>
    </div>
  </div>
  <div class="box-body">
    <el-table v-loading="loading.listas" :data="listas" style="width: 100%" highlight-current-row>
      <el-table-column width="70" align="center" label="#">
        <template slot-scope="scope">
          <span style="margin-left: 10px">@{{ scope.$index+1 }}</span>
        </template>
      </el-table-column>
      <el-table-column align="center" prop="NOMBRE" label="Nombre"></el-table-column>
      <el-table-column align="center" prop="DESCRIPCION" label="Descripción"></el-table-column>
      <el-table-column align="center" prop="CREACION" label="Fecha Creación">
        <template slot-scope="scope">
            @{{scope.row.CREACION | moment('calendar',null,{sameElse : 'YYYY-MM-DD HH:mm'})  | capitalize({ onlyFirstLetter: true }) }}
        </template>
      </el-table-column>
      <el-table-column align="center" label="Operaciones">
          <template slot-scope="scope">
            <el-button circle icon="el-icon-plus" size="mini" type="success" @click="handleShowList(scope.$index,scope.row)"></el-button>
            <el-button circle icon="el-icon-edit" size="mini" type="primary" @click="handleEditList(scope.$index,scope.row)"></el-button>
            <el-button circle size="mini" type="danger" icon="el-icon-delete" @click="handleDeleteList(scope.$index,scope.row)"></el-button>
          </template>
      </el-table-column>
    </el-table>
  </div>
  @include('panel.registros.almacen.createList')
  @include('panel.registros.almacen.editLista')
</div>
