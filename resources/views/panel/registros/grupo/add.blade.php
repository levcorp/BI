<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Añadir Usuarios</h4>
        </div>
        <div class="modal-body">
            <el-table height="400" :data="usuarios.filter(data => !searchUsuarios || data.nombre.toLowerCase().includes(searchUsuarios.toLowerCase())|| data.apellido.toLowerCase().includes(searchUsuarios.toLowerCase()))" style="width: 100%" >
                <el-table-column prop="id" label="#" width="50"></el-table-column>
                <el-table-column prop="nombre" label="Nombre"></el-table-column>
                <el-table-column prop="apellido" label="Apellido">
                </el-table-column>
                <el-table-column label="Operaciones" align="center">
                    <template slot="header" slot-scope="scope">
                        <el-input
                        v-model="searchUsuarios"
                        size="mini"
                        placeholder="Buscar Usuario"/>
                    </template>
                    <template slot-scope="scope">
                        <el-button
                        size="mini"
                        type="warning"
                        icon="el-icon-plus"
                        plain
                        @click="handleAssignmentCreate(scope.$index,scope.row)"
                        circle>
                        </el-button>
                    </template>
                </el-table-column>
            </el-table> 
        </div>
        <div class="modal-footer">
            <el-button size="medium" type="primary" icon="el-icon-close" data-dismiss="modal"> Cerrar</el-button>
        </div>
        </div>
    </div>
</div>