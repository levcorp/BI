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
                        <td>
                            <form method="DELETE">
                                <a href="" class="btn btn-success btn-xs"><i class="fa fa-check"></i></a>
                                <a data-toggle="modal" data-target="#myModal2"  class="btn btn-info btn-xs"><i class="fa fa-plus"></i></a>
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
    <!-- Modal Crear-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Registro de Articulos</h4>
            </div>
            <form method="POST">
                <div class="modal-body">
                   <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">Serie : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-slack"></i></span>
                                    <select v-model="selected" class="form-control" aria-describedby="sizing-addon3">
                                        <option selected value="MANUAL">MANUAL</option>
                                        <option value="ROCKWELL AUTOMATION">ROCKWELL AUTOMATION</option>
                                        <option value="FESTO">FESTO</option>
                                        <option value="ENDRESS+HAUSER">ENDRESS + HAUSER</option>
                                        <option value="KAISER">KAESER</option>
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
                                    <input :value="fabricante" :disabled="fdisabled" type="text" class="form-control" aria-describedby="sizing-addon3">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Proveedor : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-cubes"></i></span>
                                    <input :value="proveedor" :disabled="pdisabled" type="text" class="form-control" aria-describedby="sizing-addon3">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Especialidad : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-edit"></i></span>
                                    <input type="text" class="form-control" aria-describedby="sizing-addon3">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Familia : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-cog"></i></span>
                                    <input type="text" class="form-control" aria-describedby="sizing-addon3">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Sub Familia : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-cogs"></i></span>
                                    <input type="text" class="form-control" aria-describedby="sizing-addon3">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Unidad de Medida : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-th"></i></span>
                                    <input type="text" class="form-control" aria-describedby="sizing-addon3">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Codigo de Venta : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-chain"></i></span>
                                    <input type="text" class="form-control" aria-describedby="sizing-addon3">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Codigo de Compra : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-chain"></i></span>
                                    <input type="text" class="form-control" aria-describedby="sizing-addon3">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Descripcion : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-indent"></i></span>
                                    <input type="text" class="form-control" aria-describedby="sizing-addon3">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Comentarios : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-indent"></i></span>
                                    <textarea type="text" class="form-control" aria-describedby="sizing-addon3"></textarea>
                                </div>
                            </div>
                        </div>                 
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Cancelar</a>
                    <button type="submit" class="btn btn-info"><i class="fa fa-check"></i> Guardar Solicitud</button>
                </div>
            </form>
          </div>
        </div>
    </div>
</div>
@section('script')
  {{Html::script('js/detalleSolicitud.js')}}
@endsection
@stop