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
        return{
            loadingPerfil:false,
            loadingUserRemove: false,
            loadingUserAdd: false,
            loadingRemove:false,
            loadingAdd:false,
            MAsearch:'',
            Usearch:'',
            Msearch: '',
            AUsearch:'',
            userRemove:[],
            userAdd:[],
            Uperfil:[],
            perfiles:[],
            search:'',
            perfil:{
                nombre:'',
                descripcion:'',
            },
            modulos:[],
            select:[],
            addmodulos:[],
            rules:{
                nombre: [
                    { required: true, message: 'El campo nombre de perfil es requerido', trigger: 'change' },
                    { min: 5, message: 'El campo debe contener al menos 5 caracteres', trigger: 'change' }
                ],
                descripcion: [
                    { required: true, message: 'El campo descripcion es requerido', trigger: 'change' },
                    { min: 5, message: 'El campo debe contener al menos 5 caracteres', trigger: 'change' }
                ],
            }
        }
    },
    created() {
        this.handleGet();
    },
    methods: {
        handleAdd(index,row){
            var url = '/api/perfiles/add/' + this.select.id + '/' + row.id;
            this.loadingAdd=true;
            axios.get(url).then(responce=>{
                this.handleShow(index, this.select);
                this.handleCurrentChange(this.select);
                this.$message({
                    message: 'Modulo añadido correctamente!!',
                    type: 'success'
                });
                this.loadingAdd = false;
            });
        },
        handleRemove(index,row){
            this.loadingRemove = true;
            var url = '/api/perfiles/remove/' + this.select.id + '/' + row.id;
            axios.get(url).then(responce=>{
                this.handleCurrentChange(this.select);
                this.$message({
                    message: 'Modulos eliminado correctamente.',
                    type: 'success'
                });
                this.loadingRemove = false;
            })
        },
        handleShow(index,row){
            var url='/api/perfiles/'+row.id;
            axios.get(url).then(response=>{
                this.addmodulos=response.data;
            });
        },
        handleGet: function () {
            this.loadingPerfil=true;
            var url = '/api/perfiles/';
            axios.get(url).then(response => {
                this.perfiles = response.data;
                this.loadingPerfil=false;
            });
        },
        handleCurrentChange(val) {
            this.select=val;           
            var url='/api/perfiles/'+this.select.id+'/edit/';
            axios.get(url).then(responce=>{
                this.modulos = responce.data;                
            });
            this.handleUserRemoveList();
        },
        handleAddModal : function (index, row) {
            this.handleShow(index,row)  
            $('#add').modal('show');
        },
        handleCreate: function (){
            $('#create').modal('show');
        },
        handleStore:function(){
            this.$refs['formCreate'].validate((valid) => {
                if (valid) {
                    var url = '/api/perfiles';
                    axios.post(url, this.perfil).then(response => {
                        this.handleGet();
                        $('#create').modal('hide');
                        this.$refs['formCreate'].resetFields();
                        this.$message({
                            message: 'Perfil creado correctamente!!.',
                            type: 'success'
                        })
                    });
                } else {
                    return false;
                }
            });
        },
        handleEdit(index,row){
            this.Uperfil = row;
            this.$refs['formUpdate'].resetFields();
            $('#edit').modal('show');   
        },
        handleUpdate: function (){
            this.$refs['formUpdate'].validate((valid) => {
                if (valid) {
                    var url = '/api/perfiles/'+this.Uperfil.id;
                    axios.put(url, this.Uperfil).then(response => {
                        this.handleGet();
                        $('#edit').modal('hide');
                        this.$refs['formUpdate'].resetFields();
                        this.$message({
                            message: 'Perfil editado correctamente',
                            type: 'success'
                        });
                    });
                } else {
                    return false;
                }
            });
        },
        handleUserAddList:function(id){
            var url='/api/perfiles/useraddlist/'+id;
            axios.get(url).then(response=>{
                this.userAdd=response.data;
            });
        },
        handleUserRemoveList:function(){
            var url='/api/perfiles/userremovelist/'+this.select.id;
            axios.get(url).then(response =>{
                this.userRemove=response.data;
            });
        },
        handleUserAdd(index,row){
            this.loadingUserAdd = true;
            var url='/api/perfiles/useradd';
            axios.post(url,{
                'user_id': row.id,
                'perfil_id': this.select.id
                }).then(response=>{
                    this.handleUserAddList(this.select.id)   
                    this.handleUserRemoveList()   
                    this.$message({
                        message: 'Asignacion realizada correctamente',
                        type: 'success'
                    });
                    this.loadingUserAdd = false;
                });
        },
        handleUserRemove(index, row){
            this.loadingUserRemove = true;
            var url = '/api/perfiles/userremove';
            axios.post(url, {
                'user_id': row.id,
                'perfil_id': this.select.id
            }).then(response => {
                this.handleUserRemoveList()
                this.$message({
                    message: 'Asignacion eliminada correctamente',
                    type: 'success'
                });
                this.loadingUserRemove = false;
            });
        },
        handleUserAddModal:function(index,row){
            this.handleUserAddList(row.id);
            $('#userAdd').modal('show');          
        }
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#perfil');
