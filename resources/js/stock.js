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
        var validateU_Cod_Vent = (rule, value, callback) => {
            if (value === '' && this.inputs.ItemName==='') {
                callback(new Error('El campo de Cod. Venta es requerido'));
            }else {
            callback();
            }
        };
        var validateItemName = (rule, value, callback) => {
            if (value === '' && this.inputs.U_Cod_Vent==='') {
                callback(new Error('El campo de ItemName es requerido'));
            }else {
            callback();
            }
        };
        return {
            inputs:{
                ItemName:'',
                U_Cod_Vent:''
            },
            items:[],
            loading:false,
            stock:[],
            loadingStock:false,
            item:[],
            rules: {
                U_Cod_Vent: [
                    { validator: validateU_Cod_Vent, trigger: 'change' },
                    { min: 2, message: 'El minimo de caracteres es 2', trigger: 'change' }
                ],
                ItemName: [
                    { validator: validateItemName, trigger: 'change' },
                    { min: 3, message: 'El minimo de caracteres es 3', trigger: 'change' }
                ]
            }
        }
    },
    methods: {
        
        handleGet(){
            this.$refs['inputs'].validate((valid) => {
                if (valid) {
                      var url = '/api/stock';
                    this.items=[];
                    this.loading=true;
                    axios.post(url,{
                        ItemName : this.inputs.ItemName,
                        U_Cod_Vent : this.inputs.U_Cod_Vent
                    }).then(response=>{
                        if (response.data) {
                            this.items=response.data;
                            this.$message({
                                type: 'success',
                                message: 'Se encontro articulos coincidentes!'
                            });
                            this.loading=false;
                            this.$refs['inputs'].resetFields();
                        }else{
                            this.loading=false
                            this.$message({
                                message: 'No se encontraron articulos coincidentes!'
                            });
                            this.$refs['inputs'].resetFields();
                        }
                    });
                } 
                else {
                    return false;
                }
            });
          
        },
        handleShow(index,row){
            var url='/api/stock/detalle';
            this.stock=[];
            this.item=[];
            $('#show').modal('show');         
            this.loadingStock=true;
            axios.post(url,{
                U_Cod_Vent : row.U_Cod_Vent
            }).then(response=>{
                this.stock=response.data;
                this.loadingStock=false;
                this.item=row;
                this.$message({
                    message: 'Detalle de articulo cargado correctamente!'
                });
            });
        }
    }
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#stock');
