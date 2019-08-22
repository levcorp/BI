@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app">
  <div class="col-xs-12" v-cloak>
      <input type="text" :value="usuario_id='{{Auth::user()->id}}'" hidden>
    <div class="box box-info">
        <div class="box-header">
          <div class="row">
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <h3 class="box-title">Cuestionarios Registrados</h3>  
              </div>
              <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                  <div class="pull-right" style="margin-right: 10px">
                    <el-button
                    size="mini"
                    type="primary"
                    icon="el-icon-plus"
                    @click="handleCreate()"
                    >Crear Cuestionario
                    </el-button>
                  </div>
              </div>
          </div>
        </div>
        <div class="box-body" style="margin:15px">
            <div class="row">
              <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6" v-for="cuestionario in cuestionarios" >
                <el-card shadow="always" :body-style="{ padding: '0px' }">
                  <div style="padding: 15px;background-image:url({{asset('../images/cuestionario.jpg')}});">
                    <div class="text-center" style="color: white">
                      <p><strong>@{{cuestionario.TITULO | uppercase }}</strong></p>
                      <p>
                        <strong>
                            @{{cuestionario.FECHA_REGISTRO | moment('calendar',null,{sameElse : 'YYYY-MM-DD HH:mm'}) | capitalize({ onlyFirstLetter: true })}}
                        </strong>
                      </p>
                    </div>
                  </div>
                  <div>
                    <div class="row"  style="padding: 5px">
                      <div class="col-xs-12 col-md-7" >
                        <div class="text-center">
                          <el-dropdown trigger="click" @command="handleCommand">
                              <el-button type="primary" size="mini" style="padding: 4px;">
                                Acciones
                              </el-button>
                              <el-dropdown-menu slot="dropdown">
                                <el-dropdown-item :command="{type:'edit',cuestionario:cuestionario}" icon="el-icon-edit">Editar</el-dropdown-item>
                                <el-dropdown-item :command="{type:'show',cuestionario:cuestionario}" icon="el-icon-plus">Ver</el-dropdown-item>
                                <el-dropdown-item :command="{type:'more',cuestionario:cuestionario}" icon="el-icon-more">Datos</el-dropdown-item>
                                <el-dropdown-item :command="{type:'grupo',cuestionario:cuestionario}" icon="el-icon-user  ">Grupo</el-dropdown-item>
                                <el-dropdown-item :command="{type:'delete',cuestionario:cuestionario}" icon="el-icon-close">Eliminar</el-dropdown-item>
                              </el-dropdown-menu>
                            </el-dropdown>
                        </div>
                      </div>
                      <div class="col-xs-12 col-md-4" >
                        <div class="text-center">
                          <el-button style="padding: 4px;" @click="handleEstadoChange(cuestionario)" v-if="cuestionario.ESTADO == 1" size="mini" plain type="primary">Activo</el-button>
                          <el-button style="padding: 4px;" @click="handleEstadoChange(cuestionario)" v-else size="mini" type="danger" plain>No activo</el-button>
                        </div>
                      </div>
                    </div>
                  </div>
                </el-card>
                <br>
              </div>
            </div>
        </div>
        <transition name="el-zoom-in-center">
        <el-drawer
          title=""
          :visible.sync="drawer"
          direction="rtl"
          :size="sizeDrawer">
         <div class="row">
           <div class="row">
             <div class="col-sm-6">
                <div class="text-center">
                  <h4>Preguntas de Cuestionario</h4>
                </div>
             </div>
             <div class="col-sm-6">
               <div class="text-center">
                 <el-button  size="mini" type="primary" icon="el-icon-plus" @click="createPreguntaForm=true" round> Añadir Pregunta</el-button>
               </div>
             </div>
           </div>
           <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
             <div style="margin: 20px;">
                  <div class="row" style="margin: 0px 0px 10px 0px;">
                    <div class="col-sm-12">
                        <transition name="el-zoom-in-bottom">
                            <el-card shadow="always" v-if="createPreguntaForm">
                              <el-form :rules="rulesCreatePregunta" :model="createPregunta" ref="formCreatePregunta" >
                                <div class="row" >
                                    <div class="col-sm-4">        
                                        <el-form-item prop="TIPO">
                                        <el-select clearable size="mini" v-model="createPregunta.TIPO" placeholder="Tipo" style="width: 100%">
                                          <el-option label="Texto" value="text">
                                            <span style="float: left;">Texto</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-chat-line-square"></i></span>
                                          </el-option>
                                          <el-option label="Si / No" value="switch">
                                            <span style="float: left;">Si / No</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-set-up"></i></span>
                                          </el-option>
                                          <el-option label="Numero" value="number">
                                            <span style="float: left;">Numero</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-edit"></i></span>
                                          </el-option>
                                          <el-option label="Texto Grande" value="textarea">
                                            <span style="float: left;">Texto Grande</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-chat-line-square"></i></span>
                                          </el-option>
                                          <el-option label="Correo Electronico" value="email">
                                            <span style="float: left;">Correo Electronico</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-message"></i></span>
                                          </el-option>
                                          <el-option label="Puntuacion" value="rate">
                                            <span style="float: left;">Puntuacion</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-finished"></i></span>
                                          </el-option>
                                          <el-option label="Fecha" value="date">
                                            <span style="float: left;">Fecha</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-date"></i></span>
                                          </el-option>
                                          <el-option label="Tiempo" value="time">
                                            <span style="float: left;">Tiempo</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-time"></i></span>
                                          </el-option>
                                          <el-option label="Fecha y Tiempo" value="datetime">
                                            <span style="float: left;">Fecha y Tiempo</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-date"></i></span>
                                          </el-option>
                                          <el-option label="Seleccion" value="select">
                                            <span style="float: left;">Seleccion</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-thumb"></i></span>
                                          </el-option>
                                          <el-option label="Seleccion Multiple" value="selectmulti">
                                            <span style="float: left;">Seleccion Multiple</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-thumb"></i></span>
                                          </el-option>
                                        </el-select>
                                        </el-form-item>
                                    </div>
                                    <div class="col-sm-8">
                                      <el-form-item prop="PREGUNTA">
                                        <el-input type="text" placeholder="¿ Pregunta ?" size="mini" v-model="createPregunta.PREGUNTA"></el-input>
                                      </el-form-item>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-4">
                                      <el-form-item prop="PESO">
                                        <el-input type="text" v-model="createPregunta.PESO" placeholder="Numero" size="mini"></el-input>
                                      </el-form-item>
                                  </div>
                                  <div class="col-sm-8">
                                      <el-form-item prop="FECHA_CREACION">
                                        <el-date-picker size="mini" style="width:100%" v-model="createPregunta.FECHA_CREACION" type="datetime" disabled></el-date-picker>                                      
                                      </el-form-item>
                                  </div>
                                </div>
                                <div class="row">
                                  <br>
                                  <div class="col-sm-12">
                                    <div class="text-center">
                                      <el-button size="mini" type="text" @click="createPreguntaForm=false">Cancelar</el-button>
                                      <el-button type="primary" size="mini" @click="handleStorePregunta()">Confirmar</el-button>
                                    </div>
                                  </div>
                                </div>  
                              </el-form>                     
                            </el-card>
                            <el-card shadow="always" v-if="editPreguntaForm">
                              <el-form :rules="rulesUpdatePregunta" :model="updatePregunta" ref="formUpdatePregunta" >
                                <div class="row" >
                                    <div class="col-sm-4">        
                                        <el-form-item prop="TIPO">
                                        <el-select clearable size="mini" v-model="updatePregunta.TIPO" placeholder="Tipo" style="width: 100%">
                                          <el-option label="Texto" value="text">
                                            <span style="float: left;">Texto</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-chat-line-square"></i></span>
                                          </el-option>
                                          <el-option label="Si / No" value="switch">
                                            <span style="float: left;">Si / No</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-set-up"></i></span>
                                          </el-option>
                                          <el-option label="Numero" value="number">
                                            <span style="float: left;">Numero</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-edit"></i></span>
                                          </el-option>
                                          <el-option label="Texto Grande" value="textarea">
                                            <span style="float: left;">Texto Grande</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-chat-line-square"></i></span>
                                          </el-option>
                                          <el-option label="Correo Electronico" value="email">
                                            <span style="float: left;">Correo Electronico</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-message"></i></span>
                                          </el-option>
                                          <el-option label="Puntuacion" value="rate">
                                            <span style="float: left;">Puntuacion</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-finished"></i></span>
                                          </el-option>
                                          <el-option label="Fecha" value="date">
                                            <span style="float: left;">Fecha</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-date"></i></span>
                                          </el-option>
                                          <el-option label="Tiempo" value="time">
                                            <span style="float: left;">Tiempo</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-time"></i></span>
                                          </el-option>
                                          <el-option label="Fecha y Tiempo" value="datetime">
                                            <span style="float: left;">Fecha y Tiempo</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-date"></i></span>
                                          </el-option>
                                          <el-option label="Seleccion" value="select">
                                            <span style="float: left;">Seleccion</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-thumb"></i></span>
                                          </el-option>
                                          <el-option label="Seleccion Multiple" value="selectmulti">
                                            <span style="float: left;">Seleccion Multiple</span>
                                            <span style="float: right; color:#409EFF;"><i class="el-icon-thumb"></i></span>
                                          </el-option>
                                        </el-select>
                                        </el-form-item>
                                    </div>
                                    <div class="col-sm-8">
                                      <el-form-item prop="PREGUNTA">
                                        <el-input type="text" placeholder="¿ Pregunta ?" size="mini" v-model="updatePregunta.PREGUNTA"></el-input>
                                      </el-form-item>
                                    </div>
                                </div>
                                <div class="row">
                                  <div class="col-sm-4">
                                      <el-form-item prop="PESO">
                                        <el-input type="number" v-model="updatePregunta.PESO" placeholder="Numero" size="mini"></el-input>
                                      </el-form-item>
                                  </div>
                                  <div class="col-sm-8">
                                      <el-form-item prop="FECHA_ACTUALIZACION">
                                        <el-date-picker size="mini" style="width:100%" v-model="updatePregunta.FECHA_ACTUALIZACION" type="datetime" disabled></el-date-picker>                                      
                                      </el-form-item>
                                  </div>
                                </div>
                                <div class="row">
                                    <br>
                                    <div class="col-sm-12">
                                      <div class="text-center">
                                        <el-button size="mini" type="text" @click="editPreguntaForm=false">Cancelar</el-button>
                                        <el-button type="primary" size="mini" @click="handleUpdatePregunta()">Actualizar</el-button>
                                      </div>
                                    </div>
                                </div>  
                              </el-form>
                            </el-card>
                        </transition>
                    </div>
                  </div>    
                  <div class="row">
                      <div :class="col1">
                        <transition name="el-zoom-in-center">
                        <el-card shadow="always" v-if="toolPregunta">
                          <el-form :rules="rulesToolPregunta" :model="toolPreguntas" ref="formToolPregunta" size="mini">
                            <div class="row" >
                                <div class="col-sm-12">  
                                  <div class="text" v-if="typePregunta=='text' || typePregunta=='textarea' || typePregunta=='email'">
                                    <el-form-item prop="PLACEHOLDER">
                                        <el-input type="text" placeholder="Placeholder" size="mini" v-model="toolPreguntas.PLACEHOLDER"></el-input>
                                    </el-form-item>
                                    <el-form-item prop="ICONO" style="margin-top: 0px;">
                                        <el-input type="text" placeholder="Icono" size="mini" v-model="toolPreguntas.ICONO"></el-input>
                                    </el-form-item>                                   
                                  </div>    
                                  <div class="number" v-if="typePregunta=='number'">
                                    <el-form-item prop="PLACEHOLDER" style="padding-top: 0px;" >
                                        <el-input type="text" placeholder="Placeholder" size="mini" v-model="toolPreguntas.PLACEHOLDER"></el-input>
                                    </el-form-item>
                                    <el-form-item prop="MAX" style="margin-top: 0px;">
                                        <el-input type="number" placeholder="Valor Maximo" size="mini" v-model="toolPreguntas.MAX"></el-input>
                                    </el-form-item>
                                    <el-form-item prop="MIN" style="margin-top: 0px;">
                                        <el-input type="number" placeholder="Valor Minimo" size="mini" v-model="toolPreguntas.MIN"></el-input>
                                    </el-form-item>
                                  </div> 
                                  <div class="switch" v-if="typePregunta=='switch'">
                                    <el-form-item prop="VERDADERO">
                                        <el-input type="text" placeholder="Texto Verdadero" size="mini" v-model="toolPreguntas.VERDADERO"></el-input>
                                    </el-form-item>
                                    <el-form-item prop="FALSO" style="margin-top: 0px;">
                                        <el-input type="text" placeholder="Texto Falso" size="mini" v-model="toolPreguntas.FALSO"></el-input>
                                    </el-form-item>
                                  </div>  
                                  <div class="rate" v-if="typePregunta=='rate'">
                                    <el-form-item prop="MAX">
                                      <el-input type="number" placeholder="Maximo" size="mini" v-model="toolPreguntas.MAX"></el-input>                                      
                                    </el-form-item>
                                    <el-form-item
                                    v-for="(OPTION, index) in toolPreguntas.DESCS"
                                    :key="OPTION.key"
                                    :prop="'DESCS.' + index + '.value'"
                                    :rules="{required: true, message: 'El texto es requerido', trigger: 'change'}">
                                      <el-input v-model="OPTION.value" :placeholder="'TEXTO ' + index">
                                          <el-button slot="append" icon="el-icon-delete" @click="removeDesc(OPTION)"></el-button>
                                      </el-input>
                                    </el-form-item>
                                  </div> 
                                  <div class="date" v-if="typePregunta=='date' || typePregunta=='datetime'|| typePregunta=='time'">
                                    <el-form-item prop="PLACEHOLDER"style="padding-top: 0px;" >
                                        <el-input type="text" placeholder="Placeholder" size="mini" v-model="toolPreguntas.PLACEHOLDER"></el-input>
                                    </el-form-item>
                                  </div>  
                                  <div class="select" v-if="typePregunta=='select' || typePregunta=='selectmulti'">
                                    <el-form-item prop="PLACEHOLDER"style="padding-top: 0px;" >
                                        <el-input type="text" placeholder="Placeholder" size="mini" v-model="toolPreguntas.PLACEHOLDER"></el-input>
                                    </el-form-item>
                                    <el-form-item
                                      v-for="(OPTION, index) in toolPreguntas.OPTIONS"
                                      :key="OPTION.key"
                                      :prop="'OPTIONS.' + index + '.value'"
                                      :rules="{
                                        required: true, message: 'La opcion es requerida', trigger: 'change'
                                      }"
                                    >
                                    <el-input v-model="OPTION.value" :placeholder="'OPCION ' + index">
                                        <el-button slot="append" icon="el-icon-delete" @click="removeOption(OPTION)"></el-button>
                                    </el-input>
                                    </el-form-item>
                                  </div>                                        
                                </div>
                                <div class="row">
                                  <div class="col-sm-12">
                                    <div class="text-center">
                                      <el-button v-if="typePregunta=='rate'" @click="addDesc()" icon="el-icon-plus" circle type="success" size="mini"></el-button>
                                      <el-button v-if="typePregunta=='select' || typePregunta=='selectmulti'" @click="addOption()" icon="el-icon-plus" circle type="success" size="mini"></el-button>
                                      <el-button size="mini" type="text" @click="handleToolCancel">Cancelar</el-button>
                                      <el-button type="primary" size="mini" @click="handleStoreToolPregunta()">Confirmar</el-button>
                                    </div>
                                  </div>
                                </div>  
                            </div>
                          </el-form>
                        </el-card>
                      </transition>
                      </div>
                      <div :class="col2">
                        <div v-for="item in preguntas" class="row" :class="index==item.id ? preg : ''" style="margin:10px;border: 1px solid #9ECEFF; border-radius: 5px;padding: 5px 0px 4px 0px">
                          <div class="col-sm-3 text-center" style="margin-top:5px">
                            <el-tag effect="dark" type="primary" size="mini" >@{{item.TIPO | uppercase}}</el-tag>
                          </div>
                          <div class="col-sm-7" style="margin-top:5px">
                              <p><strong>@{{item.PREGUNTA | uppercase}}</strong></p>
                          </div>
                          <div class="col-sm-2">                             
                              <el-popover placement="left" width="230" trigger="click">
                              <el-button v-if="item.ESTADO==0" plain type="success" @click="handleEstadoPregunta(item)" circle size="mini" icon="el-icon-check"></el-button>                      
                              <el-button v-else type="danger" plain @click="handleEstadoPregunta(item)" circle size="mini" icon="el-icon-close"></el-button>                      
                              <el-button type="primary" plain @click="handleToolPregunta(item)" circle size="mini" icon="el-icon-plus"></el-button>                      
                              <el-button type="primary" plain @click="handleEditPregunta(item)" circle size="mini" icon="el-icon-edit"></el-button>                      
                              <el-button type="danger" plain  @click="handleDeletePregunta(item)" circle size="mini" icon="el-icon-delete"></el-button>                      
                              <el-button type="warning" plain @click="handleDeletePregunta(item)" circle size="mini" icon="el-icon-document-copy"></el-button>                      
                              <el-button slot="reference" type="warning" plain circle size="mini" icon="el-icon-more"></el-button>                      
                              </el-popover>
                          </div>
                        </div>
                      </div>                 
                </div>
             </div>
           </div>
         </div>
        </el-drawer>
        </transition>
    </div>
    @include('panel.registros.cuestionario.show')
    @include('panel.registros.cuestionario.create')
    @include('panel.registros.cuestionario.edit')
    @include('panel.registros.cuestionario.grupo')
  </div>
</div>
@section('script')
{!!Html::script('js/cuestionario.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop