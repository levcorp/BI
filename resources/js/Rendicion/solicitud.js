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
              id:''
          },
            show:{
                create:false,
                index:true,
                abono:false,
                edit:false,
                rendicion:false,
                success:false,
                camara:true,
                factura:true,
                facturas:false,
                descripcion:false
            },
            values:{
                sucursal_id:'',
                usuario_id:'',
                literal:'',
            },
            solicitud:{
                FECHA_SOLICITUD:null,
                FECHA_DESEMBOLSO:null,
                DESCRIPCION:null,
                IMPORTE_SOLICITADO:null,
                SOLICITADO_ID:null,
                AUTORIZADO_ID:null,
                COMENTARIOS:null,
                MOTIVO:null,
                MEDIO_PAGO:null,
                CUENTA:null,
                BANCO_ID:null,
                SUCURSAL:null,
                ESTADO:null
            },
            data:{
                usuarios:[],
                medio:[
                    {
                        value:'Cheque',
                        label:'Cheque'
                    },
                    {
                        value:'Efectivo',
                        label:'Efectivo'
                    },
                    {
                        value:'Abono Cuenta Bancaria',
                        label:'Abono Cuenta Bancaria'
                    }
                ],
                usuario:[],
                bancos:[],
                solicitudes:{
                  aprobado:[],
                  noaprobado:[]
                },
                solicitud:[],
                banco:[],
                solicitado:[],
                autorizado:[],
                solicitudEdit:[],
                rendicion:[],
                viaticos:[]
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
    },
    watch: {
        'solicitud.IMPORTE_SOLICITADO' :function(newValue, oldValue) {
            this.values.literal=writtenNumber(newValue)
        },
        'solicitud.MEDIO_PAGO' :function(newValue, oldValue) {
            if(newValue=='Abono Cuenta Bancaria')
            {
                this.show.abono=true
            }else{
                this.show.abono=false
            }
        }
    },
    methods: {
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
        handleStoreRendicionSolicitud(){
            this.solicitud.SOLICITADO_ID=this.data.usuario.id
            var url='/api/rendicion/solicitud/store'
            axios.post(url,this.solicitud).then(response=>{
                this.handleGetRendicionesSolicitudAprobado();
                this.handleGetRendicionesSolicitudNoAprobado();
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
          this.show.index=true
          this.show.rendicion=false
        },
        handleEditSolicitud(index,row){
          this.show.edit=true
          this.show.index=false
          this.data.solicitudEdit=row
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
          this.handleGetViaticoDetalle()
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
            this.show.descripcion = false
            this.show.rendicion=true
            this.show.facturas=false
            this.show.index=false
            this.handleGetRendicion()
            this.factura.NIT_Emisor=''
            this.factura.Numero_Factura=''
            this.factura.Numero_Autorizacion=''
            this.factura.Fecha_Emision=''
            this.factura.Total=''
            this.factura.Importe_Credito_Fiscal=''
            this.factura.Codigo_Control=''
            this.factura.NIT_Comprador=''
            this.factura.Importe_Ventas=''
            this.factura.Importe_ICE=''
            this.factura.Importe_No_Sujeto=''
            this.factura.Descuentos=''
            this.factura.Descripcion=''
            this.factura.id=''
            this.show.camara=true;
            this.show.success=false;
            this.errors=[];
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
        }
    },
})
