import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';

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
    methods: {
        handleGet(){
            var url = '/api/stock';
            this.items=[];
            this.loading=true;
            axios.post(url,{
                ItemName : this.inputs.ItemName,
                U_Cod_Vent : this.inputs.U_Cod_Vent
            }).then(response=>{
                if (response.data) {
                    this.items=response.data;
                    this.$message({
                        type: 'success',
                        message: 'Se encontro articulos coincidentes!'
                    });
                    this.loading=false
                }else{
                    this.loading=false
                    this.$message({
                        message: 'No se encontraron articulos coincidentes!'
                    });
                }
            });
        },
        handleShow(index,row){
            var url='/api/stock/detalle';
            this.stock=[];
            this.item=[];
            $('#show').modal('show');         
            this.loadingStock=true;
            axios.post(url,{
                U_Cod_Vent : row.U_Cod_Vent
            }).then(response=>{
                this.stock=response.data;
                this.loadingStock=false;
                this.item=row;
                this.$message({
                    message: 'Detalle de articulo cargado correctamente!'
                });
            });
        }
    }
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#stock');
