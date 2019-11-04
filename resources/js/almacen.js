import Vue from 'vue';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import Vue2Filters from 'vue2-filters'
const moment = require('moment');
require('moment/locale/es');

Vue.use(Vue2Filters)
Vue.use(require('vue-moment'), {
    moment
});
locale.use(lang);
Vue.use(ElementUI);

var Main = {
    data() {
        return {
            values: {
                usuario_id: '',
                sucursal_id: ''
            },
            active: {
                tab: ''
            },
            loading: {
                articulos: false,
                listas: false,
            },
            articulos: [],
            fabricantes: [],
            usuarios: [],
            filterMethod(query, item) {
                return item.label.toLowerCase().indexOf(query.toLowerCase()) > -1;
            },
            createAsignacion: {
                FABRICANTES: [],
                USUARIO: '',
                LISTA_ID: ''
            },
            listas: [],
            createList: {
                NOMBRE: '',
                DESCRIPCION: '',
                USUARIO_ID: '',
                CREACION: new Date()
            },
            editList: {
                LISTA_ID: '',
                NOMBRE: '',
                DESCRIPCION: '',
                USUARIO_ID: '',
            },
            rulesLista: {
                NOMBRE: [{
                        required: true,
                        message: 'El campo es requerido',
                        trigger: 'change'
                    },
                    {
                        min: 3,
                        message: 'Se require al menos 3 caracteres',
                        trigger: 'change'
                    }
                ],
                DESCRIPCION: [{
                        required: true,
                        message: 'El campo es requerido',
                        trigger: 'change'
                    },
                    {
                        min: 5,
                        message: 'Se require al menos 5 caracteres',
                        trigger: 'change'
                    }
                ],
            },
            rulesAsignacion: {
                USUARIO: [{
                    required: true,
                    message: 'El campo es requerido',
                    trigger: 'change'
                }, ],
            },
            lista: [],
            show: {
                articulos: false,
                listas: true,
                error: false
            },
            asignaciones: [],
            asignacion:[],
            editAsignacion: {
                FABRICANTES: [],
                ASIGNACION_ID: ''
            },
            editFabricantes:[]
        }
    },
    mounted() {
        this.handleGetListas();
    },
    methods: {
        handleGetArticulos() {
            this.loading.articulos = true;
            axios.post('/api/almacen/get/articulos', {
                'sucursal_id': this.values.sucursal_id
            }).then(response => {
                this.articulos = response.data;
                this.loading.articulos = false;
            });
        },
        handleGetFabricantes() {
            axios.post('/api/almacen/get/fabricantes', {
                'sucursal_id': this.values.sucursal_id,
                'lista_id': this.lista.id
            }).then(response => {
                this.fabricantes = response.data;
            });
        },
        handleGetEditFabricantes() {
            axios.post('/api/almacen/get/editfabricantes', {
                'sucursal_id': this.values.sucursal_id,
                'lista_id': this.lista.id,
                'asignacion_id':this.asignacion.id
            }).then(response => {
                this.editFabricantes = response.data;
            });
        },
        handleGetUsuarios() {
            axios.get('/api/almacen/get/usuarios/'+this.lista.id).then(response => {
                this.usuarios = response.data;
            });
        },
        handleGetListas() {
            this.loading.listas = true;
            axios.post('/api/almacen/get/listas', {
                'usuario_id': this.values.usuario_id
            }).then(response => {
                this.listas = response.data;
                this.loading.listas = false;
            });
        },
        handleCreateList() {
            $('#createList').modal('show');
        },
        handleStoreList() {
            this.$refs['createListForm'].validate((valid) => {
                if (valid) {
                    this.createList.USUARIO_ID = this.values.usuario_id
                    axios.post('/api/almacen/store/lista', this.createList).then(response => {
                        this.handleGetListas();
                        $('#createList').modal('hide');
                        this.$notify.success({
                            title: '! Exito !',
                            message: 'Se creo el registro',
                            offset: 100,
                            duration: 2000
                        });
                    });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handleDeleteList(index, row) {
            this.$confirm('¿ Eliminar lista ?', 'Eliminar', {
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                type: 'warning',
                roundButton:true
            }).then(() => {
                axios.delete('/api/almacen/delete/lista/' + row.id).then(response => {
                    this.handleGetListas();
                    this.$notify.success({
                        title: '! Exito !',
                        message: 'Se elimino el registro',
                        offset: 100,
                        duration: 2000
                    });
                });
            }).catch(() => {});
        },
        handleEditList(index, row) {
            $('#editList').modal('show');
            this.editList.LISTA_ID = row.id
            this.editList.NOMBRE = row.NOMBRE
            this.editList.DESCRIPCION = row.DESCRIPCION
        },
        handleUpdateList() {
            this.$refs['editListForm'].validate((valid) => {
                if (valid) {
                    this.editList.USUARIO_ID = this.values.usuario_id
                    axios.post('/api/almacen/update/lista', this.editList).then(response => {
                        this.handleGetListas();
                        $('#editList').modal('hide');
                        this.$notify.success({
                            title: '! Exito !',
                            message: 'Se actualizo el registro',
                            offset: 100,
                            duration: 2000
                        });
                    });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handleShowList(index, row) {
            this.lista = row;
            this.show.listas = false;
            this.show.articulos = true;
            this.handleGetUsuarios();
            this.handleGetFabricantes();
            this.handleGetArticulos();
            this.handleGetAsignacion();
        },
        handleBackList() {
            this.show.listas = true;
            this.show.articulos = false;
            this.articulos = [];
            this.asignaciones=[];
            this.fabricantes=[];
            this.usuarios=[];
            this.handleGetListas();
        },
        handleStoreAsignacion() {
            this.$refs['createAsignacionForm'].validate((valid) => {
                this.createAsignacion.LISTA_ID = this.lista.id;
                if (valid && this.createAsignacion.FABRICANTES.length > 0) {
                    axios.post('/api/almacen/store/asignacion', this.createAsignacion).then(response => {
                        this.show.error = false;
                        this.createAsignacion= {
                            FABRICANTES: [],
                            USUARIO: '',
                            LISTA_ID: ''
                        };
                        this.handleGetAsignacion();
                        this.handleGetUsuarios();
                        this.handleGetFabricantes();
                        this.$notify.success({
                            title: '! Exito !',
                            message: 'Se elimino el registro',
                            offset: 100,
                            duration: 2000
                        });
                        this.$refs['createAsignacionForm'].resetFields();
                    });
                } else {
                    console.log('error submit!!');
                    if (this.createAsignacion.FABRICANTES.length > 0) {
                        this.show.error = false;
                    } else {
                        this.show.error = true;
                    }
                    return false;
                }
            });
        },
        handleCloseError() {
            this.show.error = false;
        },
        handleGetAsignacion() {
            axios.get('/api/almacen/get/asignacion/' + this.lista.id).then(response => {
                this.asignaciones = response.data;
            })
        },
        handleDeleteFabricante(id){
          this.$confirm('¿ Quitar asignacion ?', 'Eliminar', {
              confirmButtonText: 'Eliminar',
              cancelButtonText: 'Cancelar',
              type: 'warning',
              roundButton:true
          }).then(() => {
            axios.delete('/api/almacen/delete/fabricante/'+id).then(response=>{
                this.handleGetAsignacion();
                this.handleGetFabricantes();
                this.$notify.success({
                    title: '! Exito !',
                    message: 'Fabricante eliminado',
                    offset: 100,
                    duration: 2000
                });
            });
          }).catch(() => {});
        },
        handleEditAsignacion(asignacion){
          $('#editAsignacion').modal('show');
          this.asignacion=asignacion;
          this.editAsignacion.FABRICANTES=[];
          for (var i = 0; i < asignacion.fabricantes.length; i++) {
            this.editAsignacion.FABRICANTES[i]=asignacion.fabricantes[i].COD_FABRICANTE;
          }
          this.handleGetEditFabricantes();
        },
        handleDeleteAsignacion(){
          this.$confirm('¿ Elminar asignacion ?', 'Eliminar', {
              confirmButtonText: 'Eliminar',
              cancelButtonText: 'Cancelar',
              type: 'warning',
              roundButton:true
          }).then(() => {
            axios.delete('/api/almacen/delete/asignacion/'+this.asignacion.id).then(response=>{
                this.handleGetAsignacion();
                this.handleGetFabricantes();
                this.handleGetUsuarios();
                this.$notify.success({
                    title: '! Exito !',
                    message: 'Asignación Eliminada',
                    offset: 100,
                    duration: 2000
                });
                $('#editAsignacion').modal('hide');
            });
          }).catch(() => {});
        },
        handleUpdateAsignacion(){
          this.editAsignacion.ASIGNACION_ID=this.asignacion.id;
          this.$confirm('¿ Actualizar asignación ?', 'Eliminar', {
              confirmButtonText: 'Actualizar',
              cancelButtonText: 'Cancelar',
              type: 'warning',
              roundButton:true
          }).then(() => {
            axios.post('/api/almacen/update/asignacion',this.editAsignacion).then(response=>{
                this.handleGetAsignacion();
                this.handleGetFabricantes();
                this.$notify.success({
                    title: '! Exito !',
                    message: 'Asignación Actualizada',
                    offset: 100,
                    duration: 2000
                });
                $('#editAsignacion').modal('hide');
            });
          }).catch(() => {});
        },
        handleExportArticulos(){
            this.$confirm('¿ Exportar Lista ?', 'Exportar', {
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                type: 'warning',
                roundButton:true
              }).then(() => {
                var name = this.lista.NOMBRE+'.xlsx';
                var url = '/api/almacen/export/excel';
                axios({
                    url: url,
                    method: 'POST',
                    responseType: 'blob'
                }).then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', name); //or any other extension
                    document.body.appendChild(link);
                    link.click();
                });
              }).catch(() => {});
        }
    }
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');
