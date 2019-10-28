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
    <el-table-column align="center" prop="ItemCode" label="Cod. SAP" sortable>
        <template slot-scope="scope">
            <p style="font-size: 12px;">
                <strong>
                    @{{scope.row.ItemCode}}
                </strong>
            </p>
        </template>
    </el-table-column>
    <el-table-column align="center" label="Cod. Venta" sortable>
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
    <el-table-column align="center" label="Fabricante" sortable >
        <template slot-scope="scope">
            <p style="font-size: 12px;">
                <strong>
                    @{{scope.row.FirmName}}
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
    <el-table-column align="center" label="Almacen" sortable>
        <template slot-scope="scope">
            <el-tag size="mini" effect="plain" type="primary">
                @{{scope.row.WhsCode}}
            </el-tag>
        </template>
    </el-table-column>
</el-table>
