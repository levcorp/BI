import Vue from 'vue'
import VueRouter from 'vue-router'
import Vant from 'vant';
import LayoutAuth from './components/LayoutAuth.vue';
import LayoutPanel from './components/LayoutPanel.vue';
import Panel from './components/Panel.vue';
import Login from './components/Login.vue';
import Menu from './components/Menu.vue';
import Perfil from './components/Perfil.vue';
import 'vant/lib/index.css';
import VueApexCharts from "vue-apexcharts";


Vue.component("apexchart", VueApexCharts);
Vue.use(VueRouter)
Vue.use(Vant);
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
        ]
    }
]

const router = new VueRouter({
    //mode:'history',
    routes
});

new Vue({
    el:"#app",
    router,
    data() {
        return {
            
        }
    },
});