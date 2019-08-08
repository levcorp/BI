import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import Vue2Filters from 'vue2-filters'
Vue.use(Vue2Filters)

locale.use(lang);
Vue.use(ElementUI);
var Main = {
    data() {
        return {
            createEstadoAccion:{
                ACCION:'',
                ICON:'',
                COLOR:'',
            },
            createEstadoTarea:{
                ESTADO_TAREA:'',
                ICON:'',
                COLOR:'',
                TAG:''
            },
            editEstadoAccion:{
                ACCION:'',
                ICON:'',
                COLOR:'',
            },
            editEstadoTarea:{
                ESTADO_TAREA:'',
                ICON:'',
                COLOR:'',
                TAG:''
            },
            estadosAccion:[],
            estadosTarea:[],
            searchEstadoTarea:'',
            searchEstadoAccion:'',
            rulesEstadoTarea: {
                ESTADO_TAREA: [
                    { required: true, message: 'El estado de la accion es requerida', trigger: 'change' },
                ],
                ICON: [
                    { required: true, message: 'El icono es requerido', trigger: 'change' },
                ],
                COLOR:[
                    { required: true, message: 'El color es requerido', trigger: 'change' },
                ],
                TAG:[
                    { required: true, message: 'La etiqueta es requerida', trigger: 'change' },
                ]
            },
            rulesEstadoAccion: {
                ACCION: [
                    { required: true, message: 'El estado de la accion es requerida', trigger: 'change' },
                ],
                ICON: [
                    { required: true, message: 'El icono es requerido', trigger: 'change' },
                ],
                COLOR:[
                    { required: true, message: 'El color es requerido', trigger: 'change' },
                ],  
            },
        }
    },
    mounted() {
        this.handleGet();
    },
    methods: {
        handleGetEstadoTarea(){
            var url='/api/estados/tarea'
            axios.get(url).then(response=>{
                this.estadosTarea=response.data;
            });
        },
        handleGetEstadoAccion(){
            var url='/api/estados/accion';
            axios.get(url).then(response=>{
                this.estadosAccion=response.data;
            });
        },
        handleGet(){
            this.handleGetEstadoTarea();
            this.handleGetEstadoAccion();
        },
        handleCreateEstadoAccion(){
            $('#createEstadoAccion').modal('show');
        },
        handleCreateEstadoTarea(){
            $('#createEstadoTarea').modal('show');
        },
        handleStoreEstadoTarea(){
            this.$refs['createEstadoTareaForm'].validate((valid) => {
                if (valid) {
                    var url='/api/estados/tarea';
                    axios.post(url,{
                        ESTADO_TAREA:this.createEstadoTarea.ESTADO_TAREA,
                        ICON:this.createEstadoTarea.ICON,
                        COLOR:this.createEstadoTarea.COLOR,
                        TAG:this.createEstadoTarea.TAG
                    }).then(response=>{
                        this.handleGetEstadoTarea();
                        $('#createEstadoTarea').modal('hide');
                        this.$message({
                            type: 'success',
                            message: 'Estado creado correctamente'
                        }); 
                        this.createEstadoTarea={
                            ESTADO_TAREA:'',
                            ICON:'',
                            COLOR:'',
                            TAG:''
                        };
                    });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handleStoreEstadoAccion(){
            this.$refs['createEstadoAccionForm'].validate((valid) => {
                if (valid) {
                    var url='/api/estados/accion';
                    axios.post(url,{
                        ACCION:this.createEstadoAccion.ACCION,
                        COLOR:this.createEstadoAccion.COLOR,
                        ICON:this.createEstadoAccion.ICON
                    }).then(response=>{
                        this.handleGetEstadoAccion();
                        $('#createEstadoAccion').modal('hide');
                        this.$message({
                            type: 'success',
                            message: 'Estado creado correctamente'
                        });   
                        this.createEstadoAccion={
                            ACCION:'',
                            ICON:'',
                            COLOR:'',
                        };
                    });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handleDeleteEstadoAccion(index, row){
            this.$confirm('Esta seguro de eliminar el estado ?', 'Eliminar', {
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                type: 'warning'
            }).then(() => {
                var url='/api/estados/accion/'+row.id;
                axios.delete(url).then(response=>{
                    this.handleGetEstadoAccion();     
                    this.$message({
                        type: 'success',
                        message: 'Estado eliminado correctamente'
                    });               
                });
            }).catch(() => {});
        },
        handleDeleteEstadoTarea(index, row){
            this.$confirm('Esta seguro de eliminar el estado ?', 'Eliminar', {
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                type: 'warning'
            }).then(() => {
                var url='/api/estados/tarea/'+row.id;
                axios.delete(url).then(response=>{
                    this.handleGetEstadoTarea();   
                    this.$message({
                        type: 'success',
                        message: 'Estado eliminado correctamente'
                    });                  
                });
            }).catch(() => {});
        },
        handleEditEstadoTarea(index,row){
            this.editEstadoTarea.id=row.id;
            this.editEstadoTarea.ESTADO_TAREA=row.ESTADO_TAREA,
            this.editEstadoTarea.COLOR=row.COLOR,
            this.editEstadoTarea.ICON=row.ICON,
            this.editEstadoTarea.TAG=row.TAG
            $('#editEstadoTarea').modal('show');
        },
        handleEditEstadoAccion(index,row){
            this.editEstadoAccion.id=row.id;
            this.editEstadoAccion.ACCION=row.ACCION;
            this.editEstadoAccion.COLOR=row.COLOR,
            this.editEstadoAccion.ICON=row.ICON;
            $('#editEstadoAccion').modal('show');
        },
        handleUpdateEstadoTarea(){
            this.$refs['editEstadoTareaForm'].validate((valid) => {
                if (valid) {
                    var url='/api/estados/tarea/edit';
                    axios.put(url,{
                        id:this.editEstadoTarea.id,
                        ESTADO_TAREA:this.editEstadoTarea.ESTADO_TAREA,
                        ICON:this.editEstadoTarea.ICON,
                        COLOR:this.editEstadoTarea.COLOR,
                        TAG:this.editEstadoTarea.TAG
                    }).then(response=>{
                        this.handleGetEstadoTarea();
                        $('#editEstadoTarea').modal('hide');
                        this.$message({
                            type: 'success',
                            message: 'Estado actualizado correctamente'
                        }); 
                    });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handleUpdateEstadoAccion(){
            this.$refs['editEstadoAccionForm'].validate((valid) => {
                if (valid) {
                    var url='/api/estados/accion/edit';
                    axios.put(url,{
                        id:+this.editEstadoAccion.id,
                        ACCION:this.editEstadoAccion.ACCION,
                        COLOR:this.editEstadoAccion.COLOR,
                        ICON:this.editEstadoAccion.ICON
                    }).then(response=>{
                        this.handleGetEstadoAccion();
                        $('#editEstadoAccion').modal('hide');
                        this.$message({
                            type: 'success',
                            message: 'Estado actualizado correctamente'
                        });   
                    });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        }
    },
};
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');