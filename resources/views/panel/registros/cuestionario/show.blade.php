<div class="modal fade" id="show"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Datos de Cuestionario</h4>
        </div>
        <div class="modal-body">
        <table class="table">
            <tbody>
            <tr>
                <td>
                    <strong>
                        Titulo
                    </strong>  
                </td>
                <td>@{{cuestionario.TITULO}}</td>
            </tr>
            <tr>
                <td>
                    <strong>
                        Area
                    </strong>
                </td>
                <td>@{{cuestionario.AREA}}</td>
            </tr>
            <tr v-if="cuestionario.USUARIO_ID">
                    <td>
                        <strong>
                            Creado por 
                        </strong>
                    </td>
                    <td>
                    @{{cuestionario.usuario.nombre+" "+cuestionario.usuario.apellido+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"}}
                    <el-popover placement="top" width="300" trigger="click">
                        <el-row>
                            <el-col span="12"><strong>Email :</strong></el-col>
                            <el-col span="12">@{{cuestionario.usuario.email}}</el-col>
                        </el-row>
                        <el-row>
                            <el-col span="12"><strong>Cargo :</strong></el-col>
                            <el-col span="12">@{{cuestionario.usuario.cargo}}</el-col>
                        </el-row>
                        <el-row>
                            <el-col span="12"><strong>Departamento :</strong></el-col>
                            <el-col span="12">@{{cuestionario.usuario.departamento}}</el-col>
                        </el-row>
                        <el-row>
                            <el-col span="12"><strong>Celular :</strong></el-col>
                            <el-col span="12">@{{cuestionario.usuario.celular}}</el-col>
                        </el-row>
                        <el-row>
                            <el-col span="12"><strong>Interno :</strong></el-col>
                            <el-col span="12">@{{cuestionario.usuario.interno}}</el-col>
                        </el-row>
                        <el-button slot="reference" size="mini" type="primary" icon="el-icon-link" plain circle></el-button>
                    </el-popover>  
                    </td>
                </tr>
            <tr>
                <td>
                    <strong>
                        Fecha de Registro
                    </strong>
                </td>
                <td>@{{cuestionario.FECHA_REGISTRO}}</td>
            </tr>
            <tr>
                <td>
                    <strong>
                        Fecha Cierre
                    </strong>
                </td>
                <td>@{{cuestionario.FECHA_CIERRE}}</td>
            </tr>
            <tr>
                <td>
                    <strong>
                        Grupo Asignado
                    </strong>
                </td>
                <td>
                    <template v-for="(item,index) in cuestionario.grupo">
                        @{{index=='NOMBRE'?item:''}}
                    </template>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <el-popover
                    placement="right"
                    width="400"
                    trigger="click">
                        <el-table :data="grupoUser">
                            <el-table-column property="usuario.nombre" label="Nombre"></el-table-column>
                            <el-table-column property="usuario.apellido" label="Apellido"></el-table-column>
                        </el-table>
                    <el-button slot="reference" circle type="primary" size="mini" plain icon="el-icon-link"></el-button>
                    </el-popover>
                </td>
            </tr>
            <tr>
                <td>
                    <strong>
                        Estado
                    </strong>
                </td>
                <td>
                    <el-tag v-if="cuestionario.ESTADO == 1" size="mini" type="primary">Activo</el-tag>
                    <el-tag v-else size="mini" type="danger">No activo</el-tag>
                </td>
            </tr>
            </tbody>
        </table>
        </div>
        </div>
    </div>
</div>
