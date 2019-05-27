import Vue from 'vue/dist/vue.common.prod';
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
            roles: [],
        }
    },
    mounted() {
        this.get();
    },
    methods: {
        get:function(){
            var url= '/api/roles';
            axios.get(url).then(response=>{
                this.roles=response.data;
            });
        }
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#rol');