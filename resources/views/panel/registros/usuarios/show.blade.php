<div class="modal fade" id="show"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Datos del usuario</h4>
        </div>
        <div class="modal-body">
        <table class="table">
            <tbody>
            <tr>
                <td>Nombre</td>
                <td v-for="item in usuario.givenname">
                    @{{item}}
                </td>
            </tr>
            <tr>
                <td>Apellido</td>
                <td v-for="item in usuario.sn">
                      @{{item}}         
                </td>
            </tr>
            <tr>
                <td>Correo Electronico</td>
                <td v-for="item in usuario.mail">
                      @{{item}}                         
                </td>
            </tr>
            <tr>
                <td>Ciudad</td>
                <td v-for="item in usuario.l">
                     @{{item}}                                      
                </td>
            </tr>
            <tr>
                <td>Pais</td>
                <td v-for="item in usuario.c">
                     @{{item}}                                                    
                </td>
            </tr>
                 <tr>
                <td>Movil</td>
                <td v-for="item in usuario.mobile">
                     @{{item}}                                                    
                </td>
            </tr>
                 <tr>
                <td>Telefono</td>
                <td v-for="item in usuario.ipphone">
                     @{{item}}
                </td>
            </tr>
                 <tr>
                <td>Puesto</td>
                <td v-for="item in usuario.title">
                     @{{item}}          
                </td>
            </tr>
                 <tr>
                <td>Departamento</td>
                <td v-for="item in usuario.department">
                     @{{item}}                              
                </td>
            </tr>
                 <tr>
                <td>Organización</td>
                <td v-for="item in usuario.company">
                     @{{item}}                                              
                </td>
            </tr>
              <tr>
                <td>Sucursal</td>
                <td>
                    <el-popover
                    placement="top"
                    width="300"
                    trigger="click">
                    <el-row>
                        <el-col span="12"><strong>Ciudad :</strong></el-col>
                        <el-col span="12">@{{sucursal.ciudad}}</el-col>
                    </el-row>
                    <el-row>
                        <el-col span="12"><strong>Correo :</strong></el-col>
                        <el-col span="12">@{{sucursal.correo}}</el-col>
                    </el-row>
                    <el-row>
                        <el-col span="12"><strong>Direccion :</strong></el-col>
                        <el-col span="12">@{{sucursal.direccion}}</el-col>
                    </el-row>
                    <el-row>
                        <el-col span="12"><strong>Telefono :</strong></el-col>
                        <el-col span="12">@{{sucursal.telefono}}</el-col>
                    </el-row>
                    <el-row>
                        <el-col span="12"><strong>Fax :</strong></el-col>
                        <el-col span="12">@{{sucursal.fax}}</el-col>
                    </el-row>
                    <el-button slot="reference" size="mini">@{{sucursal.nombre}}</el-button>
                    </el-popover>                                              
                </td>
            </tr>
            </tbody>
        </table>
        </div>
        </div>
    </div>
</div>
