import Router from 'vue-router';
import Vue from 'vue';


Vue.use(Router);

const Bar = { template: '<div>bar</div>' };
const Foo = { template: '<div>foo</div>' };



export default new Router({
    base: '/', 
    mode: 'history' ,
    routes: [
        { path: '/foo', component: Foo },
        { path: '/panel/usuario/bar', component: Bar }
    ]
});