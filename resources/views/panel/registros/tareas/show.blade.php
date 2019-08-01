<div class="modal fade" id="show"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Datos de la Tarea</h4>
        </div>
        <div class="modal-body">
        <table class="table">
            <tbody>
            <tr>
                <td>
                    <strong>
                        Especialidad
                    </strong>  
                </td>
                <td>@{{this.tarea.BRAND}}</td>
            </tr>
            <tr>
                <td>
                    <strong>
                        Mercado
                    </strong>
                </td>
                <td>@{{this.tarea.SECTOR}}</td>
            </tr>
            <tr>
                <td>
                    <strong>
                        Fecha de Registro
                    </strong>
                </td>
                <td>@{{this.tarea.FECHA_REGISTRO}}</td>
            </tr>
            <tr>
                <td>
                    <strong>
                        Fecha de Cierre
                    </strong>
                </td>
                <td>@{{tarea.FECHA_CIERRE}}</td>
            </tr>
            <tr>
                <td>
                    <strong>
                        Cliente
                    </strong>
                </td>
                <td>@{{this.tarea.CLIENTE}}</td>
            </tr>
            <tr v-if="tarea.USUARIO_ID">
                <td>
                    <strong>
                        Asignado
                    </strong>
                </td>
                <td>
                @{{tarea.usuario.nombre+" "+tarea.usuario.apellido+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"}}
                <el-popover placement="top" width="300" trigger="click">
                    <el-row>
                        <el-col span="12"><strong>Email :</strong></el-col>
                        <el-col span="12">@{{asig_user.email}}</el-col>
                    </el-row>
                    <el-row>
                        <el-col span="12"><strong>Cargo :</strong></el-col>
                        <el-col span="12">@{{asig_user.cargo}}</el-col>
                    </el-row>
                    <el-row>
                        <el-col span="12"><strong>Departamento :</strong></el-col>
                        <el-col span="12">@{{asig_user.departamento}}</el-col>
                    </el-row>
                    <el-row>
                        <el-col span="12"><strong>Celular :</strong></el-col>
                        <el-col span="12">@{{asig_user.celular}}</el-col>
                    </el-row>
                    <el-row>
                        <el-col span="12"><strong>Interno :</strong></el-col>
                        <el-col span="12">@{{asig_user.interno}}</el-col>
                    </el-row>
                    <el-button slot="reference" size="mini" type="primary" icon="el-icon-link" plain circle></el-button>
                </el-popover>  
                </td>
            </tr>
            <tr>
                <td>
                    <strong>
                        Creador de la tarea
                    </strong>
                </td>
                <td>
                    @{{create_user.nombre+" "+create_user.apellido+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"}}
                    <el-popover placement="top" width="300" trigger="click">
                    <el-row>
                        <el-col span="12"><strong>Email :</strong></el-col>
                        <el-col span="12">@{{create_user.email}}</el-col>
                    </el-row>
                    <el-row>
                        <el-col span="12"><strong>Cargo :</strong></el-col>
                        <el-col span="12">@{{create_user.cargo}}</el-col>
                    </el-row>
                    <el-row>
                        <el-col span="12"><strong>Departamento :</strong></el-col>
                        <el-col span="12">@{{create_user.departamento}}</el-col>
                    </el-row>
                    <el-row>
                        <el-col span="12"><strong>Celular :</strong></el-col>
                        <el-col span="12">@{{create_user.celular}}</el-col>
                    </el-row>
                    <el-row>
                        <el-col span="12"><strong>Interno :</strong></el-col>
                        <el-col span="12">@{{create_user.interno}}</el-col>
                    </el-row>
                    <el-button slot="reference" size="mini" type="primary" icon="el-icon-link" plain circle></el-button>
                    </el-popover>  
                </td>
            </tr>
            <tr>
                <td>
                    <strong>
                        Nombre de la tarea
                    </strong>
                </td>
                <td>@{{this.tarea.TAREA}}
                </td>
            </tr>
            <tr>
                <td>
                    <strong>
                        Descripcion
                    </strong>
                </td>
                <td>@{{this.tarea.DESCRIPCION}}</td>
            </tr>
            <tr v-if="tarea.ESTADO_TAREA_ID">
                <td>
                    <strong>
                        Estado de la Tarea
                    </strong>
                </td>
                <td>
                <el-tag :type="tarea.estado.COLOR" size="mini">
                    <i :class="tarea.estado.ICON"></i>
                    <span style="margin-left: 10px" >@{{ tarea.estado.ESTADO_TAREA }}</span>
                </el-tag>
                </td>
            </tr>
            </tbody>
        </table>
        </div>
        </div>
    </div>
</div>
