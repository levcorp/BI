import Vue from 'vue';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
locale.use(lang);
Vue.use(ElementUI);
var Main={
   data() {
       return {
            createList:{

            },
       }
   },
   methods: {
       
   }
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');