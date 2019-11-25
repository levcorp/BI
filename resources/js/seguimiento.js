import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import VModal from 'vue-js-modal'
 
Vue.use(VModal)
Vue.use(Vue2Filters)

locale.use(lang);
Vue.use(ElementUI);
const moment = require('moment')
require('moment/locale/es')
import Vue2Filters from 'vue2-filters'
Vue.use(require('vue-moment'), {
    moment
});
new Vue({
    el: '#app',
    data() {
        return {
            datos:[],
            subdatos:[]  ,
            loading:{
                datos:true,
                detalle:false,
                export:false,
            },
            values:{
                sucursal_id:'',
            },
            sucursal:'',
            dato:[],
        }
    },
    mounted() {
      this.handleGetDatos();
      this.sucursal=this.handleSucursal(this.values.sucursal_id);
    },
    methods: {
        handleSucursal(sucursal){
            switch (sucursal) {
                case 'La Paz':
                    return 'LP'
                    break;
                case 'Cochabamba':
                    return 'CO'
                    break;
                case 'Santa Cruz' : 
                    return 'SC'
                    break;
            }
        },
        handleGetDatos(){
            var url='/api/seguimiento/get/datos/'+this.handleSucursal(this.values.sucursal_id)
            axios.get(url).then(response=>{
                this.datos=response.data
                this.loading.datos=false;
            })
        },
        handleGetDetalle(row){
            this.dato=row;
            this.$modal.show('descripcion');
             this.loading.detalle=true;
             var url='/api/seguimiento/get/detalle';
             axios.post(url,{
                 DocNum: row.OV_COD_SAP,
                 sucursal: this.handleSucursal(this.values.sucursal_id)
             }).then(response=>{
                this.loading.detalle=false;
                this.subdatos=response.data;
             });
        },
        headerRowStyleDatos({row, rowIndex}) {
        	return {"font-size":"12px"};
        },
        headerRowStyleDetalle({row, rowIndex}) {
        	return {"background-color":"#409efe", width: '100%',"font-size":"11px","color":"#FFFFFF"};
        },
        rowStyleDetalle({row, rowIndex}){
            return { "background":"#fdf6ec"};
        },
        handleExportSeguimiento(){
            this.loading.export=true;
            this.$confirm('¿ Exportar Lista ?', 'Exportar', {
                confirmButtonText: 'Aceptar',
                cancelButtonText: 'Cancelar',
                type: 'warning',
                roundButton:true
              }).then(() => {
                var date=new Date();
                var name = this.sucursal+date.toLocaleDateString("en-US")+'Seguimiento.xlsx';
                var url = '/api/seguimiento/export/'+this.sucursal;
                axios({
                    url: url,
                    method: 'GET',
                    responseType: 'blob'
                }).then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement('a');
                    link.href = url;
                    link.setAttribute('download', name); //or any other extension
                    document.body.appendChild(link);
                    link.click();
                    this.loading.export=false
                });
              }).catch(() => {});
        },
        handleGetSucursal(sucursal){
            this.sucursal=sucursal;
            this.loading.datos=true;
            var url='/api/seguimiento/get/datos/'+sucursal
            axios.get(url).then(response=>{
                this.datos=response.data
                this.loading.datos=false;
            })
        },
        handleCloseDetalle(){
            this.$modal.hide('descripcion');
        }
    },
})