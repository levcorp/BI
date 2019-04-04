@extends('panel.abm.layout')
@section('contenido1')
<div id="detalle">
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <div class="btn-group">
                        <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Paginacion : @{{paginacion}} <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a v-on:click.prevent="getPaginacionDetalle('5')">5</a></li>
                            <li><a v-on:click.prevent="getPaginacionDetalle('10')">10</a></li>
                            <li><a v-on:click.prevent="getPaginacionDetalle('20')">20</a></li>
                            <li><a v-on:click.prevent="getPaginacionDetalle('50')">50</a></li>
                            <li><a v-on:click.prevent="getPaginacionDetalle('100')">100</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6"></div>
                <div class="col-sm-3 col-xs-6">
                    <a data-toggle="modal" data-target="#myModal" class="btn btn-info btn-sm"><i class="fa fa-plus"></i> Crear Solicitud</a>
                </div>
                <div class="col-sm-3 col-xs-6">
                    <div class="input-group input-group-sm">
                        <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Username" aria-describedby="sizing-addon3">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-info">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box-body table-responsive no-padding">
                <table id="tabla" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Serie</th>
                        <th>Fabricante</th>
                        <th>Proveedor</th>
                        <th>Especialidad</th>
                        <th>Familia</th>
                        <th>Sub Familia</th>
                        <th>Unidad Medida</th>
                        <th>Cod Venta</th>
                        <th>Cod Compra</th>
                        <th>Descripcion</th>
                        <th>Comentario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="detalle in detalles.data" :key="detalle.id">
                        <td>@{{detalle.serie}}</td>
                        <td>@{{detalle.fabricante}}</td>
                        <td>@{{detalle.proveedor}}</td>
                        <td>@{{detalle.especialidad}}</td>
                        <td>@{{detalle.familia}}</td>
                        <td>@{{detalle.subfamilia}}</td>
                        <td>@{{detalle.medida}}</td>
                        <td>@{{detalle.cod_venta}}</td>
                        <td>@{{detalle.cod_compra}}</td>
                        <td>@{{detalle.descripcion}}</td>
                        <td>@{{detalle.comentarios}}</td>
                        <td class="text-center">
                            <form method="DELETE" @submit.prevent="deleteSolicitud(detalle.id)">
                                <a v-on:click.prevent="putArticulo(detalle.id)" data-toggle="modal" data-target="#EditSolicitud" class="btn btn-info btn-xs"><i class="fa fa-edit"></i></a>    
                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                </table>
                <div class="text-center">
                    <pagination :data="detalles" @pagination-change-page="getResultadoDetalle"></pagination>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- Modal Edit-->
    <div class="modal fade" id="EditSolicitud" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog " role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button v-on:click.prevent="borrarCampos()" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Edit Articulo</h4>
            </div>
            <form method="PUT" @submit.prevent="updateArticulo()" >
                <div class="modal-body">
                   <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Serie : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-slack"></i></span>
                                    <select v-model="serie" class="form-control text-center" aria-describedby="sizing-addon3">
                                        <option value="MANUAL">MANUAL</option>
                                        <option value="ROCKWELL AUTOMATION">ROCKWELL AUTOMATION</option>
                                        <option value="FESTO">FESTO</option>
                                        <option value="ENDRESS+HAUSER">ENDRESS + HAUSER</option>
                                        <option value="KAESER">KAESER</option>
                                        <option value="YALE">YALE</option>
                                        <option value="BELDEN">BELDEN</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Fabricante : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-user"></i></span>
                                    <input v-if="serie != 'MANUAL'" :value="fabricante" :disabled="fdisabled" type="text" class="form-control" aria-describedby="sizing-addon3" name="fabricante">
                                    <v-select v-else v-model="selectFabricante" :options="fabricantes" label="FirmName">
                                        <span slot="no-options">No hay opciones coincidentes!</span>
                                    </v-select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Proveedor : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-cubes"></i></span>
                                    <input  v-if="serie != 'MANUAL'" :value="proveedor" :disabled="pdisabled" type="text" class="form-control" aria-describedby="sizing-addon3">
                                    <v-select v-else v-model="selectProveedor" :options="proveedores" label="CardName">
                                        <span slot="no-options">No hay opciones coincidentes!</span>
                                    </v-select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Especialidad : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-edit"></i></span>
                                    <v-select v-model="selectEspecialidad" :options="especialidades" label="Descripcion">
                                        <span slot="no-options">No hay opciones coincidentes!</span>
                                    </v-select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Familia : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-cog"></i></span>
                                    <v-select v-model="selectFamilia" :options="familias" label="Familia">
                                        <span slot="no-options">No hay opciones coincidentes!</span>
                                    </v-select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Sub Familia : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-cogs"></i></span>
                                    <v-select v-model="selectSubfamilia" :options="subfamilias" label="Subfamilia">
                                        <span slot="no-options">No hay opciones coincidentes!</span>
                                    </v-select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="" class="control-label"> Unidad de Medida</label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-cube"></i></span>
                                    <select v-model="medida" class="form-control text-center" aria-describedby="sizing-addon3">
                                        <option value="PZA">PZA</option>
                                        <option value="MT">MT</option>
                                        <option value="LT">LT</option>
                                        <option value="BOLSA">BOLSA</option>
                                        <option value="ROLLO">ROLLO</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Codigo de Venta : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-chain"></i></span>
                                    <input v-model="cod_venta" type="text" class="form-control" aria-describedby="sizing-addon3">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Codigo de Compra : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-chain"></i></span>
                                    <input v-model="cod_compra" type="text" class="form-control" aria-describedby="sizing-addon3">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Descripcion : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-indent"></i></span>
                                    <input v-model="descripcion" type="text" class="form-control" aria-describedby="sizing-addon3">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Comentarios : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-indent"></i></span>
                                    <textarea v-model="comentarios"type="text" class="form-control" aria-describedby="sizing-addon3"></textarea>
                                </div>
                            </div>
                        </div>                 
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger" v-on:click.prevent="borrarCampos()" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</a>
                    <button type="submit" class="btn btn-info"><i class="fa fa-check"></i> Guardar Solicitud</button>
                </div>
            </form>
          </div>
        </div>
    </div>
    <!-- Modal Crear-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog " role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Registro de Articulos</h4>
            </div>
            <form method="POST" @submit.prevent="postDetalle" >
                <div class="modal-body">
                   <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Serie : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-slack"></i></span>
                                    <select v-model="serie" class="form-control text-center" aria-describedby="sizing-addon3">
                                        <option value="MANUAL">MANUAL</option>
                                        <option value="ROCKWELL AUTOMATION">ROCKWELL AUTOMATION</option>
                                        <option value="FESTO">FESTO</option>
                                        <option value="ENDRESS+HAUSER">ENDRESS + HAUSER</option>
                                        <option value="KAESER">KAESER</option>
                                        <option value="YALE">YALE</option>
                                        <option value="BELDEN">BELDEN</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Fabricante : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-user"></i></span>
                                    <input v-if="serie != 'MANUAL'" :value="fabricante" :disabled="fdisabled" type="text" class="form-control" aria-describedby="sizing-addon3" name="fabricante">
                                    <v-select v-else v-model="selectFabricante" :options="fabricantes" label="FirmName" name="">
                                        <span slot="no-options">No hay opciones coincidentes!</span>
                                    </v-select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Proveedor : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-cubes"></i></span>
                                    <input  v-if="serie != 'MANUAL'" :value="proveedor" :disabled="pdisabled" type="text" class="form-control" aria-describedby="sizing-addon3">
                                    <v-select v-else v-model="selectProveedor" :options="proveedores" label="CardName">
                                        <span slot="no-options">No hay opciones coincidentes!</span>
                                    </v-select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Especialidad : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-edit"></i></span>
                                    <v-select v-model="selectEspecialidad" :options="especialidades" label="Descripcion">
                                        <span slot="no-options">No hay opciones coincidentes!</span>
                                    </v-select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Familia : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-cog"></i></span>
                                    <v-select v-model="selectFamilia" :options="familias" label="Familia" name="Familia">
                                        <span slot="no-options">No hay opciones coincidentes!</span>
                                    </v-select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Sub Familia : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-cogs"></i></span>
                                    <v-select v-model="selectSubfamilia" :options="subfamilias" label="Subfamilia">
                                            <span slot="no-options">No hay opciones coincidentes!</span>
                                    </v-select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="" class="control-label"> Unidad de Medida</label>
                                <div class="input-group" :class="{'has-error': errors.has('Unidad de Medida') }">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-cube"></i></span>
                                    <select v-model="medida" v-validate="'required'" name="Unidad de Medida" class="form-control text-center" aria-describedby="sizing-addon3">
                                        <option value="PZA">PZA</option>
                                        <option value="MT">MT</option>
                                        <option value="LT">LT</option>
                                        <option value="BOLSA">BOLSA</option>
                                        <option value="ROLLO">ROLLO</option>
                                    </select>
                                </div>
                                <p class="text-danger" v-if="errors.has('Unidad de Medida')">@{{ errors.first('Unidad de Medida') }}</p>                                                                                                      
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Codigo de Venta : </label>
                                <div class="input-group" :class="{'has-error': errors.has('Codigo Venta') }">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-chain"></i></span>
                                    <input v-model="cod_venta"  v-validate="'required'" type="text" name="Codigo Venta" class="form-control" aria-describedby="sizing-addon3">
                                </div>
                                <p class="text-danger" v-if="errors.has('Codigo Venta')">@{{ errors.first('Codigo Venta') }}</p>                                                                        
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Codigo de Compra : </label>
                                <div class="input-group"  :class="{'has-error': errors.has('Codigo Compra') }">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-chain"></i></span>
                                    <input v-model="cod_compra" v-validate="'required'" type="text" name="Codigo Compra" class="form-control" aria-describedby="sizing-addon3">
                                </div>
                                <p class="text-danger" v-if="errors.has('Codigo Compra')">@{{ errors.first('Codigo Compra') }}</p>                                
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Descripcion : </label>
                                <div class="input-group"  :class="{'has-error': errors.has('Descripcion') }">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-indent"></i></span>
                                    <input v-model="descripcion" v-validate="'required'" type="text" class="form-control" aria-describedby="sizing-addon3" name="Descripcion">
                                </div>
                                <p class="text-danger" v-if="errors.has('Descripcion')">@{{ errors.first('Descripcion') }}</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Comentarios : </label>
                                <div class="input-group has-feedback" :class="{'has-error': errors.has('Comentarios') }">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-indent"></i></span>
                                    <textarea v-model="comentarios" v-validate="'required'" name="Comentarios" type="text" class="form-control" aria-describedby="sizing-addon3"></textarea>
                                </div>
                                <p class="text-danger" v-if="errors.has('Comentarios')">@{{ errors.first('Comentarios') }}</p>
                            </div>
                        </div>                 
                    </div>
                </div>
                <div class="modal-footer">
                    <a class="btn btn-danger" v-on:click.prevent="borrarCampos()" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</a>
                    <button type="submit" class="btn btn-info"><i class="fa fa-check"></i> Guardar Solicitud</button>
                </div>
            </form>
          </div>
        </div>
    </div>
</div>
<script>
    window.ID = {{$id}};
</script>
@section('script')
  {{Html::script('js/detalleSolicitud.js')}}
@endsection
@stop