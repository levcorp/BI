import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import Vue2Filters from 'vue2-filters'
import VueMoment from 'vue-moment';
import rate from 'vue-rate';
import { VueSpinners } from '@saeris/vue-spinners'
import SweetAlertIcons from 'vue-sweetalert-icons';
Vue.use(SweetAlertIcons);
Vue.use(VueSpinners)
Vue.use(rate)
locale.use(lang);
Vue.use(ElementUI);
Vue.use(Vue2Filters)

const moment = require('moment')
require('moment/locale/es')
 
Vue.use(require('vue-moment'), {
    moment
});
var Main = {    
    data() {
        return {
            date:new Date(),
            cuestionarios:[],
            showPreguntas:false,
            showCuestionarios:true,
            step: 0, //show
            show:1,  //cards
            cuestionario:[],
            preguntas:[],
            countPreguntas:'',
            inputs:[],
            usuario_id:'',//AUTH LARAVEL
            showCuestionario:true,
            showStep:true,
            respuestas:[],
            showRespuestas:false
        }
    },
    created() {
    },
    mounted() {
        this.handleGetCuestionarios();
    },
    methods: {
        handleBack(){
            this.showPreguntas=false;
            this.showCuestionarios=true;
            this.showCuestionario=true;
            this.showStep=true;
            this.inputs=[];
            this.step = 0;
            this.show=1;
        },
        handleLlenar(cuestionario_id){
            this.handleGet(cuestionario_id);
            this.showPreguntas=true;
            this.showCuestionarios=false;
        },
        handleGetCuestionarios(){
            var url='/api/cuestionarios/usuario/cuestionarios';
            axios.post(url,{
                USUARIO_ID:this.usuario_id
            }).then(response=>{
                this.cuestionarios=response.data;
            });
        },
        handleInputs(){
            this.cuestionario.preguntas.forEach(element=>{
                if(element.TIPO=='text'){
                    this.inputs.push({
                        ['text'.concat(element.id)] : '',
                        tipo:'text',
                        pregunta:element.PREGUNTA,
                        cuestionario_id:element.CUESTIONARIO_ID,
                        pregunta_id: element.id,
                        usuario_id:this.usuario_id,
                        icono:element.caracteristicas.length>0?element.caracteristicas[0].ICONO:'el-icon-edit',
                        placeholder:element.caracteristicas.length>0?element.caracteristicas[0].PLACEHOLDER:'Llene el campo de texto'
                    });
                }
                if(element.TIPO=='number'){
                    this.inputs.push({
                        ['number'.concat(element.id)]:0,
                        tipo:'number',
                        pregunta:element.PREGUNTA,
                        cuestionario_id:element.CUESTIONARIO_ID,
                        pregunta_id:element.id,
                        usuario_id:this.usuario_id,
                        max:element.caracteristicas.length>0?element.caracteristicas[0].MAX:'1000000000000',
                        min:element.caracteristicas.length>0?element.caracteristicas[0].MIN:'-1000000000000',
                        placeholder:element.caracteristicas.length>0?element.caracteristicas[0].PLACEHOLDER:'Llene el campo de numerico'
                    });
                }
                if(element.TIPO=='textarea'){
                    this.inputs.push({
                        ['textarea'.concat(element.id)]:'',
                        tipo:'textarea',
                        pregunta:element.PREGUNTA,
                        cuestionario_id:element.CUESTIONARIO_ID,
                        pregunta_id:element.id,
                        usuario_id:this.usuario_id,
                        icono:element.caracteristicas.length>0?element.caracteristicas[0].ICONO:'el-icon-edit',
                        placeholder:element.caracteristicas.length>0?element.caracteristicas[0].PLACEHOLDER:'Llene el campo de texto'
                    });
                }
                if(element.TIPO=='email'){
                    this.inputs.push({
                        ['email'.concat(element.id)]:'',
                        tipo:"email",
                        pregunta:element.PREGUNTA,
                        cuestionario_id:element.CUESTIONARIO_ID,
                        pregunta_id:element.id,
                        usuario_id:this.usuario_id,
                        icono:element.caracteristicas.length>0?element.caracteristicas[0].ICONO:'el-icon-edit',
                        placeholder:element.caracteristicas.length>0?element.caracteristicas[0].PLACEHOLDER:'Llene el campo de texto'
                    })
                }
                if(element.TIPO=='switch'){
                    this.inputs.push({
                        ['switch'.concat(element.id)]:'',
                        tipo:'switch',
                        pregunta:element.PREGUNTA,
                        cuestionario_id:element.CUESTIONARIO_ID,
                        pregunta_id:element.id,
                        usuario_id:this.usuario_id,
                        falso:element.caracteristicas.length>0?element.caracteristicas[0].FALSO:'No',
                        verdadero:element.caracteristicas.length>0?element.caracteristicas[0].VERDADERO:'Si'
                    })
                }
                if(element.TIPO=='rate'){
                    this.inputs.push({
                        ['rate'.concat(element.id)]:'',
                        tipo:'rate',
                        pregunta:element.PREGUNTA,
                        cuestionario_id:element.CUESTIONARIO_ID,
                        pregunta_id:element.id,
                        usuario_id:this.usuario_id,
                        max:element.caracteristicas.length>0?element.caracteristicas[0].MAX:'1000000000000',
                        labels:this.handleRateLabel(),  
                    })
                }
                if(element.TIPO=='date'){
                    this.inputs.push({
                        ['date'.concat(element.id)]:'',
                        pregunta_id:element.id,
                        tipo:'date',
                        pregunta:element.PREGUNTA,
                        cuestionario_id:element.CUESTIONARIO_ID,
                        usuario_id:this.usuario_id,
                        placeholder:element.caracteristicas.length>0?element.caracteristicas[0].PLACEHOLDER:'Selecciona una fecha'
                    })
                }
                if(element.TIPO=='datetime'){
                    this.inputs.push({  
                        ['datetime'.concat(element.id)]:'',
                        pregunta_id:element.id,
                        tipo:'datetime',
                        pregunta:element.PREGUNTA,
                        cuestionario_id:element.CUESTIONARIO_ID,
                        usuario_id:this.usuario_id,
                        placeholder:element.caracteristicas.length>0?element.caracteristicas[0].PLACEHOLDER:'Selecciona una fecha y hora'
                    })
                }
                if(element.TIPO=='time'){
                    this.inputs.push({
                        ['time'.concat(element.id)]:'',
                        tipo:'time',
                        pregunta:element.PREGUNTA,
                        cuestionario_id:element.CUESTIONARIO_ID,
                        pregunta_id:element.id,
                        usuario_id:this.usuario_id,
                        placeholder:element.caracteristicas.length>0?element.caracteristicas[0].PLACEHOLDER:'Selecciona una hora'
                    })
                }
                if(element.TIPO=='select'){
                    this.inputs.push({
                        ['select'.concat(element.id)]:'',
                        pregunta_id:element.id,
                        tipo:'select',
                        pregunta:element.PREGUNTA,
                        cuestionario_id:element.CUESTIONARIO_ID,
                        usuario_id:this.usuario_id,
                        placeholder:element.caracteristicas.length>0?element.caracteristicas[0].PLACEHOLDER:'Seleccione una opcion',
                        opciones:element.opciones,
                    })
                }
                if(element.TIPO=='selectmulti'){
                    this.inputs.push({
                        ['selectmulti'.concat(element.id)]:[],
                        pregunta_id:element.id,
                        tipo:'selectmulti',
                        pregunta:element.PREGUNTA,
                        cuestionario_id:element.CUESTIONARIO_ID,
                        usuario_id:this.usuario_id,
                        placeholder:element.caracteristicas.length>0?element.caracteristicas[0].PLACEHOLDER:'Selecciona mas de una opcion',
                        opciones:element.opciones
                    })
                }
            });
        },
        handleNext:function(pregunta){
            this.$refs[pregunta.tipo+pregunta.pregunta_id+'Form'][0].validate((valid) => {
                if (valid){
                    if(this.show+1 > this.countPreguntas){
                        //this.show = 1; /// fin y inicio otra vez cards
                        this.showCuestionario=false;
                        this.showStep=false;
                        this.handleStoreRespuestas();
                        
                    }else{
                        this.show=this.show+1;
                    }
                    if(this.step+1 > this.countPreguntas-1) {
                        this.step = 0; /// fin y inicio otra vez steps
                    }else{
                        this.step=this.step+1;
                    }
                }else{
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handlePrevious(){
            this.show--;
            this.step--;
        },
        handleCountPreguntas(id){
            var url='/api/cuestionarios/usuario/countpreguntas';
            axios.post(url,{
                CUESTIONARIO_ID:id
            }).then(response=>{
                this.countPreguntas=response.data
            });
        },
        handleRateLabel(){
            var label=[];
            this.cuestionario.preguntas.forEach(element => {
                if(element.TIPO =='rate'){
                    element.opciones.forEach(element => {
                        label.push(element.VALOR);
                    });
                }
            });
            return label;
        },
        handleGet(CUESTIONARIO_ID){
            var url='/api/cuestionarios/usuario/getpreguntas';
            axios.post(url,{
                CUESTIONARIO_ID:CUESTIONARIO_ID,
            }).then(response=>{
                this.cuestionario=response.data;
                this.handleInputs();
                this.handleCountPreguntas(this.cuestionario.id);
            });
        },
        handleStoreRespuestas(){
            var url='/api/cuestionarios/usuario/respuestas';
            axios.post(url,this.inputs).then(response=>{
                this.handleGetCuestionarios();
            });
        },
        handleListRespuestas(CUESTIONARIO_ID){
            this.showCuestionarios=false;
            var url='/api/cuestionarios/usuario/listrespuestas';
            axios.post(url,{
                CUESTIONARIO_ID:CUESTIONARIO_ID,
                USUARIO_ID:this.usuario_id
            }).then(response=>{
                this.respuestas=response.data;
                this.showRespuestas=true;
            });
        },
        handleBackRespuestas(){
            this.showRespuestas=false;
            setTimeout(()=>{
                this.showCuestionarios=true;
                this.respuestas=[];
            },500)       
        }
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');