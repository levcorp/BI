<div class="modal fade" id="show"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-md" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Datos del Usuario</h4>
        </div>
        <div class="modal-body">
        <table class="table">
            <tbody>
            <tr>
                <td>Nombre</td>
                <td>
                    @{{usuario.nombre}}
                </td>
            </tr>
            <tr>
                <td>Apellido</td>
                <td>
                    @{{usuario.apellido}}               
                </td>
            </tr>
            <tr>
                <td>Correo Electronico</td>
                <td>
                    @{{usuario.email}}                           
                </td>
            </tr>
            <tr>
                <td>Ciudad</td>
                <td>
                    @{{usuario.ciudad}}                                         
                </td>
            </tr>
            <tr>
                <td>Pais</td>
                <td>
                    @{{usuario.pais}}                                                       
                </td>
            </tr>
                 <tr>
                <td>Movil</td>
                <td>
                    @{{usuario.celular}}                                                       
                </td>
            </tr>
                 <tr>
                <td>Telefono</td>
                <td>
                    @{{usuario.telefono}}
                </td>
            </tr>
                 <tr>
                <td>Puesto</td>
                <td>
                    @{{usuario.puesto}}              
                </td>
            </tr>
                 <tr>
                <td>Departamento</td>
                <td>
                    @{{usuario.departamento}}                                  
                </td>
            </tr>
                 <tr>
                <td>Organización</td>
                <td>
                    @{{usuario.organizacion}}                                                
                </td>
            </tr>
            </tbody>
        </table>
        </div>
        </div>
    </div>
    <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>