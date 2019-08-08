import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import Vue2Filters from 'vue2-filters'
import VueMoment from 'vue-moment';
Vue.use(Vue2Filters)

locale.use(lang);
const moment = require('moment')
require('moment/locale/es')
 
Vue.use(require('vue-moment'), {
    moment
});
Vue.use(ElementUI);
var Main = {
    data() {
        return {
            auth_user:'',
            createAccion:{
                FECHA_CREACION: new Date(),
                ESTADO_ACCION_ID:'',
                DESCRIPCION:''
            },
            estadoAcciones:[],
            acciones:[],
            pickerOptions: {
                disabledDate(time) {
                    var date = new Date();
                    date.setDate(date.getDate() - 1);
                    return time.getTime() < date;
                }
            },
            asignacionEstado:{
                estado_id:'',
            },
            estadoTarea:[],
            visibleEstado:false,    
            visible:false,
            showTab:false,
            asignacion:{
                usuario_id:''
            },
            users:{},
            activeName: 'registros',
            showUser:[],
            showEstado:[],
            showCUser:[],
            showTarea:[],
            asig_user: [],
            create_user: [],
            tarea: [],
            search: '',
            loading: false,
            clientes: [],
            tareas: [],
            createTarea: {
                TAREA: '',
                BRAND: '',
                SECTOR: '',
                FECHA_REGISTRO: new Date(),
                FECHA_CIERRE: '',
                CLIENTE: '',
                DESCRIPCION: '',
                CUSUARIO_ID: ''
            },
            updateTarea: {
                TAREA: '',
                BRAND: '',
                SECTOR: '',
                FECHA_REGISTRO: '',
                FECHA_CIERRE: '',
                CLIENTE: '',
                DESCRIPCION: '',
                CUSUARIO_ID: ''
            },
            rules: [],
            brand: [{ value: 'Mecanica' },
                { value: 'Electrica' },
                { value: 'Automatizacion', },
                { value: 'Media Tension' },
                { value: 'Instrumentacion' }
            ],
            sector: [
                { value: 'O&G' },
                { value: 'M&C' },
                { value: 'F&B' },
                { value: 'CSS' },
                { value: 'MAN' }
            ],
            optionsClientes: [],
            rules: {
                TAREA: [
                    { required: true, message: 'El nombre de la tarea es requerido', trigger: 'change' },
                    { min: 5, message: 'Debe contener al menos 5 caracteres', trigger: 'change' }
                ],
                BRAND: [
                    { required: true, message: 'La especialidad es requerida', trigger: 'change' }
                ],
                SECTOR: [
                    { required: true, message: 'El sector es requerido', trigger: 'change' }
                ],
                FECHA_CIERRE: [
                    { type: 'date', required: true, message: 'La Fecha de Cierre es requerida', trigger: 'change' }
                ],
                CLIENTE: [
                    { required: true, message: 'El nombre del cliente es requerido', trigger: 'change' },
                    { min: 4, message: 'Debe contener al menos 5 caracteres', trigger: 'change' }
                ],
                DESCRIPCION: [
                    { required: true, message: 'La descripcion es requerida', trigger: 'change' },
                    { min: 5, max: 200, message: 'Debe contener 5 a 200 caracteres', trigger: 'change' }
                ]
            },
            rulesAccion: {
                ESTADO_ACCION_ID: [
                    { required: true, message: 'El estado de la accion es requerida', trigger: 'change' },
                ],
                DESCRIPCION: [
                    { required: true, message: 'La descripcion es requerida', trigger: 'change' },
                    { min: 5, max: 200, message: 'Debe contener 5 a 200 caracteres', trigger: 'change' }
                ]
            },
            rulesAsignacionUser:{
                usuario_id: [
                    { required: true, message: 'El usuario es requerido', trigger: 'change' },
                ]
            },
            rulesAsignacionEstado:{
                estado_id: [
                    { required: true, message: 'El estado es requerido', trigger: 'change' },
                ]
            }
        }
    },
    mounted() {
        this.handleGet();
        this.handleUsers();
        this.handleEstadoTarea();
        this.handleEstadoAcciones();
    },
    methods: {
        handleUsers(){
            var url = "/api/tareas/users";
            axios.get(url).then(response => {
                this.users = response.data;
            })
        },
        handleGet() {
            var url = "/api/tareas/data";
            axios.post(url,{
                type:'user',
                value:this.auth_user,
            }).then(response => {
                this.tareas = response.data;
            })
        },
        handleCreate() {
            $('#create').modal('show');
        },
        handleUpdate() {
            this.$refs['formTareaUpdate'].validate((valid) => {
                if (valid) {
                    var url = '/api/tareas/' + this.updateTarea.id;
                    axios.put(url, this.updateTarea).then(response => {
                        this.handleGet();
                        $('#edit').modal('hide');
                        this.$message({
                            type: 'success',
                            message: 'La tarea fue editada exitosamente!'
                        });
                    })
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handleEdit(index, row) {
            this.updateTarea.id = row.id;
            this.updateTarea.TAREA = row.TAREA;
            this.updateTarea.BRAND = row.BRAND;
            this.updateTarea.SECTOR = row.SECTOR;
            this.updateTarea.FECHA_REGISTRO = row.FECHA_REGISTRO;
            var parts = row.FECHA_CIERRE.match(/(\d+)/g);
            this.updateTarea.FECHA_CIERRE = new Date(parts[0], parts[1] - 1, parts[2]);;
            this.updateTarea.CLIENTE = row.CLIENTE;
            this.updateTarea.DESCRIPCION = row.DESCRIPCION;
            this.updateTarea.CUSUARIO_ID = row.CUSUARIO_ID;
            $('#edit').modal('show');
        },
        handleSearchCliente(query) {
            if (query.length >= 4) {
                this.loading = true;
                var url = "/api/tareas/clientes"
                axios.post(url, { Nombre: query }).then(response => {
                    this.clientes = response.data;
                    this.loading = false;
                });
            } else {
                this.clientes = [];
                this.loading = false;
            }
        },
        handleStore() {
            this.$refs['formTarea'].validate((valid) => {
                if (valid) {
                    var url = '/api/tareas';
                    axios.post(url, this.createTarea).then(response => {
                        this.handleGet();
                        $('#create').modal('hide');
                        this.$message({
                            type: 'success',
                            message: 'La tarea fue creada exitosamente!'
                        });
                    })
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handleShow(index, row) {
            $('#show').modal('show');
            this.create_user = row.cusuario;
            this.asig_user = row.usuario;
            this.tarea = row;
        },
        handleDetail(index, row){
            this.showTarea=row;
            this.showCUser=row.cusuario;
            this.showEstado=row.estado;
            this.showUser=row.usuario;
            this.showTab=true;
            this.S=true;
            console.log((this.showEstado.TAG).trim());
            this.activeName= 'detalle';
            this.handleAcciones(row.id);
        },
        handleAsignar(){
            this.$refs['formAsignacionUser'].validate((valid) => {
                if (valid) {
                    var url='/api/tareas/asignacion';
                    axios.post(url,{
                        usuario_id:this.asignacion.usuario_id,
                        id:this.showTarea.id,
                    }).then(response=>{
                        this.handleGet();
                        this.showTarea=response.data;
                        this.showCUser=response.data.cusuario;
                        this.showEstado=response.data.estado;
                        this.showUser=response.data.usuario;
                        this.visible=false;
                        this.$message({
                            type: 'success',
                            message: 'Asignación de Usuario realizada correctamente'
                        });
                    });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
          
        },
        handleEstadoTarea(){
            var url='/api/tareas/estadotarea';
            axios.get(url).then(response=>{
                this.estadoTarea=response.data;
            });
        },
        handleAsignarEstadoTarea(){
            this.$refs['formAsignacionEstado'].validate((valid) => {
                if (valid) {
                    var url='/api/tareas/asignacionestadotarea';
                    axios.post(url,{
                        estado_tarea_id:this.asignacionEstado.estado_id,
                        id:this.showTarea.id,
                    }).then(response=>{
                        this.handleGet();
                        this.showTarea=response.data;
                        this.showCUser=response.data.cusuario;
                        this.showEstado=response.data.estado;
                        this.showUser=response.data.usuario;
                        this.visibleEstado=false;
                        this.$message({
                            type: 'success',
                            message: 'Asignación de Estado realizada correctamente'
                        });
                    });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handleCreateAccion(){
            $('#accion').modal('show');
        },
        handleAcciones(id){
            var url='/api/tareas/acciones' ;
            axios.post(url,{
                id:id
            }).then(response=>{
                this.acciones=response.data;
            });
        },
        handleEstadoAcciones(){
            var url='/api/tareas/estadoaccion';
            axios.get(url).then(response=>{
                this.estadoAcciones=response.data;
            });
        },
        handleStoreAccion(){
            this.$refs['formAccion'].validate((valid) => {
                if (valid) {
                    var url='/api/tareas/accion'
                    axios.post(url,{
                        ESTADO_ID:this.createAccion.ESTADO_ACCION_ID,
                        DESCRIPCION_ACCION:this.createAccion.DESCRIPCION,
                        TAREA_ID: this.showTarea.id,
                        USUARIO_ID:this.createAccion.USUARIO_ID,
                        OLD_USER:this.showUser.nombre+' '+this.showUser.apellido,
                    }).then(response=>{
                        $('#accion').modal('hide');
                        this.handleGet();
                        this.showTarea=response.data;
                        this.showCUser=response.data.cusuario;
                        this.showEstado=response.data.estado;
                        this.showUser=response.data.usuario;
                        this.handleAcciones(this.showTarea.id);
                        this.$message({
                            type: 'success',
                            message: 'Accion creada correctamente'
                        });
                    });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handleModalMessage(id,tarea_id){
            this.$prompt('', 'Resultado de la Acción', {
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                inputType:'textarea',
                inputValidator: {
                    minlength: 5,
                    clearable: true,
                },
                inputValidator(value){
                    if(!value || /^\s+|\s+$/.test(value)){
                        return "El campo es requerido"  
                    }
                }
              }).then(({ value }) => {
                    var url='/api/tareas/descripcionresultado';
                    axios.put(url,{
                        id:id,
                        tarea_id:tarea_id,
                        RESULTADO_ACCION:value
                    }).then(response=>{
                        this.$message({
                            type: 'success',
                            message: 'Resultado añadido correctamente'
                        });
                        this.handleAcciones(tarea_id);
                    });
              }).catch(() => {});
        }
    }
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#tareas');