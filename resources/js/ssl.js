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
            ssl:{
                codigo:'',
            },
            data:[],
            ssl_id:'',
        }
    },
    mounted() {
        this.handleGet();
    },
    methods: {
        handleNew(){
            $('#new').modal('show');            
        },
        handleStore(){
            var url="/api/ssl/store";
            axios.post(url,this.ssl).then(response=>{
                this.handleGet();
                this.$message({
                    type:'success',
                    message:'El codigo fue creado correctamente'
                });
                $('#new').modal('hide');            
            });
        },
        handleGet(){
            var url='/api/ssl/get';
            axios.get(url).then(response=>{
                this.data=response.data;   
            });
        },
        handleDelete($index, row){
            var url='/api/ssl/delete';
            axios.post(url,{
                ssl_id:row.id
            }).then(response=>{
                this.$message({
                    type:'success',
                    message:'El codigo fue eliminado'
                })
                this.handleGet();
            });
        },
        handleSubmit($index, row){
            $('#submit').modal('show'); 
            this.ssl_id=row.id;           
        },
        handleStoreCrt(){
            
        }
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');
