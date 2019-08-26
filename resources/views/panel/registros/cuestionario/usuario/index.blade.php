@extends('layouts.table')
@section('titulo')
@endsection
@section('contenido')
<div class="row" id="app">
    <transition name="el-fade-in-linear">
        <div class="col-sm-12" v-cloak v-if="showCuestionarios">
            <div class="box box-info">
                <div class="box-header">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6">
                            <h3 class="box-title">Cuestionarios Asignados</h3>  
                        </div>
                    </div>
                </div>
                <div class="box-body" style="margin:15px">
                    <div class="row">
                        <input type="text" hidden :value="usuario_id={{Auth::user()->id}}">
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
                            <div class="col-xs-12 col-md-12"style="padding: 5px">
                                <div class="text-center">
                                    <div class="row">
                                        <div class="col-sm-8 col-xs-8 col-lg-8 col-md-8" style="text-align: right">
                                            <el-tag v-if="cuestionario.C_ESTADO=='V'" type="danger" size="mini">Vencido</el-tag>
                                            <el-button v-if="cuestionario.C_ESTADO=='P'" style="padding: 4px;" size="mini" type="primary" plain @click="handleLlenar(cuestionario.CUESTIONARIO_ID)">Llenar</el-button>
                                            <el-tag v-if="cuestionario.C_ESTADO=='R'" type="success" size="mini">Realizado</el-tag>
                                        </div>
                                        <div class="col-sm-4 col-xs-4 col-lg-4 col-md-4" style="text-align: right">
                                            <el-button v-if="cuestionario.C_ESTADO=='R'" style="padding: 3px;" size="mini" type="primary" plain icon="el-icon-document" @click="handleListRespuestas(cuestionario.CUESTIONARIO_ID)"></el-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </el-card>
                        <br>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </transition>    
    <transition name="el-fade-in-linear">
        <div class="col-sm-12" v-cloak v-if="showPreguntas">
                <div class="row">
                    <div class="col-sm-12 table-responsive" style="background-color: white; padding: 4%;">
                        <template>
                            <el-button style="text-align: left" size="mini" icon="el-icon-back" type="primary" @click="handleBack()"></el-button>
                            <div class="text-center">
                                <h4>
                                    <strong style="text-align: right">@{{cuestionario.TITULO | uppercase}}</strong>
                                </h4>
                            </div>
                        </template>
                        <input type="text" :value="usuario_id='{{Auth::user()->id}}'" hidden>    
                        <br>
                        <el-collapse-transition>      
                            <el-steps v-if="showStep" align-center="center" :active="step" process-status="finish" finish-status="success">
                                <el-step 
                                :icon="pregunta.tipo=='text' ? 
                                'el-icon-chat-line-square' : pregunta.tipo=='switch' ? 
                                'el-icon-open': pregunta.tipo=='textarea' ? 
                                'el-icon-edit-outline' : pregunta.tipo=='rate' ? 
                                'el-icon-data-line' : pregunta.tipo=='email' ?
                                'el-icon-message' : pregunta.tipo=='date' ?
                                'el-icon-date' : pregunta.tipo=='select' ? 
                                'el-icon-thumb' : pregunta.tipo=='selectmulti' ?
                                'el-icon-thumb' : pregunta.tipo=='datetime' ?
                                'el-icon-date' : pregunta.tipo=='time' ? 
                                'el-icon-time' : pregunta.tipo=='number' ?
                                'el-icon-edit' : ''"  
                                v-for="(pregunta,index) in inputs">
                                    <div slot="title">
                                        <div>
                                            <p><strong>@{{index+1}}</strong></p>
                                        </div>
                                    </div>
                                </el-step>
                            </el-steps>
                        </el-collapse-transition>
                        <div v-for="(pregunta,index) in inputs" v-if="showCuestionario">
                            <div class="row">
                                <div class="col-sm-2"></div>
                                <div class="col-md-8 col-sm-12 col-xs-12 col-lg-8">
                                    <el-collapse-transition>      
                                        <el-card shadow="always" v-if="show==(index+1)">
                                            <div class="col-sm-12">
                                                <div class="text-center">
                                                    <p><strong>@{{pregunta.pregunta | uppercase }}</strong></p>
                                                </div>
                                                <br>
                                                <div class="col-sm-2"></div>
                                                <div class="col-md-8 col-sm-12 col-xs-12 col-lg-8">
                                                    <div class="text-center" v-if="pregunta.tipo=='text'">
                                                        <el-form :model="inputs[index]" :ref="pregunta.tipo+pregunta.pregunta_id+'Form'" size="mini" @submit.native.prevent="handleNext(pregunta)" @keydown.native.enter.prevent="handleNext(pregunta)">
                                                            <el-form-item :prop="pregunta.tipo+pregunta.pregunta_id" :rules="[{ required: true, message: 'El campo es requerido', trigger: 'change' }]">
                                                                <el-input v-model="inputs[index][pregunta.tipo+pregunta.pregunta_id]" style="width: 100%" :suffix-icon="pregunta.icono" size="mini" type="text" :placeholder="pregunta.placeholder"></el-input>
                                                            </el-form-item>
                                                            <el-form-item>
                                                                <el-button size="mini" type="default" v-if="show!=1" @click="handlePrevious">Anterior</el-button>
                                                                <el-button size="mini" native-type="submit" type="primary">@{{show==countPreguntas? 'Finalizar':'Siguiente'}}</el-button>
                                                            </el-form-item>
                                                        </el-form>
                                                    </div>
                                                    <div class="text-center" v-else-if="pregunta.tipo=='textarea'">
                                                    <el-form :model="inputs[index]" :ref="pregunta.tipo+pregunta.pregunta_id+'Form'" size="mini" @submit.native.prevent="handleNext(pregunta)" @keydown.native.enter.prevent="handleNext(pregunta)">
                                                            <el-form-item :prop="pregunta.tipo+pregunta.pregunta_id" :rules="[{ required: true, message: 'El campo es requerido', trigger: 'change' }]">
                                                                <el-input v-model="inputs[index][pregunta.tipo+pregunta.pregunta_id]" style="width: 100%" :suffix-icon="pregunta.icono" rows="3" type="textarea" :placeholder="pregunta.placeholder"></el-input>
                                                            </el-form-item>
                                                            <el-form-item>
                                                                <el-button size="mini" type="default" v-if="show!=1" @click="handlePrevious">Anterior</el-button>
                                                                <el-button size="mini" native-type="submit" type="primary">@{{show==countPreguntas? 'Finalizar':'Siguiente'}}</el-button>
                                                            </el-form-item>
                                                        </el-form>
                                                    </div>
                                                    <div class="text-center" v-else-if="pregunta.tipo=='number'">
                                                    <el-form :model="inputs[index]" :ref="pregunta.tipo+pregunta.pregunta_id+'Form'" size="mini" @submit.native.prevent="handleNext(pregunta)" @keydown.native.enter.prevent="handleNext(pregunta)">
                                                            <el-form-item :prop="pregunta.tipo+pregunta.pregunta_id" :rules="[{ equired: true, message: 'El campo es requerido', trigger: 'change' }]">
                                                                <el-input required style="width: 100%" size="mini" v-model="inputs[index][pregunta.tipo+pregunta.pregunta_id]" type="number" :max="pregunta.max" :min="pregunta.min" :placeholder="pregunta.placeholder"></el-input>
                                                            </el-form-item>
                                                            <el-form-item>
                                                                <el-button size="mini" type="default" v-if="show!=1" @click="handlePrevious">Anterior</el-button>
                                                                <el-button size="mini" native-type="submit" type="primary">@{{show==countPreguntas? 'Finalizar':'Siguiente'}}</el-button>
                                                            </el-form-item>
                                                        </el-form>
                                                    </div>
                                                    <div class="text-center" v-else-if="pregunta.tipo=='time'">
                                                    <el-form :model="inputs[index]" :ref="pregunta.tipo+pregunta.pregunta_id+'Form'" size="mini" @submit.native.prevent="handleNext(pregunta)" @keydown.native.enter.prevent="handleNext(pregunta)">
                                                            <el-form-item :prop="pregunta.tipo+pregunta.pregunta_id" :rules="[{ required: true, message: 'El campo es requerido', trigger: 'change' },{ type: 'date', message: 'El campo requiere una hora', trigger: 'change' }]">
                                                                <el-time-picker v-model="inputs[index][pregunta.tipo+pregunta.pregunta_id]" style="width: 100%" size="mini" :placeholder="pregunta.placeholder"></el-time-picker>                                                   
                                                            </el-form-item>
                                                            <el-form-item>
                                                                <el-button size="mini" type="primary" @click="handlePrevious">Anterior</el-button>
                                                                <el-button size="mini" native-type="submit" type="primary">@{{show==countPreguntas? 'Finalizar':'Siguiente'}}</el-button>
                                                            </el-form-item>
                                                        </el-form>
                                                    </div>
                                                    <div class="text-center" v-else-if="pregunta.tipo=='select'">
                                                    <el-form :model="inputs[index]" :ref="pregunta.tipo+pregunta.pregunta_id+'Form'" size="mini" @submit.native.prevent="handleNext(pregunta)" @keydown.native.enter.prevent="handleNext(pregunta)" >
                                                            <el-form-item :prop="pregunta.tipo+pregunta.pregunta_id" :rules="[{ required: true, message: 'La seleccion es requerida', trigger: 'change' }]">
                                                                <el-select size="mini" style="width: 100%" clearable :placeholder="pregunta.placeholder" v-model="inputs[index][pregunta.tipo+pregunta.pregunta_id]">
                                                                    <el-option
                                                                        v-for="item in pregunta.opciones"
                                                                        :key="item.id"
                                                                        :label="item.VALOR"
                                                                        :value="item.VALOR">
                                                                    </el-option>
                                                                </el-select>
                                                            </el-form-item>
                                                            <el-form-item>
                                                                <el-button size="mini" type="default" v-if="show!=1" @click="handlePrevious">Anterior</el-button>
                                                                <el-button size="mini" native-type="submit" type="primary">@{{show==countPreguntas? 'Finalizar':'Siguiente'}}</el-button>
                                                            </el-form-item>
                                                        </el-form>
                                                    </div>
                                                    <div class="text-center" v-else-if="pregunta.tipo=='rate'">
                                                    <el-form :model="inputs[index]" :ref="pregunta.tipo+pregunta.pregunta_id+'Form'" size="mini" @submit.native.prevent="handleNext(pregunta)" @keydown.native.enter.prevent="handleNext(pregunta)">
                                                            <el-form-item :prop="pregunta.tipo+pregunta.pregunta_id" :rules="[{ required: true, message: 'La puntuacion es requerida', trigger: 'change' }]">
                                                                <rate :length="5" v-model="inputs[index][pregunta.tipo+pregunta.pregunta_id]" :ratedesc="pregunta.labels"/>    
                                                            </el-form-item>
                                                            <el-form-item>
                                                                <el-button size="mini" type="default" v-if="show!=1" @click="handlePrevious">Anterior</el-button>
                                                                <el-button size="mini" native-type="submit" type="primary">@{{show==countPreguntas? 'Finalizar':'Siguiente'}}</el-button>
                                                            </el-form-item>
                                                        </el-form>
                                                    </div>
                                                    <div class="text-center" v-else-if="pregunta.tipo=='switch'">
                                                    <el-form :model="inputs[index]" :ref="pregunta.tipo+pregunta.pregunta_id+'Form'" size="mini" @submit.native.prevent="handleNext(pregunta)" @keydown.native.enter.prevent="handleNext(pregunta)">
                                                            <el-form-item :prop="pregunta.tipo+pregunta.pregunta_id" :rules="[{ required: true, message: 'La seleccion es requerida', trigger: 'change' }]">
                                                                <el-switch v-model="inputs[index][pregunta.tipo+pregunta.pregunta_id]" active-color="#E6A23C" inactive-color="#409EFF" width="50"
                                                                :active-text="pregunta.verdadero"
                                                                :inactive-text="pregunta.falso">
                                                                </el-switch>
                                                            </el-form-item>
                                                            <el-form-item>
                                                                <el-button size="mini" type="default" v-if="show!=1" @click="handlePrevious">Anterior</el-button>                                            
                                                                <el-button size="mini" native-type="submit" type="primary">@{{show==countPreguntas? 'Finalizar':'Siguiente'}}</el-button>
                                                            </el-form-item>
                                                        </el-form>
                                                    </div>
                                                    <div class="text-center" v-else-if="pregunta.tipo=='date'">
                                                    <el-form :model="inputs[index]" :ref="pregunta.tipo+pregunta.pregunta_id+'Form'" size="mini" @submit.native.prevent="handleNext(pregunta)" @keydown.native.enter.prevent="handleNext(pregunta)">                                            
                                                            <el-form-item :prop="pregunta.tipo+pregunta.pregunta_id" :rules="[{ required: true, message: 'El campo es requerido', trigger: 'change' },{ type: 'date', message: 'El campo requiere una fecha', trigger: 'change'}]">
                                                                <el-date-picker style="width: 100%" size="mini" v-model="inputs[index][pregunta.tipo+pregunta.pregunta_id]" type="date" :placeholder="pregunta.placeholder"></el-date-picker>
                                                            </el-form-item>
                                                            <el-form-item>
                                                                <el-button size="mini" type="default" v-if="show!=1" @click="handlePrevious">Anterior</el-button>                                            
                                                                <el-button size="mini" native-type="submit" type="primary">@{{show==countPreguntas? 'Finalizar':'Siguiente'}}</el-button>
                                                            </el-form-item>
                                                        </el-form>
                                                    </div>
                                                    <div class="text-center" v-else-if="pregunta.tipo=='datetime'">
                                                    <el-form :model="inputs[index]" :ref="pregunta.tipo+pregunta.pregunta_id+'Form'" size="mini" @submit.native.prevent="handleNext(pregunta)" @keydown.native.enter.prevent="handleNext(pregunta)">
                                                            <el-form-item :prop="pregunta.tipo+pregunta.pregunta_id" :rules="[{ required: true, message: 'El campo es requerido', trigger: 'change' },{ type: 'date', message: 'El campo requiere una fecha y hora', trigger: 'change' }]">
                                                                <el-date-picker style="width: 100%" size="mini" v-model="inputs[index][pregunta.tipo+pregunta.pregunta_id]" type="datetime" :placeholder="pregunta.placeholder">
                                                                </el-date-picker>
                                                            </el-form-item>
                                                            <el-form-item>
                                                                <el-button size="mini" type="default" v-if="show!=1" @click="handlePrevious">Anterior</el-button>                                            
                                                                <el-button size="mini" native-type="submit" type="primary">@{{show==countPreguntas? 'Finalizar':'Siguiente'}}</el-button>
                                                            </el-form-item>
                                                        </el-form>
                                                    </div>
                                                    <div class="text-center" v-else-if="pregunta.tipo=='email'">
                                                    <el-form :model="inputs[index]" :ref="pregunta.tipo+pregunta.pregunta_id+'Form'" size="mini" @submit.native.prevent="handleNext(pregunta)" @keydown.native.enter.prevent="handleNext(pregunta)">
                                                            <el-form-item :prop="pregunta.tipo+pregunta.pregunta_id" :rules="[{required: true, message: 'El campo es requerido', trigger: 'change' },{type: 'email', message: 'El campo requiere un email', trigger: 'change' }]">
                                                                <el-input v-model="inputs[index][pregunta.tipo+pregunta.pregunta_id]" style="width: 100%" :suffix-icon="pregunta.icon" size="mini" type="email" :placeholder="pregunta.placeholder"></el-input>                                            
                                                            </el-form-item>
                                                            <el-form-item>
                                                                <el-button size="mini" type="default" v-if="show!=1" @click="handlePrevious">Anterior</el-button>                                            
                                                                <el-button size="mini" native-type="submit" type="primary">@{{show==countPreguntas? 'Finalizar':'Siguiente'}}</el-button>
                                                            </el-form-item>
                                                        </el-form>
                                                    </div>
                                                    <div class="text-center" v-else-if="pregunta.tipo=='selectmulti'">
                                                    <el-form :model="inputs[index]" :ref="pregunta.tipo+pregunta.pregunta_id+'Form'" size="mini" @submit.native.prevent="handleNext(pregunta)" @keydown.native.enter.prevent="handleNext(pregunta)">
                                                            <el-form-item :prop="pregunta.tipo+pregunta.pregunta_id" :rules="[{ required: true, message: 'La seleccion es requerida', trigger: 'change' }]">
                                                                <el-select style="width: 100%" multiple v-model="inputs[index][pregunta.tipo+pregunta.pregunta_id]" size="mini" clearable :placeholder="pregunta.placeholder">
                                                                    <el-option
                                                                        v-for="item in pregunta.opciones"
                                                                        :key="item.id"
                                                                        :label="item.VALOR"
                                                                        :value="item.VALOR">
                                                                    </el-option>
                                                                </el-select>
                                                            </el-form-item>
                                                            <el-form-item>
                                                                <el-button size="mini" type="default" v-if="show!=1" @click="handlePrevious">Anterior</el-button>                                            
                                                                <el-button size="mini" native-type="submit" type="primary">@{{show==countPreguntas? 'Finalizar':'Siguiente'}}</el-button>
                                                            </el-form-item>
                                                        </el-form>
                                                    </div>
                                                    <br>
                                                </div>
                                                <div class="col-sm-2"></div>
                                            </div>
                                        </el-card>
                                    </el-collapse-transition>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                        </div>
                        <div v-if="!showCuestionario">
                            <sweetalert-icon icon="success" />
                        </div>
                    </div>
                </div>
            
        </div>
    </transition>
    <transition name="el-fade-in-linear">
        <div class="col-sm-12" v-if="showRespuestas" v-cloak>
            <div class="row">
                <div class="col-sm-12 table-responsive" style="background-color: white; padding: 4%;">
                    <div class="row">    
                        <div class="col-sm-2"></div>
                        <div class="col-sm-8">
                            <el-card>
                                <div class="col-sm-12">
                                    <div class="text-center">
                                        <h4>
                                            <strong>
                                                @{{respuestas.TITULO}}
                                            </strong>
                                        </h4>
                                    </div>
                                </div>
                                <br>
                                <div style="margin: 15px" v-for="item in respuestas.preguntas">
                                    <div class="col-sm-12">
                                        <p>
                                            <strong>
                                                @{{item.PREGUNTA}}
                                            </strong>
                                        </p>
                                    </div>
                                    <div class="col-sm-12" v-for="item in item.respuestas">
                                        <p style="margin-left: 5px;border-bottom-style: dotted;border-bottom-width: 1px;">
                                            @{{item.VALOR}}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-sm-12" style="margin-bottom: 15px">
                                    <div class="text-center">
                                        <el-button type="primary" @click="handleBackRespuestas" size="mini">Cerrar</el-button>
                                    </div>
                                </div>
                            </el-card>
                        </div>
                        <div class="col-sm-2"></div>
                    </div>
                </div>
            </div>
        </div>
    </transition>
</div>
@section('script')
{!!Html::script('js/cuestionarioUser.js')!!}
<link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
@endsection
@stop