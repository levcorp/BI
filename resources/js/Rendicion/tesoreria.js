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
                  desembolso:false
              },
              values:{
                  sucursal_id:'',
                  usuario_id:'',
              },
              data:{
                solicitudes:{
                  procesamiento:[],
                  desembolsado:[]
                },
                autorizado:[],
                banco:[],
                solicitud:[],
                solicitado:[],
                desembolso:{
                  FECHA_DESEMBOLSO_TESORERIA:'',
                  id:null
                }
              },
              loading:false,
            }
    },
    mounted(){
      this.handleGetRendicionesSolicitudProcesamiento()
      this.handleGetRendicionesSolicitudDesembolsado()
    },
    methods: {
      handleCommandSolicitudProcesada(command){
        switch (command.type) {
          case 'desembolso':
            this.handleDesembolsoSolicitud(command.solicitud)
          break;
          case 'reporte':
            this.handleReporteSolicitud(command.solicitud)
          break;
          case 'show':
            this.handleShowSolicitud(command.solicitud)
          break;
        }
      },
      handleCommandSolicitudDesembolsado(command){
        switch (command.type) {
          case 'reporte':
            this.handleReporteSolicitud(command.solicitud)
          break;
          case 'show':
            this.handleShowSolicitud(command.solicitud)
          break;
        }
      },
      handleGetRendicionesSolicitudProcesamiento(){
          var url='/api/rendicion/solicitudes/procesamiento'
          axios.get(url).then(response=>{
            this.data.solicitudes.procesamiento=response.data
        })
      },
      handleGetRendicionesSolicitudDesembolsado(){
          var url='/api/rendicion/solicitudes/desembolsado'
          axios.get(url).then(response=>{
            this.data.solicitudes.desembolsado=response.data
        })
      },
      handleShowSolicitud(row){
        this.data.solicitud=row
        this.data.banco=row.banco
        this.data.solicitado=row.solicitado
        this.data.autorizado=row.autorizado
        $('#show').modal('show')
      },
      handleDesembolsoSolicitud(row){
        this.show.desembolso=true;
        this.data.desembolso.id=row.id
      },
      handlePostDesembolsoSolicitud(){
        this.$confirm('¿ Esta seguro de Autorizar la Solicitud ?', 'Advertencia', {
          confirmButtonText: 'Autorizar',
          cancelButtonText: 'Cancelar',
          type: 'warning'
        }).then(() => {
          var url='/api/rendicion/solicitudes/desembolso'
          axios.post(url,this.data.desembolso).then(response=>{
            this.show.desembolso=false
            this.handleGetRendicionesSolicitudDesembolsado()
            this.handleGetRendicionesSolicitudProcesamiento()
            this.$message({
              type: 'success',
              message: 'Se aprobo el desembolso la Solicitud'
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
                label:writtenNumber(row.IMPORTE_SOLICITADO)
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
