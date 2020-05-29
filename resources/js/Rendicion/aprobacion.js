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
                  autorizacion:false
              },
              values:{
                  sucursal_id:'',
                  usuario_id:'',
              },
              data:{
                solicitudes:{
                  aprobado:[],
                  noaprobado:[]
                },
                solicitud:[],
                banco:[],
                autorizado:[],
                solicitado:[],
                autorizacion:{
                  FECHA_AUTORIZACION:null,
                  id:null
                }
              },
              loading:false,
            }
    },
    mounted(){
      this.handleGetRendicionesSolicitudAprobado()
      this.handleGetRendicionesSolicitudNoAprobado()
    },
    methods: {
      handleGetRendicionesSolicitudAprobado(){
          var url='/api/rendicion/solicitudes/aprobado'
          axios.get(url).then(response=>{
            this.data.solicitudes.aprobado=response.data
        })
      },
      handleGetRendicionesSolicitudNoAprobado(){
          var url='/api/rendicion/solicitudes/noaprobado'
          axios.get(url).then(response=>{
            this.data.solicitudes.noaprobado=response.data
        })
      },
      handleShowSolicitud(index,row){
        this.data.solicitud=row
        this.data.banco=row.banco
        this.data.solicitado=row.solicitado
        this.data.autorizado=row.autorizado
        $('#show').modal('show')
      },
      handleAprobarRendicionesSolicitud(index,row){
        this.show.autorizacion=true;
        this.data.autorizacion.id=row.id
      },
      handlePostAprobarSolicitud(){
        var url='/api/rendicion/solicitudes/aprobar'
        axios.post(url,this.data.autorizacion).then(response=>{
          this.handleGetRendicionesSolicitudAprobado()
          this.handleGetRendicionesSolicitudNoAprobado()
          this.show.autorizacion=false;
          this.$message({
              type: 'success',
              message: 'La solicitud se aprobo correctamente'
            });
        })
      },
      handleReporteSolicitud(index,row){
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
              this.loading=true
          });
      }
    }
})
