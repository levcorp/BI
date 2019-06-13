import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import VueDataTables from 'vue-data-tables';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import sweetalert from 'sweetalert';
locale.use(lang);
Vue.use(VueDataTables)
Vue.use(ElementUI);
var Main = {
    data() {
        return {
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
            usuario:{
                nombre:'',
                apellido:'',
                email:'',
                ciudad:'',
                pais:'',
                celular:'',
                telefono:'',
                puesto:'',
                departamento:'',
                organizacion:''
            },
            updateUser:{
                nombre: '',
                apellido: '',
                email: '',
                ciudad: '',
                pais: '',
                celular: '',
                telefono: '',
                puesto: '',
                departamento: '',
                organizacion: '',
                objectguid:'',
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
            swal({
                title: "",
                text: "Habilitar cambio de contraseña, en el siguiente inicio de sesión?",
                icon: "warning",
                buttons: true,
                successMode: true,
            }).then((willDelete) => {
                    if (willDelete) {
                        var url = '/api/usuarios/' + row.objectguid+'/edit';
                        axios.get(url).then(response=>{
                            swal("Cambio de contraseña habilitada", {
                                icon: "success",
                            });
                        }).catch(error=>{
                            swal("Cambio de contraseña no habilitada el usuario no fue autentificado, ni una sola vez", {
                                icon: "error",
                            });
                        });
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
            this.usuario= {nombre: '',apellido: '',email: '',ciudad: '',pais: '',celular: '',telefono: '',puesto: '',departamento: '',organizacion: ''}
            var url = '/api/usuarios/mostrar/' + row.objectguid;
            axios.get(url).then(response=>{
                if (response.data.givenname){this.usuario.nombre = response.data.givenname[0];}
                if (response.data.sn){this.usuario.apellido = response.data.sn[0];}
                if (response.data.mail){this.usuario.email = response.data.mail[0];}
                if (response.data.l){this.usuario.ciudad = response.data.l[0];}
                if (response.data.c){this.usuario.pais = response.data.c[0]};
                if (response.data.mobile){this.usuario.celular = response.data.mobile[0];}
                if (response.data.ipphone){this.usuario.telefono = response.data.ipphone[0];}
                if (response.data.title){this.usuario.puesto = response.data.title[0];}
                if (response.data.department){this.usuario.departamento = response.data.department[0];}
                if (response.data.company){this.usuario.organizacion = response.data.company[0]};
                $('#show').modal('show');
            });
        },
        handleEdit: function (index, row){
            this.updateUser = { nombre: '', apellido: '', email: '', ciudad: '', pais: '', celular: '', telefono: '', puesto: '', departamento: '', organizacion: '', objectguid: ''  }
            var url = '/api/usuarios/mostrar/' + row.objectguid;
            axios.get(url).then(response => {
                if (response.data.givenname) { this.updateUser.nombre = response.data.givenname[0]; }
                if (response.data.sn) { this.updateUser.apellido = response.data.sn[0]; }
                if (response.data.mail) { this.updateUser.email = response.data.mail[0]; }
                if (response.data.l) { this.updateUser.ciudad = response.data.l[0]; }
                if (response.data.c) { this.updateUser.pais = response.data.c[0] };
                if (response.data.mobile) { this.updateUser.celular = response.data.mobile[0]; }
                if (response.data.ipphone) { this.updateUser.telefono = response.data.ipphone[0]; }
                if (response.data.title) { this.updateUser.puesto = response.data.title[0]; }
                if (response.data.department) { this.updateUser.departamento = response.data.department[0]; }
                if (response.data.company) { this.updateUser.organizacion = response.data.company[0] };
                if (response.data.objectguid) { this.updateUser.objectguid = response.data.objectguid};
                $('#edit').modal('show');
            });
        },
        cerrarShow:function(){
            this.updateUser = { nombre: '', apellido: '', email: '', ciudad: '', pais: '', celular: '', telefono: '', puesto: '', departamento: '', organizacion: '', updateUser:'' };
            $('#edit').modal('hide');
        },
        putUser:function(){
            var url = '/api/usuarios/' + this.updateUser.objectguid;
            axios.put(url,this.updateUser).then(response=>{
                $('#edit').modal('hide');            
                this.updateUser = { nombre: '', apellido: '', email: '', ciudad: '', pais: '', celular: '', telefono: '', puesto: '', departamento: '', organizacion: '', updateUser: '' };    
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
