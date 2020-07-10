import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import Vue2Filters from 'vue2-filters'
import VueMoment from 'vue-moment';
import VueQrcodeReader from "vue-qrcode-reader";

const moment = require('moment')
require('moment/locale/es')
Vue.use(VueQrcodeReader);
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
          result: '',
          error: '',
          factura:{
              NIT_Emisor:'',
              Numero_Factura:'',
              Numero_Autorizacion:'',
              Fecha_Emision:'',
              Total:'',
              Importe_Credito_Fiscal:'',
              Codigo_Control:'',
              NIT_Comprador:'',
              Importe_ICE:'',
              Importe_Ventas:'',
              Importe_No_Sujeto:'',
              Descuentos:'',
              Descripcion:'',
              id:'',
              Centro_Costos:null
          },
            show:{
                create:false,
                index:true,
                abono:true,
                edit:false,
                rendicion:false,
                success:false,
                camara:true,
                factura:true,
                facturas:false,
                descripcion:false,
                cuenta:false,
                cuentaEdit:false,
                conIVA:false,
                sinIVA:true,
                costos:false
            },
            values:{
                sucursal_id:'',
                usuario_id:'',
                literal:'',
                objectguid:'',
                cuenta:''
            },
            solicitud:{
                FECHA_SOLICITUD:new Date(),
                FECHA_DESEMBOLSO:new Date(),
                DESCRIPCION:null,
                IMPORTE_SOLICITADO:null,
                SOLICITADO_ID:null,
                AUTORIZADO_ID:null,
                COMENTARIOS:null,
                MOTIVO:null,
                MEDIO_PAGO:'Abono Cuenta Bancaria',
                CUENTA:null,
                BANCO_ID:null,
                SUCURSAL:null,
                ESTADO:null,
                URGENTE:false,
                TIPO_SOLICITUD_ID:null,
                CENTRO_COSTOS_ID:null,
                PRESUPUESTO:false,
            },
            data:{
                usuarios:[],
                medio:[
                    {
                        value:'Abono Cuenta Bancaria',
                        label:'Abono Cuenta Bancaria'
                    },
                    {
                        value:'Cheque',
                        label:'Cheque'
                    }
                ],
                usuario:[],
                bancos:[],
                solicitudes:{
                  aprobado:[],
                  noaprobado:[],
                  rechazado:[],
                },
                solicitud:[],
                banco:[],
                solicitado:[],
                autorizado:[],
                solicitudEdit:{
                  FECHA_DESEMBOLSO:null,
                  PRESUPUESTO:null
                },
                rendicion:{
                  centrocostos:{
                    NOMBRE:null
                  },
                  tiposolicitud:{
                    NOMBRE:null
                  }
                },
                viaticos:[],
                tipoSolicitud:[],
                centroCostos:[],
                centroCostosRendicion:[],
                opciones_manual: [
                    {
                      value: 'Sin IVA',
                      label: 'Sin IVA'
                    },
                    {
                      value: 'Con IVA',
                      label: 'Con IVA'
                    }
                ],
                facturaManual:{
                  tipo:'Sin IVA',
                  NIT_Emisor:null,
                  Numero_Factura:null,
                  Numero_Autorizacion:null,
                  Fecha_Emision:null,
                  Total:null,
                  Descripcion:null,
                  CENTRO_COSTOS_ID:null,
                  Codigo_Control:null,
                  id:null,
                },
                centrocostos:{
                  NOMBRE:null
                },
            },
            loading:false,
            errors:[],
            values:[],
        }
    },
    mounted () {
        this.handleGetUsuarios()
        this.handleGetUsuario()
        this.handleGetBancosRendicion()
        this.handleGetRendicionesSolicitudAprobado()
        this.handleGetRendicionesSolicitudNoAprobado()
        this.handleGetRendicionesSolicitudRechazado()
        this.handleGetDateMore()
        this.handleGetTipoSolicitud()
    },
    watch: {
        'data.facturaManual.tipo':function(newValue, oldValue){
            if(newValue=='Con IVA'){
              this.show.conIVA=true
              this.show.sinIVA=false
              this.handleVaciarCamposFacturaManual()
            }else{
              this.show.conIVA=false
              this.show.sinIVA=true
              this.handleVaciarCamposFacturaManual()
            }
        },
        'solicitud.IMPORTE_SOLICITADO' :function(newValue, oldValue) {
            this.values.literal=writtenNumber(newValue)
        },
        'data.solicitudEdit.IMPORTE_SOLICITADO' :function(newValue, oldValue) {
            this.values.literal=writtenNumber(newValue)
        },
        'solicitud.MEDIO_PAGO' :function(newValue, oldValue) {
            if(newValue=='Abono Cuenta Bancaria')
            {
                this.show.abono=true
            }else{
                this.show.abono=false
            }
        },
        'solicitud.BANCO_ID' :function(newValue, oldValue) {
            if(newValue=='1' || newValue==1)
            {
                this.solicitud.CUENTA=this.values.cuenta
                this.show.cuenta=true
            }else{
                this.solicitud.CUENTA=null
                this.show.cuenta=false
            }
        },
        'data.solicitudEdit.BANCO_ID' :function(newValue, oldValue) {
            if(newValue=='1' || newValue==1)
            {
                this.data.solicitudEdit.CUENTA=this.values.cuenta
                this.show.cuentaEdit=true
            }else{
                this.data.solicitudEdit.CUENTA=null
                this.show.cuentaEdit=false
            }
        },
        'solicitud.TIPO_SOLICITUD_ID' :function(newValue, oldValue) {
            this.handleGetCentroCostos(newValue)
            this.solicitud.CENTRO_COSTOS_ID=null
        },
        'data.solicitudEdit.TIPO_SOLICITUD_ID' :function(newValue, oldValue) {
            this.handleGetCentroCostos(newValue)
            this.data.solicitudEdit.CENTRO_COSTOS_ID=null
        },
        'solicitud.URGENTE' :function(newValue, oldValue) {
            if(!newValue)
            {
              var dias =2;
              this.solicitud.FECHA_DESEMBOLSO=new Date()
              this.solicitud.FECHA_DESEMBOLSO=this.solicitud.FECHA_DESEMBOLSO.setDate(this.solicitud.FECHA_DESEMBOLSO.getDate()+parseInt(dias));
            }
        },
        'data.solicitudEdit.URGENTE' :function(newValue, oldValue) {
            if(!newValue)
            {
              var dias =2;
              this.data.solicitudEdit.FECHA_DESEMBOLSO=new Date()
              this.data.solicitudEdit.FECHA_DESEMBOLSO=this.data.solicitudEdit.FECHA_DESEMBOLSO.setDate(this.data.solicitudEdit.FECHA_DESEMBOLSO.getDate()+parseInt(dias));
            }
        }
    },
    methods: {
        handleVaciarCamposFacturaManual(){
          this.data.facturaManual.NIT_Emisor=null
          this.data.facturaManual.Numero_Factura=null
          this.data.facturaManual.Numero_Autorizacion=null
          this.data.facturaManual.Codigo_Control=null
          this.data.facturaManual.Fecha_Emision=null
          this.data.facturaManual.Total=null
          this.data.facturaManual.Descripcion=null
          this.data.facturaManual.CENTRO_COSTOS_ID=null
        },
        handleGetDateMore(){
          var dias =2;
          this.solicitud.FECHA_DESEMBOLSO.setDate(this.solicitud.FECHA_DESEMBOLSO.getDate()+parseInt(dias));
        },
        handleShowSolicitud(index,row){
          var url='/api/rendicion/solicitud/get/'+row.id
          axios.get(url).then(response=>{
            this.data.solicitud=response.data
            this.data.banco=response.data.banco
            this.data.solicitado=response.data.solicitado
            this.data.autorizado=response.data.autorizado
            $('#show').modal('show')
          })
        },
        handleGetRendicionesSolicitudAprobado(){
            var url='/api/rendicion/solicitudes/usuario/aprobado/'+this.values.usuario_id
            axios.get(url).then(response=>{
              this.data.solicitudes.aprobado=response.data
            })
        },
        handleGetRendicionesSolicitudNoAprobado(){
            var url='/api/rendicion/solicitudes/usuario/noaprobado/'+this.values.usuario_id
            axios.get(url).then(response=>{
              this.data.solicitudes.noaprobado=response.data
            })
        },
        handleGetRendicionesSolicitudRechazado(){
            var url='/api/rendicion/solicitudes/usuario/rechazado/'+this.values.usuario_id
            axios.get(url).then(response=>{
              this.data.solicitudes.rechazado=response.data
            })
        },
        handleSentSolicitud(index,row){
            this.$confirm('¿ Esta seguro de enviar la Solicitud ?', 'Warning', {
              confirmButtonText: 'Enviar',
              cancelButtonText: 'Cancelar',
              type: 'warning'
            }).then(() => {
              var url='/api/rendicion/solicitudes/enviar'
              axios.post(url,{
                id:row.id
              }).then(response=>{
                this.handleGetRendicionesSolicitudAprobado();
                this.handleGetRendicionesSolicitudNoAprobado();
                this.handleGetRendicionesSolicitudRechazado();
                this.$message({
                  type: 'success',
                  message: 'Se envio la Solicitud'
                });
              })
            })
        },
        handleStoreRendicionSolicitud(){
            this.solicitud.SOLICITADO_ID=this.data.usuario.id
            var url='/api/rendicion/solicitud/store'
            axios.post(url,this.solicitud).then(response=>{
                this.handleGetRendicionesSolicitudAprobado();
                this.handleGetRendicionesSolicitudNoAprobado();
                this.handleGetRendicionesSolicitudRechazado();
                this.show.create=false
                this.show.index=true
                this.$notify.success({
                    title: '¡Creado con exito!',
                    message: 'La solicitud fue creada exitosamente',
                });
            })
        },
        handleGetUsuario(){
            var url='/api/rendicion/solicitud/usuario/'+this.values.usuario_id
            axios.get(url).then(response=>{
                this.data.usuario=response.data
            })
        },
        handleGetBancosRendicion(){
            var url='/api/rendicion/solicitud/bancos '
            axios.get(url).then(response=>{
                this.data.bancos=response.data
            })
        },
        handleCreateSolicitud() {
          this.show.create=true
          this.show.index=false
        },
        handleBackIndex(){
          this.show.create=false
          this.show.edit=false
          this.show.index=true
          this.show.rendicion=false
          this.handleGetRendicionesSolicitudAprobado();
          this.handleGetRendicionesSolicitudNoAprobado();
          this.handleGetRendicionesSolicitudRechazado();
        },
        handleEditSolicitud(index,row){
          this.show.edit=true
          this.show.index=false
          this.data.solicitudEdit=row
          this.data.solicitudEdit.TIPO_SOLICITUD_ID=null
          this.data.solicitudEdit.CENTRO_COSTOS_ID=null
          this.data.solicitudEdit.AUTORIZADO_ID=null
          this.data.solicitudEdit.BANCO_ID=null
          this.data.solicitudEdit.CUENTA=null
          if(row.URGENTE==1){
            this.data.solicitudEdit.URGENTE=true
          }else{
            this.data.solicitudEdit.URGENTE=false
          }
          if(row.PRESUPUESTO==1){
            this.data.solicitudEdit.PRESUPUESTO=true
          }else{
            this.data.solicitudEdit.PRESUPUESTO=false
          }
        },
        handleDeleteSolicitud(index,row){
          this.$confirm('Eliminar Solicitud ?', 'Warning', {
              confirmButtonText: 'Eliminar',
              cancelButtonText: 'Cancelar',
              type: 'warning'
            }).then(() => {
              var url='/api/rendicion/solicitud/delete/'+row.id
              axios.get(url).then(response=>{
                this.handleGetRendicionesSolicitudAprobado();
                this.handleGetRendicionesSolicitudNoAprobado();s
                this.$message({
                    type: 'success',
                    message: 'La solicitud se elimino correctamente'
                  });
              })
            }).catch(() => {
            });
        },
        handleGetUsuarios(){
            var url = "/api/tareas/users";
            axios.get(url).then(response => {
                this.data.usuarios = response.data;
            })
        },
        handleUpdateSolicitud(){
            var url='/api/rendicion/solicitud/update'
            axios.post(url,this.data.solicitudEdit).then(response=>{
              this.handleGetRendicionesSolicitudAprobado();
              this.handleGetRendicionesSolicitudNoAprobado();
              this.show.edit=false
              this.show.index=true
              this.$message({
                  type: 'success',
                  message: 'La solicitud se actualizo correctamente'
                });
            });
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
            });
        },
        handleRendicionViaticos(index,row){
          this.show.rendicion=true
          this.show.index=false
          this.data.rendicion=row
          this.data.centrocostos.NOMBRE=row.centrocostos.NOMBRE
          console.log(this.data.centrocostos.NOMBRE)
          this.handleGetViaticoDetalle()
          this.handleGetCentroCostosRendicion(this.data.rendicion.TIPO_SOLICITUD_ID)
        },
        handleRendicionFacturas(){
          this.show.rendicion=false
          this.show.facturas=true
          this.show.index=false
        },
        handleBackIndex2(){
          this.show.rendicion=false
          this.show.index=true
        },
        handleBackRendicion(){
          this.show.rendicion=true
          this.show.facturas=false
          this.show.index=false
        },
        handleDecode(result) {
            if(result){
                var values = result.split('|');
                this.values=values
                if(values.length==12){
                    if(values[7]!="296202021"){
                        this.errors.push("El NIT es distinto al de la empresa");
                    }
                    if(parseFloat(values[4])!=parseFloat(values[11])+parseFloat(values[5])){
                        this.errors.push("El Total no es igual a el IMPORTE CREDITO FISCAL + DESCUESTO/BONIFICACIONES");
                    }
                    this.factura.NIT_Emisor=values[0];
                    this.factura.Numero_Factura=values[1];
                    this.factura.Numero_Autorizacion=values[2];
                    this.factura.Fecha_Emision=values[3];
                    this.factura.Total=values[4];
                    this.factura.Importe_Credito_Fiscal=values[5];
                    this.factura.Codigo_Control=values[6];
                    this.factura.NIT_Comprador=values[7];
                    this.factura.Importe_ICE=values[8];
                    this.factura.Importe_Ventas=values[9];
                    this.factura.Importe_No_Sujeto=values[10];
                    this.factura.Descuentos=values[11];
                    this.show.factura=true;
                    this.show.camara=false;
                    setTimeout(() => {
                        this.show.success=true;
                    }, 300);

                }else{
                    this.show.camara=false;
                    setTimeout(() => {
                        this.show.success=true;
                    }, 300);
                    this.show.factura=false;
                }
            }
        },
        handleReadQR(){
            this.show.success=false;
            setTimeout(() => {
                this.show.camara=true;
            }, 300);
            this.errors=[];
        },
        async onInit (promise) {
            try {
                await promise
            } catch (error) {
                if (error.name === 'NotAllowedError') {
                this.error = "ERROR: you need to grant camera access permisson"
                } else if (error.name === 'NotFoundError') {
                this.error = "ERROR: no camera on this device"
                } else if (error.name === 'NotSupportedError') {
                this.error = "ERROR: secure context required (HTTPS, localhost)"
                } else if (error.name === 'NotReadableError') {
                this.error = "ERROR: is the camera already in use?"
                } else if (error.name === 'OverconstrainedError') {
                this.error = "ERROR: installed cameras are not suitable"
                } else if (error.name === 'StreamApiNotSupportedError') {
                this.error = "ERROR: Stream API is not supported in this browser"
                }
            }
        },
        handleStoreFactura(){
          var url='/api/rendicion/viaticos/store'
          this.factura.id=this.data.rendicion.id
          axios.post(url,this.factura).then(response=>{
            this.handleGetViaticoDetalle()
            this.handleGetRendicion()
            this.show.descripcion = false
            this.show.rendicion=true
            this.show.facturas=false
            this.show.index=false
            this.factura.NIT_Emisor=null
            this.factura.Numero_Factura=null
            this.factura.Numero_Autorizacion=null
            this.factura.Fecha_Emision=null
            this.factura.Total=null
            this.factura.Importe_Credito_Fiscal=null
            this.factura.Codigo_Control=null
            this.factura.NIT_Comprador=null
            this.factura.Importe_Ventas=null
            this.factura.Importe_ICE=null
            this.factura.Importe_No_Sujetonull
            this.factura.Descuentos=null
            this.factura.Descripcion=null
            this.factura.CENTRO_COSTOS_ID=null
            this.factura.id=null
            this.show.camara=true;
            this.show.success=false;
            this.errors=[];
          })
        },
        handleStoreFacturaManual(){
          var url='/api/rendicion/viaticos/factura/manual'
          this.data.facturaManual.id=this.data.rendicion.id
          axios.post(url,this.data.facturaManual).then(response=>{
            this.handleGetViaticoDetalle()
            this.handleGetRendicion()
            $('#facturaManual').modal('hide')
            this.data.facturaManual.tipo='Sin IVA'
            this.data.facturaManual.NIT_Emisor=null
            this.data.facturaManual.Numero_Factura=null
            this.data.facturaManual.Numero_Autorizacion=null
            this.data.facturaManual.Fecha_Emision=null
            this.data.facturaManual.Total=null
            this.data.facturaManual.Codigo_Control=null
            this.data.facturaManual.Descripcion=null
            this.data.facturaManual.CENTRO_COSTOS_ID=null
            this.data.facturaManual.id=null
          })
        },
        handleGetViaticoDetalle(){
          var url="/api/rendicion/viaticos/detalle/"+this.data.rendicion.id
          axios.get(url).then(response=>{
            this.data.viaticos=response.data
          })
        },
        handleDeleteFactura(index,row){
          this.$confirm('¿ Eliminar Factura ?', 'Eliminar', {
              confirmButtonText: 'Eliminar',
              cancelButtonText: 'Cancelar',
              type: 'danger',
              roundButton:true
          }).then(() => {
            var url="/api/rendicion/viaticos/delete/"+row.id
            axios.get(url).then(response=>{
              this.handleGetViaticoDetalle()
              this.handleGetRendicion()
            })
          }).catch(() => {});
        },
        handleGetRendicion(){
          var url="/api/rendicion/get/rendicion/"+this.data.rendicion.id
          axios.get(url).then(response=>{
            this.data.rendicion=response.data
          });
        },
        handleShowFacturaManual(){
          $('#facturaManual').modal('show')
        },
        handleGetCentroCostos(TIPO_SOLICITUD_ID){
          this.data.centroCostos=[]
          var url="/api/rendicion/get/centrocostos/"+TIPO_SOLICITUD_ID
          axios.get(url).then(response=>{
            this.data.centroCostos=response.data
          });
        },
        handleGetTipoSolicitud(){
          var url="/api/rendicion/get/tiposolicitud"
          axios.get(url).then(response=>{
            this.data.tipoSolicitud=response.data
          });
        },
        handleGetCentroCostosRendicion(TIPO_SOLICITUD_ID){
          this.data.centroCostosRendicion=[]
          var url="/api/rendicion/get/centrocostos/"+TIPO_SOLICITUD_ID
          axios.get(url).then(response=>{
            this.data.centroCostosRendicion=response.data
          });
        },
        handleShowCentroCostos(){
          if(this.show.costos){
            this.show.costos=false
          }else{
            this.show.costos=true
          }
        },
        handleRendicionFinalizada(){
          var url="/api/rendicion/post/rendicionfinalizada"
          axios.post(url,this.data.rendicion).then(response=>{
            this.show.rendicion=false
            this.show.index=true
            this.handleGetRendicionesSolicitudAprobado()
            this.handleGetRendicionesSolicitudNoAprobado()
            this.handleGetRendicionesSolicitudRechazado()
          });
        }
    },
})
