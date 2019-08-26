import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import Vue2Filters from 'vue2-filters'
import VueMoment from 'vue-moment';
import rate from 'vue-rate';

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
            pregunta_id:'',
            helpOptions:[],
            preguntaOpciones:[],
            preguntaCaracteristicas:[],
            showDetallePregunta:false,
            usuario_id:'',
            grupoUser:[],
            cuestionario_id:'',
            searchGrupos:'',
            grupos:[],
            pregunta:[],
            index:'',
            preg:'',
            toolPreguntas: {
                OPTIONS: [],
                DESCS: [],
                CARACTERISTICA:'',
                PREGUNTA_ID:'',
                COLOR:'',
                PLACEHOLDER:'',
                ICONO:'',
                MIN:'',
                MAX:'',
                VERDADERO:'',
                FALSO:'',
            },
            typePregunta:false,
            toolPregunta:false,
            col1:'',
            col2:'col-sm-12',
            sizeDrawer:'50%',
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
            rulesToolPregunta:{
                CARACTERISTICA:[
                    { required: true, message: 'La caracteristica es requerida', trigger: 'change' },
                ],
                COLOR:[
                    { required: true, message: 'El color es requerido', trigger: 'change' },                    
                ],
                PLACEHOLDER:[
                    { required: true, message: 'El placeholder es requerido', trigger: 'change' },                    
                ],
                ICONO:[
                    { required: true, message: 'El color es icono', trigger: 'change' },                    
                ],
                MIN:[
                    { required: true, message: 'El minimo es requerido', trigger: 'change' },                    
                ],
                MAX:[
                    { required: true, message: 'El maximo es requerido', trigger: 'change' },                    
                ],
                VERDADERO:[
                    { required: true, message: 'El campo requerido', trigger: 'change' },                    
                ],
                FALSO:[
                    { required: true, message: 'El campo requerido', trigger: 'change' },                    
                ],
            },   
        }
    },
    mounted() {
        this.handleGet();        
    },
    methods: {
        handleDetallePreguntaDelete(){
            this.$confirm('Eliminar valores y caracteristicas de la pregunta ?', 'Eliminar', {
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                type: 'error'
                }).then(() => {
                    var url='/api/cuestionarios/deletecaracteristicas';
                    axios.post(url,{
                        PREGUNTA_ID:this.pregunta_id,
                    }).then(response=>{
                        this.handleDetallePreguntaCancel(); 
                        this.handleGetPreguntas();
                    });
                }).catch(() => {
                });
        },
        handleDetallePreguntaCancel(){
            this.showDetallePregunta=false;
            this.preguntaCaracteristicas=[];
            this.preguntaOpciones=[];
        },
        handleShowDetallePregunta(pregunta){
            this.showDetallePregunta=true
            this.pregunta_id=pregunta.id;
            this.handleShowCaracteristicas(pregunta);
            this.handleShowOpciones(pregunta);   
            this.pregunta=pregunta;      
        },
        handleShowCaracteristicas(pregunta){
            var url="/api/cuestionarios/caracteristicas";
            axios.post(url,{
                PREGUNTA_ID:pregunta.id
            }).then(response=>{
                this.preguntaCaracteristicas=response.data;
                this.helpOptions=response.data[0];
            });
        },  
        handleShowOpciones(pregunta){
            var url="/api/cuestionarios/opciones";
            axios.post(url,{
                PREGUNTA_ID:pregunta.id
            }).then(response=>{
                this.preguntaOpciones=response.data;
            });
        },
        handleResetTool(){
            this.toolPreguntas= {
                TIPO:'',
                OPTIONS: [],
                DESCS: [],
                CARACTERISTICA:'',
                PREGUNTA_ID:'',
                COLOR:'',
                PLACEHOLDER:'',
                ICONO:'',
                MIN:'',
                MAX:'',
                VERDADERO:'',
                FALSO:'',
            }
        },
        handleGet(){
            var url='/api/cuestionarios/get'
            axios.post(url,{
                USUARIO_ID:this.usuario_id
            }).then(response=>{
                this.cuestionarios=response.data
            });
        },
        handleGetGrupoUser(grupo_id){
            var url='/api/cuestionarios/grupouser'
            axios.post(url,{GRUPO_ID:grupo_id}).then(response=>{
                this.grupoUser=response.data
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
                    this.handleGetGrupoUser(command.cuestionario.ID_GRUPO_USUARIOS);
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
                case 'grupo':
                    this.cuestionario_id=command.cuestionario.id;
                    this.handleGetGrupos();
                    $('#grupo').modal('show');                               
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
                        this.createPregunta.TIPO=''
                        this.createPregunta.PREGUNTA='',
                        this.createPregunta.PESO='',
                        this.createPregunta.FECHA_CREACION=new Date()
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
                    var url='/api/cuestionarios';
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
            this.$refs['formUpdatePregunta'].validate((valid) => {
            if (valid) {
                var url='/api/cuestionarios/updatepregunta'
                axios.put(url,this.updatePregunta).then(response=>{
                    this.handleGetPreguntas();
                    this.editPreguntaForm=false;
                    this.$message({
                        type: 'primary',
                        message: 'La pregunta fue actualizada correctamente'
                        });
                    this.createPregunta.TIPO=''
                    this.createPregunta.PREGUNTA='',
                    this.createPregunta.PESO='',
                    this.createPregunta.FECHA_CREACION=new Date()
                });
            } else {
                console.log('error submit!!');
                return false;
            }
            });
        },
        handleEstadoChange(cuestionario){
            this.$confirm('Cambiar el estado ?', 'Cuidado', {
                confirmButtonText: 'Cambiar',
                cancelButtonText: 'Cancelar',
                type: 'warning'
            }).then(() => {
                var url="/api/cuestionarios/estadochange"
                axios.post(url,{
                    CUESTIONARIO_ID:cuestionario.id,
                    ESTADO:cuestionario.ESTADO
                }).then(response=>{
                    this.handleGet();
                });
            }).catch(() => {});
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
        },
        handleToolPregunta(pregunta){
            this.preg="preg";
            this.index=pregunta.id;
            this.typePregunta=pregunta.TIPO;
            this.toolPreguntas.TIPO=pregunta.TIPO;
            this.toolPreguntas.PREGUNTA_ID=pregunta.id;
            this.toolPregunta=true;
            this.sizeDrawer='80%';
            this.col1='col-sm-3';
            this.col2='col-sm-9';
            this.pregunta=pregunta;
            //if(this.toolPregunta){this.$refs['formToolPregunta'].resetFields();}
        },
        handleToolCancel(){
            this.preg="";
            this.toolPregunta=false;
            setTimeout(() => {
                this.col2='col-sm-12';
                this.col1='';
                this.sizeDrawer='50%';                
            }, 300);
        },
        addOption: function (){
            this.toolPreguntas.OPTIONS.push({
              key: Date.now(),
              value: ''
            });
        },
        removeOption(item) {
            var index = this.toolPreguntas.OPTIONS.indexOf(item);
            if (index !== -1) {
                this.toolPreguntas.OPTIONS.splice(index, 1);
            }
        },
        addDesc: function (){
            this.toolPreguntas.DESCS.push({
                key: Date.now(),
                value: ''
            });
        },
        removeDesc(item) {
            var index = this.toolPreguntas.DESCS.indexOf(item);
            if (index !== -1) {
                this.toolPreguntas.DESCS.splice(index, 1);
            }
        },
        handleStoreToolPregunta(){
            var url='/api/cuestionarios/toolpregunta';
            this.$refs['formToolPregunta'].validate((valid) => {
                if (valid) {
                    axios.post(url,this.toolPreguntas).then(response=>{
                        this.preg="";
                        this.toolPregunta=false;
                        setTimeout(() => {
                            this.col2='col-sm-12';
                            this.col1='';
                            this.sizeDrawer='50%';                
                        }, 300);
                        this.$message({
                            type: 'success',
                            message: 'Las caracteristicas fueron actualizadas correctamente'
                        });
                        this.handleGetPreguntas();
                        this.handleResetTool();
                    })
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handleGetGrupos(){
            var url='/api/cuestionarios/grupos';
            axios.get(url).then(response=>{
                this.grupos=response.data;
            });
        },
        handleAssignmentGrupo(index, row){
            var url='/api/cuestionarios/assignaciongrupo'
            axios.post(url,{
                CUESTIONARIO_ID:this.cuestionario_id,
                GRUPO_ID:row.id,
            }).then(response=>{
                $('#grupo').modal('hide');    
                this.handleGet();
                this.$message({
                    type: 'primary',
                    message: 'El grupo fue assignado correctamente'
                });
            })
        },
        
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');