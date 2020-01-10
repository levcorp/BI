import Vue from 'vue';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import Vue2Filters from 'vue2-filters'
const moment = require('moment');
require('moment/locale/es');
 
 
Vue.use(Vue2Filters)
Vue.use(require('vue-moment'), {
    moment
});
locale.use(lang);
Vue.use(ElementUI);

new Vue({
    el:'#app',
    data() {
        return {
            store:{
                usuario_id:''
            },
            socios:{
                pendientes:[],
                realizados:[]
            },
            view:{
                lista:true,
                create:false,
                contacto:false,
                direccion:false,
                listContacto:true,
                listDireccion:true,
            },
            socio:{
                create:{
                    Tipo:'',
                    Serie:'',
                    Nombre:'',
                    NombreExtranjero:'',
                    Grupo:'',
                    Moneda:'',
                    NIT:'',
                    Telefono1:'',
                    Telefono2:'',
                    Fax:'',
                    Web:'',
                    Contacto:[],
                    Direccion:[]
                }
            },
            datos:{
                CardType:[
                    {
                        label:'CLIENTE',
                        value:'C'
                    },
                    {
                        label:'PROVEEDOR',
                        value:'S'
                    }
                ],
                Series:[
                    {
                        label:'CLIENTES',
                        value:'187',
                        type:'C'
                    },
                    {
                        label:'CLI_INT',
                        value:'52',
                        type:'C'
                    },
                    {
                        label:'PRO_EXT',
                        value:'53',
                        type:'S'
                    },
                    {
                        label:'PRO_NAC',
                        value:'54',
                        type:'S'
                    },
                ],
                SeriesFilter:[],
                grupo:[],
                moneda:[
                    {
                        label:'Bolivianos',
                        value:'BS',
                    },
                    {
                        label:'Euro',
                        value:'EUR',
                    },
                    {
                        label:'Unidad de Fomento',
                        value:'UFV',
                    },
                    {
                        label:'Dolar Americano',
                        value:'USD',
                    },
                    {
                        label:'Monedas(todas)',
                        value:'##',
                    },
                ]
            }
        }
    },
    mounted() {
        
    },
    watch: {
        'socio.create.Tipo'(newValue,OldValue){
            let filter=this.datos.Series.filter(function(dato){
                return dato.type===newValue;
            });
            this.datos.SeriesFilter=filter
            this.socio.create.Serie=''
        }
    },
    methods: {
        handleGetLista(){

        },
        handleGetDetalle(){

        },
        handleCreateSocio(){
            this.view.lista=false
            this.view.create=true
            this.handleGetGrupos()
        },
        handleBackLista(){
            this.view.create=false
            this.view.lista=true
        },
        handleGetGrupos(){
            var url='/api/socios/get/grupos';
            axios.get(url).then(response=>{
                this.datos.grupo=response.data
            })
        },
        handleStyleHead(){
            return { backgroundColor: '#343f51', width: '100%' ,color:'#FFFFFF', fontSize:'11px',textAlign:'center',padding:'1px'};
        },
        handleStyleCell(){
            return { fontSize:'11px',textAlign:'center'};
        },
        handleShowCreateContacto(){
            this.view.listContacto=false
            setTimeout(()=>{
                this.view.contacto=true
            },400);
        },
        handleShowCreateDireccion(){
            this.view.listDireccion=false
            setTimeout(()=>{
                this.view.direccion=true
            },400);
        },
        handleBackListaContacto(){
            this.view.contacto=false
            setTimeout(()=>{
                this.view.listContacto=true
            },400);
        },
        handleBackListaDireccion(){
            this.view.direccion=false
            setTimeout(()=>{
                this.view.listDireccion=true
            },400);
        }
    },
})