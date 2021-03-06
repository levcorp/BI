import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import Vue2Filters from 'vue2-filters'
import VueMoment from 'vue-moment';
import VueQrcodeReader from "vue-qrcode-reader";
import vSelect from 'vue-select'

Vue.component('v-select', vSelect)
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
          pickerOptions: {
            disabledDate(time) {
              const date = new Date()
              return time.getTime() < date.setTime(date.getTime() - 3600 * 1000 * 24)
            },
          },
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
              Centro_Costos:null,
              Razon_Social:null
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
                costos:false,
                autorizacion:false,
                banco:false,
                cuenta:false,
                tiposolicitud:false,
                centrocostos:false
            },
            values:{
                sucursal_id:'',
                usuario_id:'',
                literal:'',
                objectguid:'',
                cuenta:'',
                decimal:'',
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
                CHEQUE_NOMBRE:null
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
                tiposolicitud:[],
                centrocostos:[],
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
                  Razon_Social:null
                },
                centrocostos:{
                  NOMBRE:null
                },
            },
            loading:false,
            errors:[],
            values:[],
            errorsSolicitud:[],
            errorsSolicitudEdit:[],
            load:{
              create:false,
              edit:false,
              factura:false,
              facturaManual:false,
            }
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
        this.handleGetCentroCostos()
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
            this.values.literal=writtenNumber(parseInt(newValue))
            this.values.decimal=parseInt((newValue-Math.floor(newValue))*100)
        },
        'data.solicitudEdit.IMPORTE_SOLICITADO' :function(newValue, oldValue) {
            this.values.literal=writtenNumber(parseInt(newValue))
            this.values.decimal=parseInt((newValue-Math.floor(newValue))*100)
        },
        'solicitud.MEDIO_PAGO' :function(newValue, oldValue) {
            if(newValue=='Abono Cuenta Bancaria')
            {
                this.show.abono=true
            }else{
                this.show.abono=false
            }
        },
        'data.solicitudEdit.MEDIO_PAGO' :function(newValue, oldValue) {
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
        'solicitud.URGENTE' :function(newValue, oldValue) {
            if(!newValue)
            {
              var dias =2;
              this.solicitud.FECHA_DESEMBOLSO=new Date()
              this.solicitud.FECHA_DESEMBOLSO=this.solicitud.FECHA_DESEMBOLSO.setDate(this.solicitud.FECHA_DESEMBOLSO.getDate()+parseInt(dias)).toISOString().slice(0,10);
            }
        },
        'data.solicitudEdit.URGENTE' :function(newValue, oldValue) {
            if(!newValue)
            {
              var dias =2;
              this.data.solicitudEdit.FECHA_DESEMBOLSO=new Date()
              this.data.solicitudEdit.FECHA_DESEMBOLSO=this.data.solicitudEdit.FECHA_DESEMBOLSO.setDate(this.data.solicitudEdit.FECHA_DESEMBOLSO.getDate()+parseInt(dias)).toISOString().slice(0,10);
            }
        }
    },
    methods: {
        handleCommandSolicitudRechazado(command){
          switch (command.type) {
            case 'sent':
              this.handleSentSolicitud(command.pendiente)
            break;
            case 'edit':
              this.handleEditSolicitud(command.pendiente)
            break;
            case 'show':
              this.handleShowSolicitud(command.pendiente)
            break;
            case 'delete':
              this.handleDeleteSolicitud(command.pendiente)
            break;
          }
        },
        handleCommandSolicitudAutorizado(command){
          switch (command.type) {
            case 'exportar':
              this.handleReporteSolicitud(command.pendiente)
            break;
            case 'show':
              this.handleShowSolicitud(command.pendiente)
            break;
            case 'rendicion':
              this.handleRendicionViaticos(command.pendiente)
            break;
          }
        },
        handleCommandSolicitudPendiente(command){
          switch (command.type) {
            case 'edit':
              this.handleEditSolicitud(command.pendiente)
            break;
            case 'show':
              this.handleShowSolicitud(command.pendiente)
            break;
            case 'delete':
              this.handleDeleteSolicitud(command.pendiente)
            break;
          }
        },
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
        handleShowSolicitud(row){
          console.log("entro");
          var url='/api/rendicion/solicitud/get/'+row.id
          axios.get(url).then(response=>{
            this.data.solicitud=response.data
            this.data.banco=response.data.banco
            this.data.solicitado=response.data.solicitado
            this.data.autorizado=response.data.autorizado
            this.data.centrocostos=response.data.centrocostos
            this.data.tiposolicitud=response.data.tiposolicitud
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
        handleSentSolicitud(row){
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
        handleValidateRendicionSolicitud(){
          this.errorsSolicitud=[]
          if(this.solicitud.DESCRIPCION==null){
            this.errorsSolicitud.push('El campo Descripcion es obligatorio')
          }
          if(this.solicitud.IMPORTE_SOLICITADO==null){
            this.errorsSolicitud.push('El campo Importe Solicitado es obligatorio')
          }
          if(this.solicitud.AUTORIZADO_ID==null){
            this.errorsSolicitud.push('El campo Autorizado por, es obligatorio')
          }
          if(this.solicitud.COMENTARIOS==null){
            this.errorsSolicitud.push('El campo Comentarios por, es obligatorio')
          }
          if(this.solicitud.MOTIVO==null){
            this.errorsSolicitud.push('El campo Motivo es obligatorio')
          }
          if(this.solicitud.TIPO_SOLICITUD_ID==null){
            this.errorsSolicitud.push('El campo Tipo de Solicitud es obligatorio')
          }
          if(this.solicitud.CENTRO_COSTOS_ID==null){
            this.errorsSolicitud.push('El campo Centro de Costos es obligatorio')
          }
          if(this.solicitud.MEDIO_PAGO==null){
            this.errorsSolicitud.push('El campo Medio de Pago es obligatorio')
          }
          if(this.solicitud.DESCRIPCION!=null && this.solicitud.IMPORTE_SOLICITADO!=null && this.solicitud.AUTORIZADO_ID!=null && this.solicitud.COMENTARIOS!=null && this.solicitud.MOTIVO!=null && this.solicitud.TIPO_SOLICITUD_ID!=null && this.solicitud.CENTRO_COSTOS_ID!=null && this.solicitud.MEDIO_PAGO!=null){
            if(this.solicitud.MEDIO_PAGO=='Abono Cuenta Bancaria'){
              if(this.solicitud.CUENTA!=null && this.solicitud.BANCO_ID!=null){
                this.handleStoreRendicionSolicitud()
              }else{
                this.errorsSolicitud.push('El campo Cuenta es obligatoria')
                this.errorsSolicitud.push('El campo Banco es obligatorio')
              }
            }else{
              if(this.solicitud.MEDIO_PAGO=='Cheque'){
                if(this.solicitud.CHEQUE_NOMBRE!=null){
                  this.handleStoreRendicionSolicitud()
                }else{
                  this.errorsSolicitud.push('El cheque a nombre de, es obligatorio')
                }
              }
            }
          }
          console.log(this.errorsSolicitud)
        },
        handleStoreRendicionSolicitud(){
            this.load.create=true
            this.solicitud.SOLICITADO_ID=this.data.usuario.id
            var url='/api/rendicion/solicitud/store'
            axios.post(url,{
              solicitud:this.solicitud,
              label:writtenNumber(parseInt(this.solicitud.IMPORTE_SOLICITADO)),
              decimal:parseInt((this.solicitud.IMPORTE_SOLICITADO - Math.floor(this.solicitud.IMPORTE_SOLICITADO))*100)
            }).then(response=>{
                this.handleGetRendicionesSolicitudAprobado();
                this.handleGetRendicionesSolicitudNoAprobado();
                this.handleGetRendicionesSolicitudRechazado();
                this.show.create=false
                this.show.index=true
                this.$notify.success({
                    title: '¡Creado con exito!',
                    message: 'La solicitud fue creada exitosamente',
                });
                this.errorsSolicitud=[]
                this.load.create=false
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
          this.show.autorizacion=false,
          this.show.banco=false,
          this.show.cuenta=false,
          this.show.tiposolicitud=false,
          this.show.centrocostos=false
          this.handleGetRendicionesSolicitudAprobado();
          this.handleGetRendicionesSolicitudNoAprobado();
          this.handleGetRendicionesSolicitudRechazado();
        },
        handleEditSolicitud(row){
          this.show.edit=true
          this.show.index=false
          this.data.solicitudEdit=row
          console.log(row)
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
        handleDeleteSolicitud(row){
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
                this.data.usuarios = response.data
            })
        },
        handleValidUpdateSolicitud(){
          this.errorsSolicitudEdit=[]
          if(this.data.solicitudEdit.DESCRIPCION==null){
            this.errorsSolicitudEdit.push('El campo Descripcion es obligatorio')
          }
          if(this.data.solicitudEdit.IMPORTE_SOLICITADO==null){
            this.errorsSolicitudEdit.push('El campo Importe Solicitado es obligatorio')
          }
          if(this.data.solicitudEdit.AUTORIZADO_ID==null){
            this.errorsSolicitudEdit.push('El campo Autorizado por, es obligatorio')
          }
          if(this.data.solicitudEdit.COMENTARIOS==null){
            this.errorsSolicitudEdit.push('El campo Comentarios por, es obligatorio')
          }
          if(this.data.solicitudEdit.MOTIVO==null){
            this.errorsSolicitudEdit.push('El campo Motivo es obligatorio')
          }
          if(this.data.solicitudEdit.TIPO_SOLICITUD_ID==null){
            this.errorsSolicitudEdit.push('El campo Tipo de Solicitud es obligatorio')
          }
          if(this.data.solicitudEdit.CENTRO_COSTOS_ID==null){
            this.errorsSolicitudEdit.push('El campo Centro de Costos es obligatorio')
          }
          if(this.data.solicitudEdit.MEDIO_PAGO==null){
            this.errorsSolicitudEdit.push('El campo Medio de Pago es obligatorio')
          }
          if(this.data.solicitudEdit.DESCRIPCION!=null && this.data.solicitudEdit.IMPORTE_SOLICITADO!=null && this.data.solicitudEdit.AUTORIZADO_ID!=null && this.data.solicitudEdit.COMENTARIOS!=null && this.data.solicitudEdit.MOTIVO!=null && this.data.solicitudEdit.TIPO_SOLICITUD_ID!=null && this.data.solicitudEdit.CENTRO_COSTOS_ID!=null && this.data.solicitudEdit.MEDIO_PAGO!=null){
            if(this.data.solicitudEdit.MEDIO_PAGO=='Abono Cuenta Bancaria'){
              if(this.data.solicitudEdit.CUENTA!=null && this.data.solicitudEdit.BANCO_ID!=null){
                this.handleUpdateSolicitud()
              }else{
                this.errorsSolicitudEdit.push('El campo Cuenta es obligatoria')
                this.errorsSolicitudEdit.push('El campo Banco es obligatorio')
              }
            }else{
              if(this.data.solicitudEdit.MEDIO_PAGO=='Cheque'){
                if(this.data.solicitudEdit.CHEQUE_NOMBRE!=null){
                  this.handleUpdateSolicitud()
                }else{
                  this.errorsSolicitudEdit.push('El cheque a nombre de, es obligatorio')
                }
              }
            }
          }
          console.log(this.errorsSolicitudEdit)
        },
        handleUpdateSolicitud(){
            this.load.edit=true
            var url='/api/rendicion/solicitud/update'
            axios.post(url,this.data.solicitudEdit).then(response=>{
              this.handleGetRendicionesSolicitudAprobado();
              this.handleGetRendicionesSolicitudNoAprobado();
              this.show.edit=false
              this.show.index=true
              this.errorsSolicitudEdit=[]
              this.$message({
                  type: 'success',
                  message: 'La solicitud se actualizo correctamente'
                });
                this.load.edit=false
            });
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
            });
        },
        handleRendicionViaticos(row){
          this.show.rendicion=true
          this.show.index=false
          this.data.rendicion=row
          this.data.centrocostos.NOMBRE=row.centrocostos.NOMBRE
          console.log(this.data.centrocostos.NOMBRE)
          this.handleGetViaticoDetalle()
          this.handleGetCentroCostosRendicion()
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
          this.load.factura=true
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
            this.load.factura=false
          })
        },
        handleStoreFacturaManual(){
          this.load.facturaManual=true
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
            this.load.facturaManual=false
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
        handleGetCentroCostos(){
          this.data.centroCostos=[]
          var url="/api/rendicion/get/centrocostos"
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
        handleGetCentroCostosRendicion(){
          this.data.centroCostosRendicion=[]
          var url="/api/rendicion/get/centrocostos/"
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
        },
        handleShowAutorizacion(){
          if(this.show.autorizacion){
            this.show.autorizacion=false
          }else{
            this.show.autorizacion=true
            this.data.solicitudEdit.AUTORIZADO_ID=null
          }
        },
        handleShowBanco(){
          if(this.show.banco){
            this.show.banco=false
          }else{
            this.show.banco=true
            this.data.solicitudEdit.BANCO_ID=null
          }
        },
        handleShowTipoSolicitud(){
          if(this.show.tiposolicitud){
            this.show.tiposolicitud=false
          }else{
            this.show.tiposolicitud=true
            this.data.solicitudEdit.TIPO_SOLICITUD_ID=null
          }
        },
        handleShowCentroCostos(){
          if(this.show.centrocostos){
            this.show.centrocostos=false
          }else{
            this.show.centrocostos=true
            this.data.solicitudEdit.CENTRO_COSTOS_ID=null
          }
        }
    },
})
