import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
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
            }
        }
    },
    mounted() {
      this.handleGetDatos();
    },
    methods: {
        handleGetDatos(){
            var url='/api/seguimiento/get/datos'
            axios.get(url).then(response=>{
                this.datos=response.data
                this.loading.datos=false;
            })
        },
        async handleChange(row,expandedRows){
            this.loading.detalle=true;
            const detalle= await this.handleGetDetalle(row.OV_COD_SAP)
            this.subdatos.push({
                key: row.OV_COD_SAP,
                value: detalle
             });
             this.loading.detalle=false;
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
        async handleGetDetalle(DocNum){
            var url='/api/seguimiento/get/detalle/'+DocNum;
            return await axios.get(url).then(response=>{
                 return response.data
            });
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
                var name = date.toLocaleDateString("en-US")+'Seguimiento.xlsx';
                var url = '/api/seguimiento/export';
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
        }
    },
})