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
          time: '',
          registro:{
            usuario_id:null,
            ip:null,
            tipo:null
          },
          entrada:null,
          almuerzo:null,
          regreso:null,
          salida:null
        }
    },
    watch: {
      time:function(newValue,OldValue){
        var timerID = setInterval(this.handleUpdateTime, 1000);
        this.handleUpdateTime();
      }
    },
    mounted() {
      this.handleUpdateTime()
      this.handleGetIP()
      this.handleGetRegistro()
    },
    methods: {
      handleZeroPadding(num, digit) {
          var zero = '';
          for(var i = 0; i < digit; i++) {
              zero += '0';
          }
          return (zero + num).slice(-digit);
      },
      handleUpdateTime() {
          var cd = new Date();
          this.time = this.handleZeroPadding(cd.getHours(), 2) + ':' + this.handleZeroPadding(cd.getMinutes(), 2) + ':' + this.handleZeroPadding(cd.getSeconds(), 2);
      },
      handleStoreMarca(tipo){
        this.registro.tipo=tipo
        this.$confirm('Esta seguro de realizar el registro ?', 'Confirmar', {
         confirmButtonText: 'Aceptar',
         cancelButtonText: 'Cancelar',
         type: 'warning'
       }).then(() => {
         var url='api/asistencia/post/registro'
         axios.post(url,this.registro).then(response=>{
           this.handleGetRegistro()
         })
         this.$message({
           type: 'success',
           message: 'Se registro la hora y fecha'
         });
       }).catch(() => {
       });
     },
     handleGetIP(){
       axios.get('https://api.ipify.org?format=json').then(response=>{
         this.registro.ip=response.data.ip
       })
     },
     handleGetRegistro(){
       var entrada='api/asistencia/get/historial/E'
       var almuerzo='api/asistencia/get/historial/A'
       var regreso='api/asistencia/get/historial/R'
       var salida='api/asistencia/get/historial/S'
       axios.get(entrada).then(response=>{
         this.entrada=response.data
       })
       axios.get(almuerzo).then(response=>{
         this.almuerzo=response.data
       })
       axios.get(regreso).then(response=>{
         this.regreso=response.data
       })
       axios.get(salida).then(response=>{
         this.salida=response.data
       })
     }
    }
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');
