import VueMaterial from 'vue-material'
import Vue from 'vue/dist/vue.common.prod';
import 'vue-material/dist/vue-material.min.css'
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import VueDataTables from 'vue-data-tables';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import swal from 'sweetalert';

Vue.use(VueMaterial)
locale.use(lang);
Vue.use(VueDataTables)
Vue.use(ElementUI);
var Main={
    data() {
        return {
            visible: false,
            image:'',
            id:''
        };
    },
    methods: {
        submitForm() {
            var url='/api/usuarios';
            axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
            axios.post(url, {
                image: this.image
            }).then(response => {
                flash(response.data.message, 'success');
            }).catch(e => {
                console.log(e);
            })
        },

        imagePreview(event) {
            let input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = e => {
                    this.previewImageUrl = e.target.result;
                    this.image = e.target.result;
                    var url = '/api/usuarios';
                    axios.defaults.headers.post['Content-Type'] = 'multipart/form-data';
                    axios.post(url, {
                        image: this.image,
                        id:this.id
                    }).then(response => {
                        flash(response.data.message, 'success');
                    }).catch(e => {
                        console.log(e);
                    })
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    }
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#user');
