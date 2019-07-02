<div class="modal fade" id="show"  tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Datos del sucursal</h4>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tbody>
                    <tr>
                        <td><strong>Nombre</strong></td>
                        <td><strong>:</strong></td>
                        <td>
                            @{{sucursal.nombre}}
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Direccion</strong></td>
                        <td><strong>:</strong></td>
                        <td>
                            @{{sucursal.direccion}}               
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Ciudad</strong></td>
                        <td><strong>:</strong></td>
                        <td>
                            @{{sucursal.ciudad}}                           
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Telefono</strong></td>
                        <td><strong>:</strong></td>
                        <td>
                            @{{sucursal.telefono}}                                         
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Fax</strong></td>
                        <td><strong>:</strong></td>
                        <td>
                            @{{sucursal.fax}}                                                       
                        </td>
                    </tr>
                        <tr>
                        <td><strong>Correo Electronico</strong></td>
                        <td><strong>:</strong></td>
                        <td>
                            @{{sucursal.correo}}                                                       
                        </td>
                    </tr>
                        <tr>
                        <td><strong>Fecha de Creacion</strong></td>
                        <td><strong>:</strong></td>
                        <td>
                            @{{sucursal.create}}
                        </td>
                    </tr>
                        <tr>
                        <td><strong>Fecha de Edicion</strong></td>
                        <td><strong>:</strong></td>
                        <td>
                            @{{sucursal.update}}              
                        </td>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <div class="text-center">
                    <el-button size="small" data-dismiss="modal">Cancelar</el-button>   
                </div>
            </div>
        </div>
    </div>
</div>