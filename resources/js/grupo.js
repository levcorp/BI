import Vue from 'vue';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import { isThisQuarter } from 'date-fns';
locale.use(lang);
Vue.use(ElementUI);
var Main = {
    data() {
        return {
            asignaciones:[],
            searchUsuarios:'',
            searchGrupos:'',
            usuarios:[],
            searchAsignaciones:'',
            grupos:[],
            grupo:[],
            createGrupo:{
                NOMBRE:'',
                DESCRIPCION:''
            },
            editGrupo:{
                id:'',
                NOMBRE:'',
                DESCRIPCION:''
            },
            rules:{
                NOMBRE: [
                    { required: true, message: 'El campo nombre es requerido', trigger: 'change' },
                    { min: 3, message: 'Se require al menos 3 caracteres', trigger: 'change' }
                ],
                DESCRIPCION: [
                    { required: true, message: 'El campo descripcion es requerido', trigger: 'change' },
                    { min: 5, message: 'Se require al menos 5 caracteres', trigger: 'change' }
                ],
            }
        }
    },
    mounted() {
        this.handleGet();
    },
    methods: {
        handleGetUsuarios(id){
            var url='/api/grupos/usuarios/'+id;
            axios.get(url).then(response=>{
                this.usuarios=response.data;
            });
        },
        handleGet(){
            var url='/api/grupos'
            axios.get(url).then(response=>{
                this.grupos=response.data;
            });
        },
        handleCreate(){
            $('#create').modal('show');            
        },
        handleStore(){
            this.$refs['createGrupoForm'].validate((valid) => {
                if (valid) {
                    var url='/api/grupos';  
                    axios.post(url,this.createGrupo).then(response=>{
                        this.createGrupo.NOMBRE='';
                        this.createGrupo.DESCRIPCION='';
                        this.handleGet();
                        this.$refs['editGrupoForm'].resetFields();
                        $('#create').modal('hide');                        
                        this.$message({
                            type:'success',
                            message:'El grupo fue creado correctamente'
                        })
                    });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handleEdit(index,row){
            $('#edit').modal('show');    
            this.editGrupo.NOMBRE=row.NOMBRE;
            this.editGrupo.id=row.id;
            this.editGrupo.DESCRIPCION=row.DESCRIPCION;
            this.grupo=row;        
        },
        handleUpdate(){
            this.$refs['editGrupoForm'].validate((valid) => {
                if (valid) {
                    var url='/api/grupos/'+this.grupo.id;  
                    axios.put(url,this.editGrupo).then(response=>{
                        this.editGrupo.NOMBRE='';
                        this.editGrupo.DESCRIPCION='';
                        this.handleGet();
                        this.$refs['editGrupoForm'].resetFields();
                        $('#edit').modal('hide');                        
                        this.$message({
                            type:'success',
                            message:'El grupo fue actualizado correctamente'
                        })
                    });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handleDelete(index,row){
            this.$confirm('Eliminar Grupo ?', 'Warning', {
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                type: 'warning'
              }).then(() => {
                var url='/api/grupos/'+row.id;
                axios.delete(url).then(response=>{
                    this.handleGet();   
                    this.asignaciones=[],
                    this.$message({
                        type: 'success',
                        message: 'El grupo se elimino correctamente'
                      });
                });
              }).catch(() => {
              });
        },
        handleAssignment(index,row){
            $('#add').modal('show');    
            this.grupo=row;        
            this.handleGetUsuarios(row.id);
        },
        handleAssignmentCreate(index,row){
            var url='/api/grupos/asignacion';
            axios.post(url,{
                GRUPO_ID:this.grupo.id,
                USUARIO_ID:row.id
            }).then(response=>{
                this.handleGetUsuarios(this.grupo.id);
                this.handleGetAssignment(this.grupo.id);
                this.$message({
                    type:'success',
                    message:'La asignacion se realizo correctamente'
                });
            });     
        },
        handleGetAssignment(grupo_id){
            var url='/api/grupos/asignaciones';
            axios.post(url,{
                GRUPO_ID:grupo_id
            }).then(response=>{
                this.asignaciones=response.data;
            });
        },
        handleAssignmentDelete(index,row){
            this.$confirm('Eliminar Asignacion ?', 'Warning', {
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                type: 'warning'
              }).then(() => {
                var url='/api/grupos/asigdelete';
                axios.post(url,{
                    ASIGNACION_ID:row.id
                }).then(response=>{
                    this.handleGetAssignment(row.GRUPO_ID);
                    this.$message({
                        type:'success',
                        message:'La asignacion se elimino correctamente'
                    });
                });
              }).catch(() => {
              });
        },
        handleCurrentChange(val) {
            this.handleGetAssignment(val.id);
        }
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');
