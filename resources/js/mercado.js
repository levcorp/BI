import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
locale.use(lang);
Vue.use(ElementUI);
var Main = {
    data() {
        return {
            mercados:[],
            search:'',
            createMercado:{
                NOMBRE:'',
                DESCRIPCION:''
            },
            updateMercado:{
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
        handleGet(){
            var url='/api/mercados';
            axios.get(url).then(response=>{
                this.mercados=response.data;
            });
        },
        handleCreate(){
            $('#create').modal('show');            

        },
        handleStore(){            
            this.$refs['createMercado'].validate((valid) => {
                if (valid) {
                    var url='/api/mercados';
                    axios.post(url,this.createMercado).then(response=>{
                        this.createMercado.NOMBRE='';
                        this.createMercado.DESCRIPCION='';
                        this.handleGet();
                        this.$refs['createMercado'].resetFields();
                        $('#create').modal('hide');                        
                        this.$message({
                            type:'success',
                            message:'El mercado fue creado correctamente'
                        })
                    });
                } else {
                  console.log('error submit!!');
                  return false;
                }
            });
        },
        handleEdit(index,row){
            this.updateMercado.id=row.id;
            this.updateMercado.NOMBRE=row.NOMBRE;
            this.updateMercado.DESCRIPCION=row.DESCRIPCION;
            $('#edit').modal('show');                        
        },
        handleUpdate(){
            this.$refs['updateMercado'].validate((valid) => {
                if (valid) {
                    var url='/api/mercados/'+this.updateMercado.id;
                    axios.put(url,this.updateMercado).then(response=>{
                        $('#edit').modal('hide');                        
                        this.handleGet();
                        this.$message({
                            type:'success',
                            message:'El mercado fue actualizado correctamente'
                        });
                    });
                } else {
                  console.log('error submit!!');
                  return false;
                }
              });
        },
        handleDelete(index, row){
            this.$confirm('Eliminar Mercado '+ row.NOMBRE + ' ?', 'Warning', {
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                type: 'warning'
              }).then(() => {
                var url='/api/mercados/'+row.id;
                axios.delete(url).then(response=>{
                    this.handleGet();   
                    this.$message({
                        type: 'success',
                        message: 'El mercado se elimino correctamente'
                      });
                });
              }).catch(() => {
              });
        }
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');
