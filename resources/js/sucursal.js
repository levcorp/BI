import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
locale.use(lang);
Vue.use(ElementUI);
var Main = {
    data() {
        return {
            createSucursal:{
                nombre:'',
                direccion : '',
                ciudad : '',
                telefono : '',
                fax :'',
                celular : '',
                correo : '',
                create : '',
                update : ''
            },
            updateSucursal:[],
            sucursales:[],
            sucursal:[],
            search:'',
            rules: {
                nombre: [
                    { required: true, message: 'El campo nombre es requerido', trigger: 'change' },
                    { min: 5, message: 'Se require al menos 5 caracteres', trigger: 'change' }
                ],
                direccion: [
                    { required: true, message: 'El campo dirección es requerido', trigger: 'change' },
                    { min: 5, message: 'Se require al menos 5 caracteres', trigger: 'change' }
                ],
                ciudad: [
                    { required: true, message: 'El campo ciudad es requerido', trigger: 'change' },
                    { min: 4, message: 'Se require al menos 4 caracteres', trigger: 'change' }
                ],
                telefono: [
                    { required: true, message: 'El campo telefono es requerido', trigger: 'change' },
                    { min: 7, message: 'Se require al menos 7 caracteres', trigger: 'change' }
                ],
                fax: [
                    { required: true, message: 'El campo fax es requerido', trigger: 'change' },
                    { min: 7, message: 'Se require al menos 7 caracteres', trigger: 'change' }
                ],
                celular: [
                    { required: true, message: 'El campo celular es requerido', trigger: 'change' },
                    { min: 6, message: 'Se require al menos 6 caracteres', trigger: 'change' }
                ],
                correo: [
                    { type:'email', required: true, message: 'El campo correo electronico no es valido', trigger: 'change' },
                    { min: 5, message: 'Se require al menos 5 caracteres', trigger: 'change' }
                ]
            }
        }
    },
    created() {
        this.handleGet();
    },
    methods: {
        handleGet: function () {
            var url='/api/sucursales/'
            axios.get(url).then(response=>{
                this.sucursales=response.data;
            });
        },
        handleEdit: function (index, row) {
            this.updateSucursal = row;
            $('#edit').modal('show');            
        },
        handleUpdate:function(form){
            this.$refs[form].validate((valid) => {
                if (valid) {
                    var url = '/api/sucursales/' + this.updateSucursal.id;
                    axios.put(url,this.updateSucursal).then(response=>{
                        this.handleGet();
                        this.$message({
                            type: 'success',
                            message: 'Edición exitosa!'
                        });
                        $('#edit').modal('hide');            
                        this.$refs[form].resetFields();
                    })
                } else {
                    return false;
                }
            });
        },
        handleDelete: function (index, row) {
            this.$confirm('Esta seguro de eliminar la sucursal '+row.nombre+' ?', 'Eliminar', {
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                type: 'warning'
            }).then(() => {
                var url='/api/sucursales/'+row.id;
                axios.delete(url).then(response=>{
                    this.handleGet();
                    this.$message({
                        type: 'success',
                        message: 'Eliminación completada'
                    });
                });
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: 'Eliminación cancelada'
                });
            });
        },
        handleCreate: function () {
            $('#create').modal('show');            
        },
        handleShow: function (index, row){
            this.sucursal=row;
            $('#show').modal('show');            
        },
        handleStore:function(form){
            this.$refs[form].validate((valid) => {
                if (valid) {
                    var url = "/api/sucursales";
                    axios.post(url, this.createSucursal).then(response => {
                        this.handleGet();
                        this.$message({
                            type: 'success',
                            message: 'Creación exitosa!'
                        });
                        $('#create').modal('hide');
                        this.createSucursal.nombre= '',
                        this.createSucursal.direccion = '',
                        this.createSucursal.ciudad = '',
                        this.createSucursal.telefono = '',
                        this.createSucursal.fax = '',
                        this.createSucursal.celular = '',
                        this.createSucursal.correo = '',
                        this.createSucursal.create = '',
                        this.createSucursal.update = ''
                        this.$refs[form].resetFields();
                    });
                } else {
                    return false;
                }
            });
        }
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');
