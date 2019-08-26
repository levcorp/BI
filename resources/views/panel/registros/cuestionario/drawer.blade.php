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
            <el-button v-if="cuestionario.resp==0" size="mini" type="primary" icon="el-icon-plus" @click="createPreguntaForm=true" round> Añadir Pregunta</el-button>
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
                                <el-input type="number" v-model="createPregunta.PESO" placeholder="Numero" size="mini"></el-input>
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
                <transition name="el-zoom-in-center">
                    <el-card shadow="always" v-if="showDetallePregunta">
                        <div class="row">
                            @{{helpOptions}}
                            <div class="col-sm-6">
                                <div class="text-center">
                                    <p><strong>Caracteristicas</strong></p>
                                </div>
                            <p v-if="preguntaCaracteristicas.COLOR"><strong>Color: </strong>@{{preguntaCaracteristicas.COLOR}}</p>
                            <p v-if="preguntaCaracteristicas.PLACEHOLDER"><strong>Placeholder:</strong>@{{preguntaCaracteristicas.PLACEHOLDER}}</p>
                            <p v-if="preguntaCaracteristicas.ICONO"><strong>Icono: </strong>@{{preguntaCaracteristicas.Icono}}</p>
                            <p v-if="preguntaCaracteristicas.MIN"><strong>Minimo: </strong>@{{preguntaCaracteristicas.MIN}}</p>
                            <p v-if="preguntaCaracteristicas.MAX"><strong>Maximo: </strong>@{{preguntaCaracteristicas.MAX}}</p>
                            <p v-if="preguntaCaracteristicas.VERDADERO"><strong>Verdadero: </strong>@{{preguntaCaracteristicas.VERDADERO}}</p>
                            <p v-if="preguntaCaracteristicas.FALSO"><strong>Falso: </strong>@{{preguntaCaracteristicas.FALSO}}</p>
                            </div>
                            <div class="col-sm-6">
                                <div class="text-center">
                                    <p><strong>Valores</strong></p>
                                </div>
                                <p v-for="item in preguntaOpciones"><strong> - </strong>@{{item.VALOR}}</p>
                            </div>
                        </div>
                        <div class="text-center">
                            <el-button size="mini" type="default" @click="handleDetallePreguntaCancel">Cancelar</el-button>
                            <el-button size="mini" v-if="pregunta.resp==0" type="danger" @click="handleDetallePreguntaDelete()">Eliminar</el-button>
                        </div>
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
                        <div v-if="item.resp==0">
                            <el-popover placement="left" :width="item.resp==0 ? '180':'50'" trigger="click">
                            <el-button v-if="item.ESTADO==0" plain type="success" @click="handleEstadoPregunta(item)" circle size="mini" icon="el-icon-check"></el-button>                      
                            <el-button v-if="item.ESTADO==1" type="danger" plain @click="handleEstadoPregunta(item)" circle size="mini" icon="el-icon-close"></el-button>                      
                            <el-button v-if="item.values==0" type="primary" plain @click="handleToolPregunta(item)" circle size="mini" icon="el-icon-plus"></el-button>                      
                            <el-button type="primary" plain @click="handleEditPregunta(item)" circle size="mini" icon="el-icon-edit"></el-button>                      
                            <el-button  type="danger" plain  @click="handleDeletePregunta(item)" circle size="mini" icon="el-icon-delete"></el-button>                      
                            <el-button v-if="item.values>0" type="warning" plain  @click="handleShowDetallePregunta(item)" circle size="mini" icon="el-icon-document-copy"></el-button>                      
                            <el-button slot="reference" type="warning" plain circle size="mini" icon="el-icon-more"></el-button>                      
                            </el-popover>
                        </div>  
                        <el-button v-else type="warning" plain  @click="handleShowDetallePregunta(item)" circle size="mini" icon="el-icon-document-copy"></el-button>                      
                    </div>
                </div>
                </div>                 
        </div>
        </div>
    </div>
    </div>
</el-drawer>
</transition>