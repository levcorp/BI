import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import Vue2Filters from 'vue2-filters'
import VueMoment from 'vue-moment';
import rate from 'vue-rate';

Vue.use(rate)

locale.use(lang);
Vue.use(ElementUI);
Vue.use(Vue2Filters)

const moment = require('moment')
require('moment/locale/es')
 
Vue.use(require('vue-moment'), {
    moment
});

var Main = {
    data() {
        return {

        }
    },
    mounted() {
        
    },
    methods: {
        
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');