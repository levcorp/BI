import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import round from 'vue-round-filter'

locale.use(lang);
Vue.use(ElementUI);
var Main = {
    data() {
        return {
            inputs:{
                ItemName:'',
                U_Cod_Vent:''
            },
            items:[],
            loading:false,
            stock:[],
            loadingStock:false,
            item:[]
        }
    },
    created() {
     
    },
    methods: {
        handleGet(){
            var url = '/api/stock/';
            this.items=[];
            this.loading=true;
            axios.post(url,this.inputs).then(response=>{
                if (response.data) {
                    this.items=response.data;
                }
                this.loading=false
            });
        },
        handleShow(index,row){
            var url='/api/stock/'+row.U_Cod_Vent;
            this.stock=[];
            this.item=[];
            $('#show').modal('show');         
            this.loadingStock=true;
            axios.get(url).then(response=>{
                this.stock=response.data;
                this.loadingStock=false;
                this.item=row;
            });
        }
    },
    filters: {
        round,
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#stock');
