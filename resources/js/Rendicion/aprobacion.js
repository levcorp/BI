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
              pickerOptions: {
                disabledDate(time) {
                  const date = new Date()
                  return time.getTime() < date.setTime(date.getTime() - 3600 * 1000 * 24)
                },
              },
              show:{
                  autorizacion:false,
                  rechazo:false
              },
              values:{
                  sucursal_id:'',
                  usuario_id:'',
              },
              data:{
                solicitudes:{
                  autorizado:[],
                  noautorizado:[]
                },
                solicitud:[],
                banco:{
                  Nombre:''
                },
                autorizado:[],
                solicitado:[],
                tiposolicitud:[],
                centrocostos:[],
                rechazo:{
                  RECHAZO:'',
                  id:null
                }
              },
              loading:false,
            }
    },
    mounted(){
      this.handleGetRendicionesSolicitudAutorizado()
      this.handleGetRendicionesSolicitudNoAutorizado()
    },
    methods: {
      handleCommandSolicitudNoAutorizado(command){
        switch (command.type) {
          case 'autorizar':
            this.handleAutorizarSolicitud(command.solicitud)
          break;
          case 'rechazar':
            this.handleRechazoSolicitud(command.solicitud)
          break;
          case 'show':
            this.handleShowSolicitud(command.solicitud)
          break;
        }
      },
      handleCommandSolicitudAutorizado(command){
        switch (command.type) {
          case 'reporte':
            this.handleReporteSolicitud(command.solicitud)
          break;
          case 'show':
            this.handleShowSolicitud(command.solicitud)
          break;
        }
      },
      handleGetRendicionesSolicitudAutorizado(){
          var url='/api/rendicion/solicitudes/autorizado/'+this.values.usuario_id
          axios.get(url).then(response=>{
            this.data.solicitudes.autorizado=response.data
        })
      },
      handleGetRendicionesSolicitudNoAutorizado(){
          var url='/api/rendicion/solicitudes/noautorizado/'+this.values.usuario_id
          axios.get(url).then(response=>{
            this.data.solicitudes.noautorizado=response.data
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
      handleRechazoSolicitud(row){
        this.show.rechazo=true;
        this.data.rechazo.id=row.id
      },
      handlePostRechazoSolicitud(){
        var url='/api/rendicion/solicitudes/rechazar'
        axios.post(url,this.data.rechazo).then(response=>{
          this.handleGetRendicionesSolicitudNoAutorizado()
          this.handleGetRendicionesSolicitudAutorizado()
          this.show.rechazo=false;
          this.$message({
              type: 'success',
              message: 'La solicitud fue rechazada'
            });
        })
      },
      handleAutorizarSolicitud(row){
        this.$confirm('¿ Esta seguro de Autorizar la Solicitud ?', 'Advertencia', {
          confirmButtonText: 'Autorizar',
          cancelButtonText: 'Cancelar',
          type: 'warning'
        }).then(() => {
          var url='/api/rendicion/solicitudes/autorizar'
          axios.post(url,{
            id:row.id
          }).then(response=>{
            this.handleGetRendicionesSolicitudAutorizado()
            this.handleGetRendicionesSolicitudNoAutorizado()
            this.$message({
              type: 'success',
              message: 'Se autorizo la Solicitud'
            });
          })
        })
      },
      handleReporteSolicitud(row){
          this.loading=true
          var urlApi = '/api/rendicion/solicitud/pdf';
          axios({
              url: urlApi,
              method: 'POST',
              responseType: 'blob', // important
              data:{
                id:row.id,
                label:writtenNumber(parseInt(row.IMPORTE_SOLICITADO)),
                decimal:parseInt((row.IMPORTE_SOLICITADO - Math.floor(row.IMPORTE_SOLICITADO))*100)
              }
          }).then(response => {
              const url = window.URL.createObjectURL(new Blob([response.data]));
              const link = document.createElement('a');
              link.href = url;
              link.setAttribute('download','SolicitudFondos.pdf'); //or any other extension
              document.body.appendChild(link);
              link.click();
              this.loading=false;
              this.$message({
                  message: 'Se descargo el archivo ' ,
                  type: 'success'
              });
              this.loading=false
          });
      }
    }
})
