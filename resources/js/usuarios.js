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
        return {
            sucursal:'',
            user_model:[],
            usuario:[],
            value:'',
            sucursales:[],
            search:'',
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
            modulos:[],
            updateUser:{
                givenname: '',
                sn: '',
                mail: '',
                l: '',
                c: '',
                mobile: '',
                ipphone: '',
                title: '',
                department: '',
                organizacion: '',
                objectguid:'',
                sucursal_id:''
            }
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
        handlePassword: function (index, row) {
            swal("Habilitar cambio de contraseña?", {
                icon: "warning",
                buttons: {
                    cancel: "Cancelar",
                    mail: {
                        text: "Correo Electronico",
                        value: "mail",
                    },
                    login: {
                        text: "Inicio de Sesion",
                        value: "login",
                    }
                },
            }).then((value) => {
                    switch (value) {
                        case "mail":
                            var url = '/api/usuarios/change/' + row.objectguid;
                            axios.get(url).then(response=>{
                                swal("Exito!!","Se envio un correo electronico al usuario para el cambio de contraseña","success");
                            });
                            break;
                        case "login":
                            var url = '/api/usuarios/' + row.objectguid +'/edit';
                            axios.get(url).then(response=>{
                                if (response.data==1){
                                    swal("Exito!!", "El usuario cambiara la contraseña en el siguiente inicio de sesion", "success");
                                }else{
                                    swal("Error!!", "El usuario nunca hizo un inicio de sesion", "error");
                                }
                            });
                            break;
                    }
                });
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
        },
        handleEstado: function (index, row) {
            swal({
                title: "",
                text: "Cambiar estado del usuario " +row.givenname,
                icon: "warning",
                buttons: true,
                successMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var url = '/api/usuarios/' + row.objectguid;
                    axios.get(url).then(response => {
                        this.getUsuarios();
                    });
                    swal("Cambio de contraseña habilitada", {
                        icon: "success",
                    });
                }
            });
        },
        handleShow: function (index, row) {
            this.usuario=row;
            var url = '/api/usuarios/mostrar/' + row.objectguid;
            axios.get(url).then(response=>{
                this.sucursal=response.data;
                $('#show').modal('show');
            });
        },
        handleEdit: function (index, row){
            this.updateUser=row;
            axios.get('/api/usuarios/create').then(response=>{
                this.sucursales=response.data;
            });
            $('#edit').modal('show');
        },
        cerrarShow:function(){
            $('#edit').modal('hide');
        },
        putUser:function(){
            var url = '/api/usuarios/' + this.updateUser.objectguid;
            axios.put(url,this.updateUser).then(response=>{
                $('#edit').modal('hide');            
                swal("Usuario actualizado correctamente", {
                    icon: "success",
                });
                this.getUsuarios();
            });
        }
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#usuario');
