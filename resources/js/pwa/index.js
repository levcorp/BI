// src/plugins/vuetify.js
// src/plugins/vuetify.js
import 'babel-polyfill';
import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import '@mdi/font/css/materialdesignicons.css'
Vue.use(Vuetify)
new Vue({
  el:'#pwa',
  data() {
      return {
          bottomNav:''
      }
  },
})
