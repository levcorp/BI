import Vue from 'vue'
import Vuesax from 'vuesax'
import axios from 'axios'
import 'vuesax/dist/vuesax.css' //Vuesax styles
import 'boxicons'
const moment = require('moment')
Vue.use(require('vue-moment'), {
    moment
});
Vue.use(Vuesax)
new Vue({
    el:'#app',
    data() {
        return {
          values:{
              sucursal_id:null,
              usuario_id:null,
              literal:null,
              objectguid:null,
              cuenta:null,
              decimal:null,
          },
          data:{
            solicitudes:[],
            solicitud:null
          },
          view:{
            solicitudes:true,
            detalle:false
          },
          active: 0
        }
    },
    mounted() {
      this.handleGetSolicitudesUsuario()
    },
    methods: {
      handleGetSolicitudesUsuario(){
          var url='/api/rendicion/solicitudes/usuario/'+this.values.usuario_id
          axios.get(url).then(response=>{
            this.data.solicitudes=response.data
          })
      },
      handleShowDetalle(){
        if ( this.view.solicitudes) {
          this.view.solicitudes=false
          this.view.detalle=true
        }else{
          this.view.solicitudes=true
          this.view.detalle=false
        }
      }
    }
})
