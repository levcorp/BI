@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')

<div class="row" id="tareas">
  <div class="col-xs-12" v-cloak>
    <div class="box box-info">
      <el-tabs v-model="activeName" type="card">
        <el-tab-pane label="Registros" name="registros">
            <div class="box-header">
              <div class="row">
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                      <h3 class="box-title">Tareas Registradas</h3>
                    <input type="text" :value="auth_user={{Auth::user()->id}}" hidden>
                  </div>
                  <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                      <div class="pull-right" style="margin-right: 10px">
                      <el-button
                      size="mini"
                      type="primary"
                      icon="el-icon-plus"
                      @click="handleCreate()"
                      >Crear Tarea
                      </el-button>
                      </div>
                  </div>
              </div>
            </div>
            <div class="box-body table-responsive">
                <el-table :data="tareas.filter(data => !search || data.TAREA.toLowerCase().includes(search.toLowerCase()))" style="width: 100%" height="450" >
                    <el-table-column align="center" label="Dias Abierto" >
                        <template slot-scope="scope">
                          <el-tag size="mini" type="danger" v-if="(scope.row.estado.TAG).trim() == 'P'">
                            <i class="el-icon-time"></i>
                            <span style="margin-left: 10px">@{{scope.row.FECHA_REGISTRO | moment("diff", new Date(), 'days')*-1}}</span>
                          </el-tag>
                          <el-tag size="mini" type="info" v-else>
                            <i class="el-icon-check"></i>
                              <span style="margin-left: 10px">Culminado</span>
                          </el-tag>
                        </template>
                    </el-table-column>           
                    <el-table-column align="center" prop="TAREA" label="Titulo" ></el-table-column>
                    <el-table-column sortable label="Asignado a" align="center">
                      <template slot-scope="scope">
                      <el-tag :type="scope.row.USUARIO_ID ? '' : 'warning'" size="mini">
                        <i class="el-icon-user"></i>
                        <span style="margin-left: 10px" v-if="scope.row.USUARIO_ID">@{{ scope.row.usuario.nombre+" "+scope.row.usuario.apellido }}</span>
                        <span style="margin-left: 10px" v-else>Sin usuario</span>
                      </el-tag>
                      </template>
                    </el-table-column>
                    <el-table-column sortable align="center" label="Estado">
                      <template slot-scope="scope">
                        <el-tag :type="scope.row.estado.COLOR" size="mini">
                          <i :class="scope.row.estado.ICON"></i>
                          <span style="margin-left: 10px" >@{{ scope.row.estado.ESTADO_TAREA }}</span>
                        </el-tag>
                      </template>
                    </el-table-column>
                    <el-table-column align="center" prop="BRAND" label="Especialidad" ></el-table-column>
                    <el-table-column align="center" label="Operaciones" width="180">
                          <template slot="header" slot-scope="scope">
                            <el-input
                              v-model="search"
                              size="mini"
                              placeholder="Buscar Tarea"/>
                          </template>
                          <template slot-scope="scope">
                            <el-button circle icon="el-icon-files" size="mini" type="success" @click="handleDetail(scope.$index, scope.row)"></el-button>
                            <el-button circle icon="el-icon-zoom-in" size="mini" type="warning" @click="handleShow(scope.$index, scope.row)"></el-button>
                            <el-button circle icon="el-icon-edit" size="mini" @click="handleEdit(scope.$index, scope.row)" type="primary"></el-button>
                          </template>
                      </el-table-column>
                    </el-table-column>
                </el-table>
              </div>
        </el-tab-pane>
        <el-tab-pane label="Detalle" name="detalle" v-if="showTab">
            <div class="box-header">
              <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <h3 class="box-title">@{{showTarea.TAREA | uppercase}}</h3>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                    <div class="pull-right" style="margin-right: 10px"> 
                    <transition name="el-zoom-in-top">
                      <el-button v-if="(showEstado.TAG).trim() == 'P'" size="mini" type="primary" icon="el-icon-plus" @click="handleCreateAccion()">
                        Crear Acción
                      </el-button>
                    </transition>
                    </div>
                  </div>
              </div>
              <br>
              <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <div class="row">
                    <div class="col-sm-6">
                      <div class="row">
                        <div class="col-sm-12">
                          <strong>
                            Asignado a :  
                          </strong>
                          <el-tag v-if="showTarea.USUARIO_ID" size="mini">
                            <i class="el-icon-user"></i>
                            <span style="margin-left: 5px;" >@{{ showUser.nombre+' '+showUser.apellido }}</span>
                          </el-tag>
                          <el-popover v-else placement="bottom" width="200" v-model="visible">
                              <p>Asignar a : </p>
                              <el-form :model="asignacion" :rules="rulesAsignacionUser" ref="formAsignacionUser">
                              <el-form-item prop="usuario_id">
                                <el-select clearable v-model="asignacion.usuario_id" filterable placeholder="Seleccionar Usuario" size="mini">
                                  <el-option
                                    v-for="item in users"
                                    :key="item.nombre+' '+item.apellido"
                                    :label="item.nombre+' '+item.apellido"
                                    :value="item.id">
                                    <span style="float: left">@{{ item.nombre+' '+item.apellido }}</span>
                                    <span style="float: right; color: #8492a6; font-size: 13px"><i class="el-icon-user"></i></span>
                                  </el-option>
                                </el-select>
                                </el-form-item>
                              <div style="text-align: right; margin: 0">
                                <el-button size="mini" type="text" @click="visible = false">Cancelar</el-button>
                                <el-button type="primary" size="mini" @click="handleAsignar()">Asignar</el-button>
                              </div>
                              </el-form>
                              <el-button type="warning" icon="el-icon-user" size="mini" plain slot="reference">Sin Asignar</el-button>
                          </el-popover>
                        </div>                      
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <div class="row" >
                        <div class="col-sm-12" v-if="(showEstado.TAG).trim() == 'P'">
                          <strong>
                            Estado :  
                          </strong>
                          <el-popover placement="bottom" width="200" v-model="visibleEstado" >
                            <p>Cambiar de Estado : </p>
                              <el-form :model="asignacionEstado" :rules="rulesAsignacionEstado" ref="formAsignacionEstado">
                              <el-form-item prop="estado_id">
                                <el-select  clearable v-model="asignacionEstado.estado_id" filterable placeholder="Seleccionar Estado" size="mini">
                                  <el-option
                                    v-for="item in estadoTarea"
                                    :key="item.ESTADO_TAREA"
                                    :label="item.ESTADO_TAREA"
                                    :value="item.id">
                                    <span style="float: left">@{{ item.ESTADO_TAREA }}</span>
                                    <span style="float: right; color: #8492a6; font-size: 13px"><i class="el-icon-tickets"></i></span>
                                  </el-option>
                                </el-select>
                              </el-form-item>
                              <div style="text-align: right; margin: 0">
                                <el-button size="mini" type="text" @click="visibleEstado = false">Cancelar</el-button>
                                <el-button type="primary" size="mini" @click="handleAsignarEstadoTarea()">Cambiar</el-button>
                              </div>
                              </el-form>
                              <el-button :type="showEstado.COLOR" :icon="showEstado.ICON" size="mini" plain slot="reference">@{{ showEstado.ESTADO_TAREA }}</el-button>
                          </el-popover> 
                        </div>
                        <div class="col-sm-12" v-else>
                          <p>
                            <strong >
                              Estado :  
                            </strong>
                            <el-tag :type="showEstado.COLOR" size="mini">
                              <i :class="showEstado.ICON"></i>
                              <span style="margin-left: 5px" >@{{ showEstado.ESTADO_TAREA }}</span>
                            </el-tag>
                          </p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <p>
                        <strong>
                          Creada por : 
                        </strong>
                        <el-tag  size="mini">
                          <i class="el-icon-user"></i>
                          <span style="margin-left: 5px" >@{{ showCUser.nombre+' '+ showCUser.apellido }}</span>
                        </el-tag>
                      </p>
                    </div>
                    <div class="col-sm-6">
                        <p>
                          <strong>
                            Cliente : 
                          </strong>
                          @{{showTarea.CLIENTE}}
                        </p>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <div class="row">
                    <div class="col-sm-6">
                      <p>
                        <strong>
                          Especialidad : 
                        </strong>
                        @{{showTarea.BRAND}}
                      </p>
                    </div>
                    <div class="col-sm-6">
                        <p>
                          <strong>
                            Mercado : 
                          </strong>
                          @{{showTarea.SECTOR}}
                        </p>
                    </div>
                  </div>
                  <div class="row" v-if="(showEstado.TAG).trim() == 'F'">
                    <div class="col-sm-6">
                      <p>
                        <strong>
                          Descripción : 
                        </strong>
                        @{{showTarea.DESCRIPCION}}
                      </p>
                    </div>
                    <div class="col-sm-6">
                      <p>
                        <strong>
                          Fecha de Finalización : 
                        </strong>
                        @{{showTarea.FECHA_FINALIZACION | moment('calendar',null,{sameElse : 'YYYY-MM-DD HH:mm'}) | capitalize({ onlyFirstLetter: true }) }}
                      </p>
                    </div>
                  </div>
                  <div class="row" v-else>
                    <div class="col-sm-12">
                      <p>
                        <strong>
                          Descripción : 
                        </strong>
                        @{{showTarea.DESCRIPCION}}
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <el-divider content-position="center">
              <strong>
                Lista de Acciones
              </strong>
            </el-divider>
            <div class="box-body">
              <div >
                <el-timeline>
                  <el-timeline-item v-for="(item,index) in acciones" :key="index" :type="item.estado.COLOR" :timestamp="item.FECHA_CREACION | moment('calendar',null,{sameElse : 'YYYY-MM-DD HH:mm'}) |capitalize({ onlyFirstLetter: true })" placement="top">
                    <div class="row">
                      <div class="col-sm-6">
                        <el-card shadow="always">
                          <p>
                            <strong>Accion</strong>
                            <el-tag :type="item.estado.COLOR" style="float: right;" size="mini">
                              <i :class="item.estado.ICON"></i>
                              <span style="margin-left: 3px" >@{{ item.estado.ACCION }}</span>
                            </el-tag>
                            <br>
                            @{{item.DESCRIPCION_ACCION}}
                            <el-tag type="info" style="float: right; margin-top:5px;" size="mini" v-if="item.estado.id==1">
                                <i class="el-icon-user"></i>
                                <span style="margin-left: 3px" >@{{ item.OLD_USER}}</span>
                            </el-tag>
                          </p>
                        </el-card>
                      </div>
                      <div class="col-sm-5">
                        <el-card shadow="always">
                          <p>
                            <strong>Resultado</strong>
                            <transition name="el-zoom-in-top">
                              <el-button v-if="!item.RESULTADO_ACCION" style="float: right;" size="mini" icon="el-icon-chat-line-square" type="primary" circle @click="handleModalMessage(item.id,showTarea.id)"></el-button>
                            </transition>
                            <br>
                            @{{item.RESULTADO_ACCION}}  
                            <el-tag type="info" style="float: right; margin-top:10px;margin-bottom:10px;" size="mini" v-if="item.estado.id==1">
                                <i class="el-icon-user"></i>
                                <span style="margin-left: 3px" >@{{ item.NEW_USER}}</span>
                            </el-tag>                        
                          </p>
                        </el-card>
                      </div>
                    </div>
                  </el-timeline-item>
                </el-timeline>
              </div>
            </div>
          </el-tab-pane>
      </el-tabs>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->
  </div>
  <!-- /.col -->
@include('panel.registros.tareas.show')
@include('panel.registros.tareas.edit')
@include('panel.registros.tareas.create')
@include('panel.registros.tareas.accion')
</div>
@section('script')
{!!Html::script('js/tareasUsuario.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop