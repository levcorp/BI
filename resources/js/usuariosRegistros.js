import Vue from 'vue';
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
          usuarios:[],
          tolerancias:[],
          search:'',
          tolerancia:{
            titulo:null,
            hora:null
          },
          asignacion:{
            usuario_id:null,
            tolerancia_id:null
          }
        }
    },
    mounted() {
      this.handleGetData()
      this.handleGetTipoRegistros();
    },
    methods: {
        handleGetData() {
          var url = '/api/asistencia/get/usuario';
          axios.get(url).then(response => {
              this.usuarios = response.data;
          });
        },
        handleGetTipoRegistros(){
          var url = '/api/asistencia/tolerancia';
          axios.get(url).then(response => {
              this.tolerancias = response.data;
          });
        },
        handleRemoveTolerancia(index,row){
          this.$confirm('Esta seguro de elminar el registro', 'Confirmar', {
           confirmButtonText: 'Aceptar',
           cancelButtonText: 'Cancelar',
           type: 'warning'
         }).then(() => {
           var url = '/api/asistencia/delete/tolerancia/'+row.id;
           axios.delete(url).then(response => {
             this.handleGetTipoRegistros();
             this.$message({
                 message: 'El registro fue eliminado',
                 type: 'success'
             });
           });
         }).catch(() => {
         });
        },
        handleShowTolerancias(){
          $('#list').modal('show');
        },
        handleShowCreateTolerancia(){
          $('#create').modal('show');
        },
        handleStoreTolerancia(){
          var url = '/api/asistencia/post/tolerancia'
          axios.post(url,this.tolerancia).then(response => {
            this.handleGetTipoRegistros()
            this.$message({
                message: 'El registro fue creado exitosamente',
                type: 'success'
            });
            this.tolerancia.titulo=null
            this.tolerancia.hora=null
            $('#create').modal('hide');
            $('#list').modal('show');
          });
        },
        handleShowAsignarTolerancia(index,row){
          $('#asignar').modal('show');
          this.asignacion.usuario_id=row.id
        },
        handleStoreAsignacion(){
          var url = '/api/asistencia/post/asignacion';
          axios.post(url,this.asignacion).then(response => {
            this.handleGetData()
            this.$message({
                message: 'El asignaciòn fue realizada exitosamente',
                type: 'success'
            });
            $('#asignar').modal('hide');
          });
        }
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');
