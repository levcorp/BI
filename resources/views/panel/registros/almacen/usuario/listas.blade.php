<div class="box box-info">
  <div class="box-header">
      <p style="font-size: 15px">
          <strong>&nbsp;&nbsp;Listas Asignadas</strong>
      </p>
  </div>
  <div class="box-body">
    <el-table v-loading="loading.listas" :data="listas" style="width: 100%" highlight-current-row>
      <el-table-column width="70" align="center" label="#">
        <template slot-scope="scope">
          <p style="font-size: 13px;">
            <span style="margin-left: 10px">@{{ scope.$index+1 }}</span>
          </p>
        </template>
      </el-table-column>
      <el-table-column align="center" prop="NOMBRE" label="Nombre">
        <template slot-scope="scope">
          <p style="font-size: 13px;">
              <strong>
                  @{{ scope.row.lista.NOMBRE }}
              </strong>
          </p>
        </template>
      </el-table-column>
      <el-table-column align="center" prop="DESCRIPCION" label="Descripción">
        <template slot-scope="scope">
          <p style="font-size: 13px;">
            @{{ scope.row.lista.DESCRIPCION }}
          </p>
        </template>
      </el-table-column>
      <el-table-column align="center" prop="CREACION" label="Fecha Creación">
        <template slot-scope="scope">
          <p style="font-size: 13px;">
              <strong>
                @{{scope.row.lista.CREACION | moment('calendar',null,{sameElse : 'YYYY-MM-DD HH:mm'})  | capitalize({ onlyFirstLetter: true }) }}
              </strong>
          </p>
        </template>
      </el-table-column>
      <el-table-column align="center" label="Operaciones">
          <template slot-scope="scope">
            <el-button circle icon="el-icon-plus" size="mini" type="primary" @click="handleShow(scope.$index,scope.row)"></el-button>
            <el-button circle icon="el-icon-notebook-2" size="mini" type="success" @click="handleExportLista(scope.$index,scope.row)"></el-button>
          </template>
      </el-table-column>
    </el-table>
  </div>
</div>
