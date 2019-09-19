import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import Vue2Filters from 'vue2-filters'
Vue.use(Vue2Filters)

locale.use(lang);
Vue.use(ElementUI);
var Main = {
    data() {
        return {
            inputs:{
                ItemName:'',
                U_Cod_Vent:'',
                FirmName:'',
                Type:''
            },
            items:[],
            loading:false,
            stock:[],
            loadingStock:false,
            item:[],
            rulesCod: {
                U_Cod_Vent: [
                    { required: true, message: 'El campo es requerido', trigger: 'change' },
                    { min: 2, message: 'El minimo de caracteres es 2', trigger: 'change' }
                ],
            },
            rulesDesc: {
                ItemName: [
                    { required: true, message: 'El campo es requerido', trigger: 'change' },
                    { min: 3, message: 'El minimo de caracteres es 3', trigger: 'change' }
                ]
            },
            rulesFab: {
                FirmName: [
                    { required: true, message: 'El campo es requerido', trigger: 'change' },
                ],
                ItemName: [
                    { required: true, message: 'El campo es requerido', trigger: 'change' },
                    { min: 3, message: 'El minimo de caracteres es 3', trigger: 'change' }
                ]
            },
            dropdownName:'Codigo de Venta',
            show:'cod',
            fabricantes:[],
        }
    },
    methods: {        
        handleGet(descForm){
            this.$refs[descForm].validate((valid) => {
                if (valid) {
                    var url = '/api/stock';
                    this.items=[];
                    this.loading=true;
                    axios.post(url,{
                        ItemName : this.inputs.ItemName,
                        U_Cod_Vent : this.inputs.U_Cod_Vent,
                        FirmName : this.inputs.FirmName,
                        Type : descForm,
                    }).then(response=>{
                        if (response.data) {
                            this.items=response.data;
                            this.$message({
                                type: 'success',
                                message: 'Se encontro articulos coincidentes!'
                            });
                            this.loading=false;
                            this.$refs[descForm].resetFields();
                        }else{
                            this.loading=false
                            this.$message({
                                message: 'No se encontraron articulos coincidentes!'
                            });
                            this.$refs[descForm].resetFields();
                        }
                    });
                } 
                else {
                    return false;
                }
            });
          
        },
        handleInputsReset(){
            this.inputs.ItemName='',
            this.inputs.U_Cod_Vent='',
            this.inputs.FirmCode=''
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
            });
        },
        handleSearchFor(command){
            switch (command) {
                case 'desc':
                    this.dropdownName='Descripción';
                    this.show='desc';
                    this.handleInputsReset();
                    break;
                case 'cod':
                    this.dropdownName='Codigo de Venta';              
                    this.show='cod';      
                    this.handleInputsReset();
                    break;
                case 'fab':
                    this.dropdownName='Fabricante';                    
                    this.show='fab';
                    var url="/api/stock/fabricantes";
                    this.handleInputsReset();
                    axios.get(url).then(response=>{
                        this.fabricantes=response.data;
                    });
                    break;
            }
        }
    }
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#stock');
