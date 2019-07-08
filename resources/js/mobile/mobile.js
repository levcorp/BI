import Vue from 'vue'
import VueRouter from 'vue-router'
import Vant from 'vant';
import LayoutAuth from './components/LayoutAuth.vue';
import LayoutPanel from './components/LayoutPanel.vue';
import Login from './components/Login.vue';
import 'vant/lib/index.css';
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