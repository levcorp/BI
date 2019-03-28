@extends('panel.abm.layout')
@section('contenido1')
<div id="solicitud">
    <div class="box box-primary">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <div class="btn-group">
                        <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Paginacion : @{{paginacionPendiente}} <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                        <li><a v-on:click.prevent="getPaginacionPendiente('5')">5</a></li>
                        <li><a v-on:click.prevent="getPaginacionPendiente('10')">10</a></li>
                        <li><a v-on:click="getPaginacionPendiente('20')">20</a></li>
                        <li><a v-on:click="getPaginacionPendiente('50')">50</a></li>
                        <li><a v-on:click="getPaginacionPendiente('100')">100</a></li>
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
                        <th>N° Solicitud</th>
                        <th>Fecha Solicictud</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="solicitud in solicitudesPendiente.data" :key="solicitud.id">
                        <td>@{{solicitud.numero}}</td>
                        <td>@{{solicitud.fecha}}</td>
                        <td>@{{solicitud.usuario.nombre +' '+ solicitud.usuario.apellido}}</td>
                        <td><span class="label label-warning">@{{solicitud.estado}}</span></td>
                        <td>
                            <form method="DELETE" v-on:submit.prevent="deleteSolicitud(solicitud.id)">
                                <a href="" class="btn btn-success btn-xs"><i class="fa fa-check"></i></a>
                                <a :href="'solicitud/detalle/'+solicitud.id"  class="btn btn-info btn-xs"><i class="fa fa-plus"></i></a>
                                <button type="submit" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                </tbody>
                </table>
                <div class="text-center">
                    <pagination :data="solicitudesPendiente" @pagination-change-page="getResultadoPendiente"></pagination>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>
    <div class="box box-warning">
        <div class="box-body">
            <div class="row">
                <div class="col-sm-3 col-xs-6">
                    <div class="btn-group">
                        <button type="button" class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Paginacion : @{{paginacionRealizado}} <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                        <li><a v-on:click.prevent="getPaginacionRealizado('10')">10</a></li>
                        <li><a v-on:click="getPaginacionRealizado('20')">20</a></li>
                        <li><a v-on:click="getPaginacionRealizado('50')">50</a></li>
                        <li><a v-on:click="getPaginacionRealizado('100')">100</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3 col-xs-6"></div>
                <div class="col-sm-3 col-xs-6">
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
    <div class="box box-warning">
        <!-- /.box-header -->
        <div class="box-body">
            <div class="box-body table-responsive no-padding">
                <table id="tabla" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>N° Solicitud</th>
                        <th>Fecha Solicictud</th>
                        <th>Usuario</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="solicitud in solicitudesRealizado.data" :key="solicitud.id">
                        <td>@{{solicitud.numero}}</td>
                        <td>@{{solicitud.fecha}}</td>
                        <td>@{{solicitud.usuario.nombre +' '+ solicitud.usuario.apellido}}</td>
                        <td><span class="label label-success">@{{solicitud.estado}}</span></td>
                        <td class="text-center">
                            <a href="" class="btn btn-info btn-xs"><i class="fa fa-plus"></i></a>
                        </td>
                    </tr>
                </tbody>
                </table>
                <div class="text-center">
                    <pagination :data="solicitudesRealizado" @pagination-change-page="getResultadoRealizado"></pagination>
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
              <h4 class="modal-title" id="myModalLabel">Crear Solicitud</h4>
            </div>
            <form method="POST"  @submit.prevent="postSolicitud">
            <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">N° Solicitud : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-slack"></i></span>
                                    <input type="text" class="form-control"  :name="numero" :value="solicitud.numero" disabled aria-describedby="sizing-addon3">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Usuario : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-user"></i></span>
                                    <input type="text" class="form-control"  value="{{Auth::user()->nombre.' '.Auth::user()->apellido}}"  disabled aria-describedby="sizing-addon3">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="message-text" class="control-label">Fecha Solicitud : </label>
                                <div class="input-group">
                                    <span class="input-group-addon" id="sizing-addon3"><i class="fa fa-calendar"></i></span>
                                    <input type="text" class="form-control"  value="{{date('d-m-Y')}}"  disabled aria-describedby="sizing-addon3">
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
{{Html::script('js/app.js')}}
@endsection
@stop