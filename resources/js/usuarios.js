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
            usuarios: [],
            table: {
                border: true,
                //stripe: true,
            },
            titles: [
                { prop: "nombre", label: "Nombre", align: 'center' },
                { prop: "apellido", label: "Apellido", align: 'center' },
                { prop: "email", label: "Correo Electronico", align: 'center' },
            ],
            filters: [{
                prop: 'nombre',
            }
            ],
            dowload: {
                label: 'Acciones',
                props: {
                    align: 'center',
                },
                buttons: [{
                    props: {
                        type: 'primary',
                        icon: 'el-icon-download',
                        size: 'small',
                    },
                    handler: row => {
                        
                    },
                    label: ''
                }]
            }
        }
    },
    mounted() {
        this.getUsuarios();
    },
    methods: {
        getUsuarios: function () {
            var url = '/api/usuarios/';
            axios.get(url).then(response => {
                this.usuarios = response.data;
            });
        },
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');