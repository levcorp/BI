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
          salida:null,
          estado:{
            entrada:null,
            almuerzo:null,
            regreso:null,
            salida:null,
          },
          asistencia:{
            fecha1:null,
            fecha2:null
          },
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
      this.handleGetEstado()
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
           this.handleGetEstado()
           this.$message({
             type: 'success',
             message: response.data
           });
         })
       }).catch(() => {
       });
     },
     handleGetIP(){
       axios.get('https://api.ipify.org?format=json').then(response=>{
         this.registro.ip=response.data.ip
       })
     },
     handleGetRegistro(){
       var entrada='api/asistencia/get/historial/E/'+this.registro.usuario_id
       var almuerzo='api/asistencia/get/historial/A/'+this.registro.usuario_id
       var regreso='api/asistencia/get/historial/R/'+this.registro.usuario_id
       var salida='api/asistencia/get/historial/S/'+this.registro.usuario_id
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
     },
     handleGetEstado(){
       var entrada='api/asistencia/get/estado/E/'+this.registro.usuario_id
       var almuerzo='api/asistencia/get/estado/A/'+this.registro.usuario_id
       var regreso='api/asistencia/get/estado/R/'+this.registro.usuario_id
       var salida='api/asistencia/get/estado/S/'+this.registro.usuario_id
       axios.get(entrada).then(response=>{
         this.estado.entrada=response.data
       })
       axios.get(almuerzo).then(response=>{
         this.estado.almuerzo=response.data
       })
       axios.get(regreso).then(response=>{
         this.estado.regreso=response.data
       })
       axios.get(salida).then(response=>{
         this.estado.salida=response.data
       })
     },
     handleGetReporte(){
       var urlApi = 'api/asistencia/get/reporte';
       axios({
           url: urlApi,
           method: 'POST',
           data:{
             fecha1:this.asistencia.fecha1,
             fecha2:this.asistencia.fecha2
           },
           responseType: 'blob', // important
       }).then(response => {
           const url = window.URL.createObjectURL(new Blob([response.data]));
           const link = document.createElement('a');
           link.href = url;
           link.setAttribute('download','Asistencia'+this.asistencia.fecha1+'a'+this.asistencia.fecha2+'.xlsx'); //or any other extension
           document.body.appendChild(link);
           link.click();
           this.$message({
               message: 'Se descargo el archivo ',
               type: 'success'
           });
       });
     }
    }
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');
