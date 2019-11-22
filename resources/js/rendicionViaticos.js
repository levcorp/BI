import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
locale.use(lang);
Vue.use(ElementUI);
new Vue({
    el:'#app',
    data() {
        return {    
            values:{
                sucursal_id:'',
                usuario_id:''
            },
            rendiciones:[],
            createRendicion:{
                RESPONSABLE_ID:'',
                CONCEPTO:'',
                FECHA_ASIGNACION:'',
                MONTO_ASIGNADO:'',
                CI:''
            },
            rules:[],
            show:{
                createRendicion:false,
                indexRendiciones:true,
            }
        }
    },
    mounted() {
        this.handleGetRendiciones();
    },
    methods: {
        handleGetRendiciones(){
            axios.post('/api/rendicion/viaticos/get/rendiciones',{
                'usuario_id':this.values.usuario_id
            }).then(response=>{
                this.rendiciones=response.data;
            });
        },
        handleCreateRendicion(){
            this.show.createRendicion=true;
            this.show.indexRendiciones=false;
        },
        handleStoreRendicion(){
            $('#createRendicion').modal('hide');
           
        },
        handleBackIndex(){
            this.show.createRendicion=false;
            this.show.indexRendiciones=true;
        }
    }
});