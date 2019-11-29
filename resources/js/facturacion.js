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
            datos:[],
            dato:[],
            loading: {
                facturacion:true,
                ped:false
            },
            show:{
                pedidos:false,
                oportunidades:false,
                facturacion:true
            },
            pedidos:[],
            year:[],
            mes:[],
            pedidosAll:[],
            pedidoDetalle:[],
            pedido:[],
            oportunidades:{
                mes:[],
                all:[],
                meses:[],
                años:[],
                detalle:[]
            }
        }
    },
    mounted() {
        this.handleGetFacturacion();
    },
    methods: {
        handleGetFacturacion(){
            axios.get('/api/facturacion/get/facturacion').then(response=>{
                this.datos=response.data;
                this.loading=false
            });
        },
        handleShowPedidos(item){
            this.show.facturacion=false
            this.dato=item
            setTimeout(()=>{
                this.show.pedidos=true
                this.handleGetPedidos(item.Sector)
                this.handleGetMes(item.Sector)
                this.handleGetYear(item.Sector)
                this.handleGetPedidosAll(item.Sector)
            },400);
        },
        handleShowOportunidades(item){
            this.show.facturacion=false
            this.dato=item
            setTimeout(()=>{
                this.show.oportunidades=true
                this.handleGetOportunidadesMes(item.Sector)
                this.handleGetOportunidadesAll(item.Sector)
                this.handleGetOportunidadesMeses(item.Sector)
                this.handleGetOportunidadesAños(item.Sector)
            },400);
        },
        handleBackPedidos(){
            this.show.pedidos=false
            this.pedidos=[]
            this.pedidosAll=[]
            setTimeout(()=>{
                this.show.facturacion=true
            },400);
        },
        handleBackOportunidades(){
            this.show.oportunidades=false
            setTimeout(()=>{
                this.show.facturacion=true
            },400);
        },
        handleGetPedidos(Sector){
            axios.get('/api/facturacion/get/pedidos/'+Sector).then(response=>{
                this.pedidos=response.data;
            });
        },
        handleGetMes(Sector){
            axios.get('/api/facturacion/get/pedidosmes/'+Sector).then(response=>{
                this.mes=response.data;
            });
        },
        handleGetYear(Sector){
            axios.get('/api/facturacion/get/pedidosyear/'+Sector).then(response=>{
                this.year=response.data;
            });
        },
        handleGetPedidosAll(Sector){
            axios.get('/api/facturacion/get/pedidosall/'+Sector).then(response=>{
                this.pedidosAll=response.data;
            });
        },
        handleGetPedidoDetalle(row){
            this.pedido=row
            $('#detallePedido').modal('show');
            axios.post('/api/facturacion/get/pedidodetalle',{
               mes:row.Moth,
               sector:row.Sector,
               year:row.Year,
               cliente: row.Nombre_Cliente
            }).then(response=>{
                this.pedidoDetalle=response.data
            });
        },
        handleGetOportunidadesAll(Sector){
            axios.post('/api/facturacion/get/oportunidades/all',{
                Sector:Sector
            }).then(response=>{
                this.oportunidades.all=response.data
            })
        },
        handleGetOportunidadesMes(Sector){
            axios.post('/api/facturacion/get/oportunidades/mes',{
                Sector:Sector
            }).then(response=>{
                this.oportunidades.mes=response.data
            })
        },
        handleGetOportunidadesMeses($sector){
            axios.get('/api/facturacion/get/oportunidades/meses/'+$sector).then(response=>{
                this.oportunidades.meses=response.data;
            })
        },
        handleGetOportunidadesAños($sector){
            axios.get('/api/facturacion/get/oportunidades/year/'+$sector).then(response=>{
                this.oportunidades.años=response.data
            });
        },
        handleGetOportunidadDetalle(row){
            this.pedido=row
            $('#detalleOportunidad').modal('show');
            axios.post('/api/facturacion/get/oportunidades/detalle',{
               mes:row.Mes,
               sector:row.Sector,
               year:row.Año,
               cliente: row.Cliente
            }).then(response=>{
                this.oportunidades.detalle=response.data
            });
        },
    },
    filters:{
        mes(value){
            var nombre = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            return nombre[parseInt(value) -1];
        },
        sucursal(value){
            switch (value) {
                case 'LP':
                    return 'La Paz' 
                    break;
                case 'CO':
                    return 'Cochabamba'
                    break;
                case 'SC':
                    return 'Santa Cruz'
                    break;
            }
        },
        sector(value){
            switch (value) {
                case 'F&B':
                   return 'Alimentos y Bebidas' 
                break;
                case 'M&C':
                    return 'Mineria y Cemento' 
                break;
                case 'O&G':
                    return 'Gas y Petroleo' 
                break;
                case 'MAN':
                    return 'Manufactura' 
                break;
                case 'CSS':
                    return 'Construcción y Servicios' 
                break;
                default:
                    return value
                break;
            }
        }
    }
});
