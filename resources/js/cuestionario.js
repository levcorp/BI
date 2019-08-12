import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import Vue2Filters from 'vue2-filters'
import VueMoment from 'vue-moment';
import CKEditor from '@ckeditor/ckeditor5-vue';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';
Vue.use( CKEditor );

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
            editPreguntaForm:false,
            preguntas:[],
            updatePregunta:{
                TIPO:'',
                PREGUNTA:'',
                PESO:'',
                FECHA_ACTUALIZACION:new Date(),
                CUESTIONARIO_ID:'',
                PREGUNTA_ID:'',
            },
            createPregunta:{
                TIPO:'',
                PREGUNTA:'',
                PESO:'',
                FECHA_CREACION:new Date(),
                CUESTIONARIO_ID:''
            },
            createPreguntaForm:false,
            visible:false,
            value:'',
            drawer:false,
            pickerOptions: {
                disabledDate(time) {
                    var date = new Date();
                    date.setDate(date.getDate() - 1);
                    return time.getTime() < date;
                }
            },
            createCuestionario:{
                TITULO:'',
                AREA:'',
                USUARIO_ID:'',
                FECHA_REGISTRO:new Date(),
                FECHA_CIERRE:new Date()
            },
            updateCuestionario:{
                id:'',
                TITULO:'',
                AREA:'',
                USUARIO_ID:'',
                FECHA_ACTUALIZACION:new Date(),
                FECHA_CIERRE:''
            },
            cuestionarios:[],
            cuestionario:[],
            areas: [
                { value: 'Gerencia Administrativa' },
                { value: 'Sistemas' },
                { value: 'Finanzas' },
                { value: 'Adquisiciones' },
                { value: 'Gestion Operativa' },
                { value: 'Especialistas' },
                { value: 'Ingenieros de Aplicacion' }
            ],
            rulesCreatePregunta:{
                TIPO: [
                    { required: true, message: 'El tipo es requerido', trigger: 'change' },
                ],
                PREGUNTA: [
                    { required: true, message: 'La pregunta es requerida', trigger: 'change' },
                    { min: 5, message: 'Debe contener al menos 5 caracteres', trigger: 'change' }
                ],
                PESO: [
                    { required: true, message: 'El orden es requerido', trigger: 'change' },
                ],
            },
            rulesUpdatePregunta:{
                TIPO: [
                    { required: true, message: 'El tipo es requerido', trigger: 'change' },
                ],
                PREGUNTA: [
                    { required: true, message: 'La pregunta es requerida', trigger: 'change' },
                    { min: 5, message: 'Debe contener al menos 5 caracteres', trigger: 'change' }
                ],
                PESO: [
                    { required: true, message: 'El orden es requerido', trigger: 'change' },
                ],
            },
            rules:{
                TITULO: [
                    { required: true, message: 'El titulo del cuestionario es requerido', trigger: 'change' },
                    { min: 5, message: 'Debe contener al menos 5 caracteres', trigger: 'change' }
                ],
                AREA:[
                    { required: true, message: 'El area es requerida', trigger: 'change' },
                ],
                FECHA_CIERRE:[
                    { required: true, message: 'La fecha de cierre es requerida', trigger: 'change' },
                ]
            },
        }
    },
    created() {
        this.handleGet();        
    },
    mounted() {
    },
    methods: {
        handleGet(){
            var url='/api/cuestionarios'
            axios.get(url).then(response=>{
                this.cuestionarios=response.data
            });
        },
        handleCommand(command) {
            switch (command.type) {
                case 'edit':
                    $('#edit').modal('show');      
                    this.updateCuestionario.id=command.cuestionario.id;
                    this.updateCuestionario.TITULO=command.cuestionario.TITULO;
                    this.updateCuestionario.AREA=command.cuestionario.AREA;
                    this.updateCuestionario.USUARIO_ID=command.cuestionario.USUARIO_ID;
                    this.updateCuestionario.FECHA_CIERRE=command.cuestionario.FECHA_CIERRE ;
                    break;
                case 'show':
                    this.cuestionario=command.cuestionario;
                    $('#show').modal('show');       
                    break;
                case 'more':
                    this.drawer=true;
                    this.cuestionario=command.cuestionario;
                    this.createPregunta.CUESTIONARIO_ID = command.cuestionario.id
                    this.handleGetPreguntas();
                    break;
                case 'delete':
                    this.$confirm('Eliminar Cuestionario ?', 'Warning', {
                        confirmButtonText: 'Eliminar',
                        cancelButtonText: 'Cancelar',
                        type: 'warning'
                        }).then(() => {
                        var url='/api/cuestionarios/'+command.cuestionario.id;
                        axios.delete(url).then(response=>{
                            this.handleGet();   
                            this.$message({
                                type: 'success',
                                message: 'El cuestionario fue elimino correctamente'
                                });
                        });
                        }).catch(() => {
                        });
                    break;
                default:
                    break;
            }
        },
        handleGetPreguntas(){
            var url='/api/cuestionarios/preguntas';
            axios.post(url,{
                CUESTIONARIO_ID:this.createPregunta.CUESTIONARIO_ID
            }).then(response=>{
                this.preguntas=response.data;
            });
        },
        handleStorePregunta(){
            this.$refs['formCreatePregunta'].validate((valid) => {
            if (valid) {
                var url='/api/cuestionarios/createpregunta';
                    axios.post(url,this.createPregunta).then(response=>{
                        this.handleGetPreguntas();
                        this.createPreguntaForm=false;
                        this.$message({
                            type: 'primary',
                            message: 'La pregunta fue creada correctamente'
                            });
                    });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handleCreate(){
            $('#create').modal('show');
        },
        handleStore(){
            this.$refs['createCuestionario'].validate((valid) => {
                if (valid) {
                    var url='/api/cuestionarios/';
                    axios.post(url,this.createCuestionario).then(response=>{
                        $('#create').modal('hide');    
                        this.handleGet();
                        this.$message({
                            type: 'primary',
                            message: 'El cuestionario fue creado correctamente'
                            });
                    });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handleUpdate(){
            this.$refs['updateCuestionarioform'].validate((valid) => {
                if (valid) {
                    var url='/api/cuestionarios/'+ this.updateCuestionario.id;
                    axios.put(url,this.updateCuestionario).then(response=>{
                        $('#edit').modal('hide');    
                        this.handleGet();
                        this.$message({
                            type: 'primary',
                            message: 'El cuestionario fue actualizado correctamente'
                            });
                    });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handleEditPregunta(pregunta){
            this.editPreguntaForm=true;
            this.updatePregunta.TIPO=pregunta.TIPO,
            this.updatePregunta.PREGUNTA=pregunta.PREGUNTA,
            this.updatePregunta.PESO=pregunta.PESO,
            this.updatePregunta.CUESTIONARIO_ID=this.cuestionario.id,
            this.updatePregunta.PREGUNTA_ID=pregunta.id
        },
        handleUpdatePregunta(pregunta){
            var url='/api/cuestionarios/updatepregunta'
            axios.put(url,this.updatePregunta).then(response=>{
                this.handleGetPreguntas();
                this.editPreguntaForm=false;
                this.$message({
                    type: 'primary',
                    message: 'La pregunta fue actualizada correctamente'
                    });
            });
        },
        handleEstadoPregunta(pregunta){
            this.$confirm('¿ Cambiar de estado la pregunta ?', '', {
                confirmButtonText: 'Cambiar',
                cancelButtonText: 'Cancelar',
                type: 'warning'
              }).then(() => {
                    var url='/api/cuestionarios/changeestado';
                    axios.post(url,{
                        CUESTIONARIO_ID:pregunta.id
                    }).then(response=>{
                        this.handleGetPreguntas();                        
                        this.$message({
                            type: 'primary',
                            message: 'El estado fue actualizado correctamente'
                            });
                    });
              }).catch(() => {});
        },
        handleDeletePregunta(pregunta){
            this.$confirm('¿ Eliminar pregunta ?', '', {
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                type: 'danger'
              }).then(() => {
                    var url='/api/cuestionarios/preguntadelete/'+pregunta.id;
                    axios.delete(url).then(response=>{
                        this.$message({
                            type: 'primary',
                            message: 'La pregunta fue eliminada correctamente'
                        });
                        this.handleGetPreguntas();                        
                    });
              }).catch(() => {});
        }
        
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');