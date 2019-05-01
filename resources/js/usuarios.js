import Vue from 'vue';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import VueDataTables from 'vue-data-tables';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
locale.use(lang);
Vue.use(VueDataTables)
Vue.use(ElementUI);
var Main = {
    data() {
        return {
            usuarios:[],
            titles :[
                { prop: "nombre", label: "Nombre" }, 
                { prop: "apellido",label: "Apellido"},
                { prop: "email", label: "Correo" },
                { prop: "cargo", label: "Cargo" },
            ]
        }
    },
    mounted() {
        this.getUsuarios();
    },
    methods: {
        getUsuarios: function(){
            var url ='/api/usuarios'
            axios.get(url).then(response=>{
                this.usuarios=response.data;
            });
        }
    },
}
var Ctor = Vue.extend(Main)
new Ctor().$mount('#app')