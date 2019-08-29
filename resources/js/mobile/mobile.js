import Vue from 'vue'
import VueRouter from 'vue-router'
import Vant from 'vant';
import axios from 'axios';
import LayoutAuth from './components/LayoutAuth.vue';
import LayoutPanel from './components/LayoutPanel.vue';
import Panel from './components/Panel.vue';
import Login from './components/Login.vue';
import Menu from './components/Menu.vue';
import Stock from './components/Stock.vue';
import Perfil from './components/Perfil.vue';
import 'vant/lib/index.css';
import VueApexCharts from "vue-apexcharts";
import Vuex from 'vuex'
import {Lazyload} from 'vant';
Vue.use(Lazyload);
Vue.use(Vuex)
Vue.use(VueRouter)
Vue.use(Vant);
Vue.component("apexchart", VueApexCharts);
const routes = [
    {
        path: '/',
        component: LayoutAuth,
        children:[
            {
                path:'',
                component:Login
            },
        ]
    },
    {
        path:'/panel',
        component:LayoutPanel,
        children:[
            {
                path:'',
                component:Panel
            },
            {
                path:'/menu',
                component:Menu
            },
            {
                path:'/perfil',
                component:Perfil
            },
            {
                path:'/stock',
                component:Stock,
                name: 'stock'
            },
        ]
    }
]

const router = new VueRouter({
    //mode:'history',
    routes
});
const store = new Vuex.Store({
  state: {
    user:{},
  },
  mutations: {
    getUser (state,user) {
      state.user=user
    }
  }
});
new Vue({
    el:"#app",
    router,
    store,
    data() {
        return {
            
        }
    },
    mounted() {
        console.log(store.state.count) // -> 1
    },    
});