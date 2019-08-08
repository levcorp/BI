import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import swal from 'sweetalert';
locale.use(lang);
Vue.use(ElementUI);
var Main = {
    data() {
        return {
            email:'',
            password:'',
        }
    },
    methods: {
        reset:function(){
            swal("Necesitamos tu correo electronico para la recuperación:", {
                content: "input",
            })
            .then((value) => {
                switch (value) {
                case null:
                    break;
                case '':
                    break;
                default:
                    var url='/api/login/reset';
                    const loading = this.$loading({
                        lock: true,
                        text: 'Enviando....',
                    });
                    axios.post(url,{'email':value}).then(response=>{
                        swal('Exito!!','Correo electronico enviado a '+value,'success');
                        loading.close();
                    });
                }
            });
        }
    }
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#login');
