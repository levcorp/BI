import Vue from 'vue/dist/vue.common.prod';
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
            title:'',
            Form:{
                create:'',
                update:'',
                delete: '',
                usuario_id:'',
                modulo_id:''
            },
            searchUsuarios:'',
            searchModulos:'',
            usuarios: [],
            modulos:[]
        }
    },
    created() {
        this.getUsuarios();
        this.getModulos();
    },
    methods: {
        getUsuarios: function () {
            var url = '/api/usuarios/';
            axios.get(url).then(response => {
                this.usuarios = response.data;
            });
        },
        getModulos: function () {
            var url = '/api/modulos/';
            axios.get(url).then(response => {
                this.modulos = response.data;
            });
        },
        handleModulo: function (index, row){
            $('#modulo').modal('show');
            this.Form.usuario_id=row.id;            
        },
        handlePer: function (index, row) {
            $('#permisos').modal('show');
            this.Form.modulo_id=row.id
            this.title=row.titulo;
        },
        postPermisos:function (){
            var url='/api/usuarios/asignacion';
            axios.post(url,this.Form).then(response=>{
                console.log(response.data);
                this.$message({
                    message: 'Asignacion de permisos realizada correctamente',
                    type: 'success'
                });
                $('#permisos').modal('hide');
            });
        }
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#usuario');
