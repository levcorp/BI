import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import Vue2Filters from 'vue2-filters'
import VueMoment from 'vue-moment';
const moment = require('moment')
require('moment/locale/es')
Vue.use(require('vue-moment'), {
    moment
});
Vue.use(Vue2Filters)
locale.use(lang);
Vue.use(ElementUI);
var writtenNumber = require('written-number');
writtenNumber.defaults.lang = 'es';
new Vue({
    el:'#app',
    data(){
        return {
              show:{
                  rendicion:false,
                  index:true,
                  rechazo:false,
                  aprobar:false
              },
              values:{
                  sucursal_id:'',
                  usuario_id:'',
              },
              data:{
                tiposolicitud:[],
                centrocostos:[],
                rendiciones:{
                  autorizado:[],
                  noautorizado:[]
                },
                solicitud:{
                },
                banco:[],
                solicitado:{
                  cargo:'',
                },
                autorizado:{
                  cargo:'',
                },
                rendicion:[],
                centrocostos:[],
                viaticos:[],
                rechazo:{
                  RECHAZO:'',
                  id:null
                },
                cuentas:[],
                aprobacion:{
                  cuenta:null,
                  fecha:null,
                  id:null
                }
              },
              loading:false,
            }
    },
    mounted(){
      this.handleGetRendicionesFinalizadaAutorizado()
      this.handleGetRendicionesFinalizadaNoAutorizado()
      this.handleGetCuentaContable()
    },
    methods: {
      handleCommandSolicitudNoAprobada(command){
        switch (command.type) {
          case 'show':
            this.handleShowSolicitud(command.solicitud)
          break;
          case 'detalle':
            this.handleRendicionViaticos(command.solicitud)
          break;
        }
      },
      handleCommandSolicitudAprobada(command){
        switch (command.type) {
          case 'reporte':
            this.handleReporteSolicitud(command.solicitud)
          break;
          case 'show':
            this.handleShowSolicitud(command.solicitud)
          break;
        }
      },
      handleGetRendicionesFinalizadaAutorizado(){
          var url='/api/rendicion/get/finalizada/autorizados/'+this.values.usuario_id
          axios.get(url).then(response=>{
            this.data.rendiciones.autorizado=response.data
        })
      },
      handleGetRendicionesFinalizadaNoAutorizado(){
          var url='/api/rendicion/get/finalizada/noautorizados/'+this.values.usuario_id
          axios.get(url).then(response=>{
            this.data.rendiciones.noautorizado=response.data
        })
      },
      handleShowSolicitud(row){
        this.data.solicitud=row
        this.data.banco=row.banco
        this.data.solicitado=row.solicitado
        this.data.autorizado=row.autorizado
        this.data.centrocostos=row.centrocostos
        this.data.tiposolicitud=row.tiposolicitud
        $('#show').modal('show')
      },
      handleRechazoSolicitud(index,row){
        this.show.rechazo=true
        this.data.rechazo.id=this.data.rendicion.id
      },
      handlePostRechazoSolicitud(){
        var url='/api/rendicion/get/finalizada/rechazar'
        axios.post(url,this.data.rechazo).then(response=>{
          this.handleGetRendicionesFinalizadaAutorizado()
          this.handleGetRendicionesFinalizadaNoAutorizado()
          this.show.rechazo=false;
          this.$message({
              type: 'success',
              message: 'La rendicion fue rechazada'
            });
          this.show.rendicion=false
          this.show.index=true
        })
      },
      handleGetCuentaContable(){
        var url='/api/rendicion/get/finalizada/cuenta'
        axios.get(url).then(response=>{
          this.data.cuentas=response.data
        })
      },
      handleAprobarSolicitud(index,row){
        this.show.aprobar=true
        this.data.aprobacion.id=this.data.rendicion.id
      },
      handlePostAprobarSolicitud(index,row){
        this.$confirm('¿ Esta seguro de Autorizar la Solicitud ?', 'Advertencia', {
          confirmButtonText: 'Autorizar',
          cancelButtonText: 'Cancelar',
          type: 'warning'
        }).then(() => {
          this.show.aprobar=false;
          var url='/api/rendicion/get/finalizada/probar'
          axios.post(url,this.data.aprobacion).then(response=>{
            this.handleGetRendicionesFinalizadaAutorizado()
            this.handleGetRendicionesFinalizadaNoAutorizado()
            this.$message({
              type: 'success',
              message: 'Se Aprobo y cargo la solicitud la Solicitud'
            });
            this.show.rendicion=false
            this.show.index=true
          })
        })
      },
      handleRendicionViaticos(row){
        this.show.rendicion=true
        this.show.index=false
        this.data.rendicion=row
        this.data.centrocostos.NOMBRE=row.centrocostos.NOMBRE
        this.handleGetViaticoDetalle()
      },
      handleGetViaticoDetalle(){
        var url="/api/rendicion/viaticos/detalle/"+this.data.rendicion.id
        axios.get(url).then(response=>{
          this.data.viaticos=response.data
        })
      },
      handleBackIndex2(){
        this.show.rendicion=false
        this.show.index=true
      },
      handleReporteSolicitud(row){
          this.loading=true
          var urlApi = '/api/rendicion/get/finalizada/reporte/'+row.id;
          axios({
              url: urlApi,
              method: 'GET',
              responseType: 'blob' // important
          }).then(response => {
              const url = window.URL.createObjectURL(new Blob([response.data]));
              const link = document.createElement('a');
              link.href = url;
              link.setAttribute('download','RendicionDeFondos.pdf'); //or any other extension
              document.body.appendChild(link);
              link.click();
              this.loading=false;
              this.$message({
                  message: 'Se descargo el archivo ' ,
                  type: 'success'
              });
          });
      },
    }
})
