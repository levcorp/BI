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
            usuarios: [],
            table: {
                border: true,
                //stripe: true,
            },
        }
    },
    mounted() {
    },
    methods: {
        handleEdit(index, row) {
            console.log(index, row);
        },
        handleDelete(index, row) {
            console.log(index, row);
        }
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');