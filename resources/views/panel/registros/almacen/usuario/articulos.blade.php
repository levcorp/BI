<div class="box box-info" v-if="fabricante.COUNT_ARTICULOS_CHECK!=fabricante.COUNT_ARTICULOS">
  <div class="box-header">
    <p style="font-size: 15px">
        <el-button @click="handleBackFabricantes()" type="primary" size="mini" circle icon="el-icon-arrow-left"></el-button>
        <strong>&nbsp;&nbsp;Articulos de @{{fabricante.FABRICANTE}}</strong>
    </p>
  </div>
  <div class="box-body">
    <el-table :data="articulos" v-loading="loading.articulos" style="width: 100%" height="400" highlight-current-row>
        <el-table-column align="center" label="#" sortable width="70">
            <template slot-scope="scope">
                <p style="font-size: 12px;">
                    <strong>
                        @{{scope.$index + 1}}
                    </strong>
                </p>
            </template>
        </el-table-column>
        <el-table-column align="center" prop="ItemCode" label="Cod. SAP" sortable width="120">
            <template slot-scope="scope">
                <p style="font-size: 12px;">
                    <strong>
                        @{{scope.row.ItemCode}}
                    </strong>
                </p>
            </template>
        </el-table-column>
        <el-table-column align="center" label="Cod. Venta" sortable width="120">
            <template slot-scope="scope">
                <p style="font-size: 12px;">
                    <strong>
                        @{{scope.row.U_Cod_Vent}}
                    </strong>
                </p>
            </template>
        </el-table-column>
        <el-table-column align="center" label="Descripcion" sortable>
            <template slot-scope="scope">
                <p style="font-size: 12px;">
                    @{{scope.row.ItemName}}
                </p>
            </template>
        </el-table-column>
        <el-table-column align="center" label="Ubicación" sortable width="180">
            <template slot-scope="scope">
                <p style="font-size: 12px;">
                    <strong>
                        @{{scope.row.U_UbicFis}}
                    </strong>
                </p>
            </template>
        </el-table-column>
        <el-table-column align="center" label="Cant. Stock" sortable width="100">
            <template slot-scope="scope">
                <el-tag size="mini" effect="plain" type="warning">
                    @{{parseFloat(scope.row.OnHand)}}
                </el-tag>
            </template>
        </el-table-column>
        <el-table-column align="center" label="Almacen" sortable width="120">
            <template slot-scope="scope">
                <el-tag size="mini" effect="plain" type="primary">
                    @{{scope.row.WhsCode}}
                </el-tag>
            </template>
        </el-table-column>
        <el-table-column align="center" label="Verificar" sortable width="120">
            <template slot-scope="scope">
              <el-button circle icon="el-icon-check" size="mini" type="success" @click="handleCreateArticulos(scope.$index,scope.row)"></el-button>
            </template>
        </el-table-column>
    </el-table>
  </div>
</div>
<div class="box box-info">
  <div class="box-header">
    <p style="font-size: 15px">
      <el-button v-if="fabricante.COUNT_ARTICULOS_CHECK==fabricante.COUNT_ARTICULOS" @click="handleBackFabricantes()" type="primary" size="mini" circle icon="el-icon-arrow-left"></el-button>
      <strong>&nbsp;&nbsp;Articulos Verificados</strong>
    </p>
  </div>
  <div class="box-body">
    <el-table :data="articulosCheck" v-loading="loading.articulosCheck" style="width: 100%" height="400" highlight-current-row>
        <el-table-column align="center" label="#" sortable width="70">
            <template slot-scope="scope">
                <p style="font-size: 12px;">
                    <strong>
                        @{{scope.$index + 1}}
                    </strong>
                </p>
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
        <el-table-column align="center" label="Cod. Venta" sortable width="120">
            <template slot-scope="scope">
                <p style="font-size: 12px;">
                    <strong>
                        @{{scope.row.COD_VENTA}}
                    </strong>
                </p>
            </template>
        </el-table-column>
        <el-table-column align="center" label="Descripcion" sortable>
            <template slot-scope="scope">
                <p style="font-size: 12px;">
                    @{{scope.row.ITEMNAME}}
                </p>
            </template>
        </el-table-column>
        <el-table-column align="center" label="Ubicación" sortable width="180">
            <template slot-scope="scope">
                <p style="font-size: 12px;">
                    <strong>
                        @{{scope.row.UBICACION}}
                    </strong>
                </p>
            </template>
        </el-table-column>
        <el-table-column align="center" label="Cant. Stock" sortable width="100">
            <template slot-scope="scope">
                <el-tag size="mini" effect="plain" type="warning">
                    @{{parseFloat(scope.row.ONHAND)}}
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
        <el-table-column align="center" label="Observaciones" sortable width="150">
            <template slot-scope="scope">
                    @{{scope.row.OBSERVACION ? scope.row.OBSERVACION : 'Sin Observaciones'}}
            </template>
        </el-table-column>
    </el-table>
  </div>
</div>
@include('panel.registros.almacen.usuario.observacion')
