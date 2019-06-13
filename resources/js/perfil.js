import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import VueDataTables from 'vue-data-tables';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import swal from 'sweetalert';
locale.use(lang);
Vue.use(VueDataTables)
Vue.use(ElementUI);
var Main = {
    data() {
        return{
            perfiles:[],
            search:'',
            perfil:[],
        }
    },
    created() {
        this.get();
    },
    methods: {
        get: function () {
            var url = '/api/perfiles/';
            axios.get(url).then(response => {
                this.perfiles = response.data;
            });
        },
        handleEdit: function (index, row) {
            perfil.
            $('#edit').modal('show');
        },
        handleDelete: function (index, row){
            
        },
        handleCreate: function (){
            $('#create').modal('show');
        },
        update:function(){

        },
        delete:function(){

        },
        closeEdit:function(){
            $('#edit').modal('hide');
        },
        closeCreate:function(){
            $('#create').modal('hide');
        }
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#perfil');
