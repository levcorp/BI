<div class="modal fade" id="modalSC"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Lista de registros EDI 852 Santa Cruz</h4>
        </div>
        <div class="modal-body">
            <el-input v-model="search" placeholder="Buscar"></el-input>
             <el-table v-loading="loading" highlight-current-row height="430" :data="EDISC.filter(data => !search || data.ItemCode.toLowerCase().includes(search.toLowerCase()) || data.U_Cod_comp.toLowerCase().includes(search.toLowerCase()) || data.U_cat_id.toLowerCase().includes(search.toLowerCase()))" style="width: 100%">
                <el-table-column align="center" sortable width="110" label="Item Code" prop="ItemCode"></el-table-column>
                <el-table-column align="center" sortable width="120" label="Cod Compra" prop="U_Cod_comp"></el-table-column>
                <el-table-column align="center" sortable width="130" label="UPC" prop="U_cat_id"></el-table-column>
                <el-table-column align="center" width="60" label="Status">
                    <template slot-scope="scope">
                        <el-tag
                        :type="scope.row.U_Item_Status === 'A' ? 'success' : scope.row.U_Item_Status === 'D' ? 'primary' : scope.row.U_Item_Status === 'M' | scope.row.U_Item_Status === 'R' ? 'warning' : scope.row.U_Item_Status === 'I' | scope.row.U_Item_Status === 'O' ? 'danger' "
                        disable-transitions>@{{scope.row.U_Item_Status}}</el-tag>
                    </template>
                </el-table-column>
                <el-table-column align="center" width="60" label="Stock" prop="Onhand"></el-table-column>
                <el-table-column align="center" width="60" label="OV" prop="Commit_to_sale"></el-table-column>
                <el-table-column align="center" width="60" label="OV A HUB" prop="Back_Order"></el-table-column>
                <el-table-column align="center" width="60" label="PO" prop="On_Order"></el-table-column>
                <el-table-column align="center" width="100" label="A Trasferir" prop="Transfered"></el-table-column>
                <el-table-column align="center" width="110" label="Transfiriendo" prop="Transit"></el-table-column>
            </el-table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>