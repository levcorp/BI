import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import Vue2Filters from 'vue2-filters'
Vue.use(Vue2Filters)
locale.use(lang);
Vue.use(ElementUI);
var writtenNumber = require('written-number');
writtenNumber.defaults.lang = 'es';
new Vue({
    el:'#app',
    data(){
        return {
            solicitudes:[],
            show:{
                create:true,
                index:false,
                abono:false,
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
                bancos:[]
            }
        }
    },
    mounted () {
        this.handleGetUsuarios();
        this.handleGetUsuario();
        this.handleGetBancosRendicion();
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
        handleGetUsuario(){
            var url='/api/rendicion/solicitud/usuario/'+this.values.usuario_id
            axios.get(url).then(response=>{
                this.data.usuario=response.data
            })
        },
        handleGetBancosRendicion(){
            var url='/api/rendicion/solicitud/bancos/'
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
        },
        handleEditSolicitud(){

        },
        handleShowSolicitud(){

        },
        handleDeleteSolicitud(){

        },
        handleGetUsuarios(){
            var url = "/api/tareas/users";
            axios.get(url).then(response => {
                this.data.usuarios = response.data;
            })
        }
    },
})