import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
locale.use(lang);
Vue.use(ElementUI);
import vSelect from 'vue-select'

Vue.component('v-select', vSelect)
new Vue({
    el:'#app',
    data() {
        return {
          time: '',
          registro:{
            usuario_id:null,
            ip:null,
            tipo:null
          },
          show:{
            LCV:false
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
          form:{},
          data:{
            usuario:[],
            usuarios:[],
            buenTrabajo:[
              'Reconocer el esfuerzo independientemente de los resultados',
              'Reconocer un comportamiento, compromiso y actitud positivos',
              'Reconocer a la persona que cree espacios de opinión y comunicación abierta',
            ],
            esfuerzoExtra:[
              'Reconocer a la persona que apoya a otras áreas sin esperar nada a cambio',
              'Reconocer a la persona que propone mejoras y cambios (actividades, alegría, procesos, etc.)',
            ],
            opcionesMotivo:[]
          },
          lcv:{
            beneficiario_id:null,
            monto:'100',
            motivo:null,
            opcion:null,
            emisor_id:null,
          }
        }
    },
    watch: {
      time:function(newValue,OldValue){
        var timerID = setInterval(this.handleUpdateTime, 1000);
        this.handleUpdateTime();
      },
      'lcv.motivo':function(newValue,OldValue){
        if(newValue=='Buen Trabajo'){
          this.data.opcionesMotivo=this.data.buenTrabajo
          this.lcv.opcion=null
        }else{
          if(newValue=='Esfuerzo extra'){
            this.data.opcionesMotivo=this.data.esfuerzoExtra
            this.lcv.opcion=null
          }
        }
      }
    },
    mounted() {
      this.handleUpdateTime()
      this.handleGetIP()
      this.handleGetRegistro()
      this.handleGetEstado()
      this.handleGetUsuarioLCV()
      this.handleGetUsuario()
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
     },
     handleGetReporteLCV(){
       var urlApi = 'api/lcv/get/reporte';
       axios({
           url: urlApi,
           method: 'GET',
           responseType: 'blob', // important
       }).then(response => {
           const url = window.URL.createObjectURL(new Blob([response.data]));
           const link = document.createElement('a');
           link.href = url;
           link.setAttribute('download','ReporteLCV.xlsx'); //or any other extension
           document.body.appendChild(link);
           link.click();
           this.$message({
               message: 'Se descargo el archivo ',
               type: 'success'
           });
       });
     },
     handleShowDonarLCV(){
       this.show.LCV=true
     },
     handleGetUsuarioLCV(){
       var url = "/api/lcv/get/usuarios/"+this.registro.usuario_id;
       axios.get(url).then(response => {
           this.data.usuarios = response.data;
           this.data.usuarios = response.data.map(item => {
              return { value: `${item.id}`, label:`${item.nombre} ${item.apellido}` };
          });
       })
     },
     handleGetUsuario(){
       var url = "/api/lcv/get/usuario/"+this.registro.usuario_id;
       axios.get(url).then(response => {
           this.data.usuario = response.data;
       })
     },
     handleStoreLCV(){
       this.lcv.emisor_id=this.registro.usuario_id
       var url = "/api/lcv/store/lcv"
       axios.post(url,this.lcv).then(response => {
           this.handleGetUsuario()
           this.show.LCV=false
       })
     }
    }
})
