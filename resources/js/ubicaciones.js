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
var Main={
    data() {
        return {
            createList:{
                FECHA_CREACION:new Date(),
                USUARIO_ID:''
            },
            lists:[],
            view:1,
            sucursal:'',// WhsCode=>Sucursal_id
            ubicacionesNull:[],
            loadUbicacionesNull:false,
            searchUbicacionesNull:'',
            lista:[],
            ubicaciones:[]
        }
    },
    mounted() {
        this.handleGet();
    },
    methods: {
        handleGet(){
            var url='/api/ubicacion/get';
            axios.get(url).then(response=>{
                this.lists=response.data;
            });
        },
        handleAddView(index,row){
            this.handleUbicacionNull();
            this.lista=row;
            this.view=2;
            this.handleArticulosUbicacion();
            //console.log(this.lista);
        },
        handleStore(){
            var url='/api/ubicacion/store';
            axios.post(url,this.createList).then(response=>{
                this.handleGet();
                $('#create').modal('hide');
            });
        },
        handleCreate(){
            $('#create').modal('show');            
        },
        handleBack(){
            this.view=1;
        },
        handleUbicacionNull(){
            var url='/api/ubicacion/null';
            this.loadUbicacionesNull=true
            axios.post(url,{
                WhsCode:this.sucursal,
            }).then(response=>{
                this.ubicacionesNull=response.data
                this.loadUbicacionesNull=false;
            });
        },
        handleAdd(){
            $('#add').modal('show');
        },
        handelChoseUbicacionNull($option){
            var url='/api/ubicacion/chosenull';
            this.loadUbicacionesNull=true;
            axios.post(url,{
                WhsCode:$option
            }).then(response=>{
                this.ubicacionesNull=response.data
                this.loadUbicacionesNull=false
            });
        },
        handleArticulosUbicacion(){
            var url='/api/ubicacion/items';            
            axios.post(url,{
                LISTA_ID:this.lista.id,
            }).then(response=>{
                this.ubicaciones=response.data;
            });
        }
    }
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');  