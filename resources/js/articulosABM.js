import Vue from 'vue';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import Vue2Filters from 'vue2-filters'
const moment = require('moment');
require('moment/locale/es');
 
Vue.use(Vue2Filters)
Vue.use(require('vue-moment'), {
    moment
});
locale.use(lang);
Vue.use(ElementUI);

var Main={
   data() {
        var validateCodVenta = (rule, value, callback) => {
            if (!value) {
                callback(new Error('El campo es requerido'));
            }else{
                var url='/api/solicitud/detalle/cod_venta';
                axios.post(url,{
                    'value':value
                }).then(response=>{
                    if(response.data==1){
                        callback(new Error('El codigo ya esta en uso'));
                    }else{
                        callback();
                    }
                });
            }
        };
        var validateCodComp = (rule, value, callback) => {
            if (!value) {
                callback(new Error('El campo es requerido'));
            }else{
                var url='/api/solicitud/detalle/cod_compra';
                axios.post(url,{
                    'value':this.createItem.pre_cod+value
                }).then(response=>{
                    if(response.data==1){
                        callback(new Error('El codigo ya esta en uso'));
                    }else{
                        callback();
                    }
                });
            }
        };
        var validateSerie=(rule,value,callback)=>{
            if(!value){
                callback(new Error('El campo es requerido'));
            }else{
                if(value=='Rockwell Automation'){
                    this.createItem.fabricante='ALLEN BRADLEY';
                    this.createItem.proveedor='ROCKWELL AUTOMATION ARGENTINA S.A.';
                    this.disable.fabricante=true;
                    this.disable.proveedor=true;
                    this.createItem.pre_cod='ROCK-';
                    this.show.pre_cod=true;
                    this.show.upc=true;
                    callback();
                }else{
                    if(value=='Festo'){
                        this.createItem.fabricante='FESTO';
                        this.createItem.proveedor='FESTO AG';
                        this.disable.fabricante=true;
                        this.disable.proveedor=true;
                        this.createItem.pre_cod='FAG-';
                        this.show.pre_cod=true;
                        this.show.upc=false;
                        callback();
                    }else{
                        if(value=='Endress+Hauser'){
                            this.createItem.fabricante='ENDRESS + HAUSER';
                            this.createItem.proveedor='ENDRESS + HAUSER INTERNATIONAL AG';
                            this.disable.fabricante=true;
                            this.disable.proveedor=true;
                            this.createItem.pre_cod='EH-';
                            this.show.pre_cod=true;
                            this.show.upc=false;
                            callback();
                        }else{
                            if(value=='Kaeser'){
                                this.createItem.fabricante='KAESER';
                                this.createItem.proveedor='KAESER COMPRESORES';
                                this.disable.fabricante=true;
                                this.disable.proveedor=true;
                                this.createItem.pre_cod='KAE-';
                                this.show.pre_cod=true;
                                this.show.upc=false;
                                callback();
                            }else{
                                if(value=='Yale'){
                                    this.createItem.fabricante='YALE';
                                    this.createItem.proveedor='COLUMBUS McKINNON DE URUGUAY S.A.';
                                    this.disable.fabricante=true;
                                    this.disable.proveedor=true;
                                    this.createItem.pre_cod='CM-';
                                    this.show.pre_cod=true;
                                    this.show.upc=false;
                                    callback();
                                }else{
                                    if(value=='Belden'){
                                        this.createItem.fabricante='BELDEN';
                                        this.createItem.proveedor='BELDEN';
                                        this.disable.fabricante=true;
                                        this.disable.proveedor=true;
                                        this.createItem.pre_cod='BEL-';
                                        this.show.pre_cod=true;
                                        this.show.upc=false;
                                        callback();
                                    }else{
                                        if(value=='Manual'){
                                            this.disable.fabricante=false;
                                            this.disable.proveedor=false;
                                            this.show.upc=false;
                                            callback();
                                        }else{
                                            callback();
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
       return {
            listABMPendiente:[],
            listABMRealizado:[],
            usuario_id:'',
            createSolicitud:{
                numero:'',
                usuario_id:'',
                fecha:new Date(),
                nombre:''
            },
            show:{
                item:false,
                list:true,
                pre_cod:false,
                upc:false,
            },
            items:[],
            solicitud:[],
            solicitud_estado:'',
            series:[
                    {
                        value:'Manual',
                        label:'Manual'
                    },
                    {
                        value:'Rockwell Automation',
                        label:'Rockwell Automation'
                    },
                    {
                        value:'Festo',
                        label:'Festo'
                    },
                    {
                        value:'Endress+Hauser',
                        label:'Endress+Hauser'
                    },
                    {
                        value:'Kaeser',
                        label:'Kaeser'
                    },
                    {
                        value:'Yale',
                        label:'Yale'
                    },
                    {
                        value:'Belden',
                        label:'Belden'
                    },
                ],
            medidas:[
                {label:'PZA',value:'PZA'},
                {label:'MT',value:'MT'},
                {label:'LT',value:'LT'},
                {label:'BOLSA',value:'BOLSA'},
                {label:'ROLLO',value:'ROLLO'},
                {label:'PIE',value:'PIE'}
            ],
            createItem:{
                serie:'Manual',
                fabricante:'',
                proveedor:'',
                cod_especialidad:'',
                medida:'',
                cod_venta:'',
                cod_compra:'',
                descripcion:'',
                comentarios:'',
                upc:'',
                solicitud_id:'',
                pre_cod:''
            },
            especialidades:[],
            proveedores:[],
            fabricantes:[],
            loading:{
                proveedor:false,
                fabricante:false,
            },
            rulesItem:{
                serie:[{ validator: validateSerie, trigger: 'change' }],
                fabricante: [{ required: true, message: 'El campo es requerido', trigger: 'change' }],
                proveedor: [ { required: true, message: 'El campo es requerido', trigger: 'change' }],
                cod_especialidad: [{ required: true, message: 'El campo es requerido', trigger: 'change' }],
                medida: [{ required: true, message: 'El campo es requerido', trigger: 'change' }],
                cod_venta: [{ validator: validateCodVenta, trigger: 'change' }],
                cod_compra: [{ validator: validateCodComp, trigger: 'change' }],
                descripcion: [{ required: true, message: 'El campo es requerido', trigger: 'change' }],
                comentarios: [{ required: true, message: 'El campo es requerido', trigger: 'change' }],
            },
            disable:{
                fabricante:false,
                proveedor:false
            }
        }
   },
   mounted() {
       this.handleGetListABMRealizado();
       this.handleGetListABMPendiente();
   },
   watch: {
       'createItem.fabricante':function(newValue,OldValue){
           if(newValue){
               this.handleGetPreCod(newValue);
           }
       }
   },
   methods: {
        handleGetNumero: function(){
            axios.get('/api/solicitud/numero/'+this.usuario_id)
            .then(response => {
                this.createSolicitud.numero=response.data;
            });
        },
       handleGetListABMRealizado(){
            var url='/api/solicitud/getlist';
            axios.post(url,{
                usuario_id:this.usuario_id,
                tipo:'realizado'
            }).then(response=>{
                this.listABMRealizado=response.data;
            });
       },
       handleGetListABMPendiente(){
            var url='/api/solicitud/getlist';
            axios.post(url,{
                usuario_id:this.usuario_id,
                tipo:'pendiente'
            }).then(response=>{
                this.listABMPendiente=response.data;
            });
       },
       handleShow(index,row){
            const loading = this.$loading({
                lock: true,
                text: 'Cargando',
                background: 'rgba(255, 255, 255)'
            });
            this.show.item=true;
            this.show.list=false;
            this.solicitud=row;
            var url='/api/solicitud/detalle/items';
            axios.post(url,{
                 'solicitud_id':row.id
            }).then(response=>{
                 this.items=response.data;
                 var url='/api/solicitud/'+row.id;
                 axios.get(url).then(response=>{
                     this.solicitud_estado=response.data;
                     var url='/api/solicitud/detalle/datos/especialidades';
                     axios.get(url).then(responce=>{
                         this.especialidades=responce.data;
                         loading.close();
                     });
                 });
            });
       },
       handleGetSolicitudEstado(solicitud_id){
            var url='/api/solicitud/'+solicitud_id;
            axios.get(url).then(response=>{
                this.solicitud_estado=response.data;
            });
        },
       handleDelete(index,row){
            this.$confirm('¿ Eliminar Lista ABM ?', 'Warning', {
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                type: 'warning'
            }).then(() => {
                var url='/api/solicitud/'+row.id;
                axios.delete(url).then(response=>{
                    this.handleGetListABMPendiente();    
                    this.$message({
                        type: 'success',
                        message: 'Lista eliminada correctamente'
                    })            
                });
                
            }).catch(() => {
            });
       },
       handleMessage(index,row){
           //add Loading
            this.$confirm('¿ Enviar Solicitud ?', 'Warning', {
                confirmButtonText: 'Enviar',
                cancelButtonText: 'Cancelar',
                type: 'warning'
            }).then(() => {
                const loading = this.$loading({
                    lock: true,
                    text: 'Cargando',
                    background: 'rgba(255, 255, 255)'
                });
                var url='/api/solicitud/mail/'+row.id+"/"+moment().format('Y-MM-DDTh-mm-ss');
                axios.get(url).then(response=>{
                    if (response.status) {
                        this.handleGetListABMPendiente();
                        this.handleGetListABMRealizado();
                        this.$message({
                            type: 'success',
                            message: 'Correo enviado correctamente'
                        });
                    }
                    loading.close();                
                });
            }).catch(() => {
            });
       },
       handleCreateSolicitud(){
           this.handleGetNumero();
           this.createSolicitud.usuario_id=this.usuario_id;
           $('#create').modal('show');    
       },
       handleStoreSolicitud(){
            var url='/api/solicitud';
            axios.post(url,this.createSolicitud).then(response =>{
                this.handleGetListABMPendiente();
                $('#create').modal('hide');
                this.$message({
                    type: 'primary',
                    message: 'La lista fue creada correctamente'
                })
            });
       },  
       handleBack(){
            this.show.item=false;
            this.show.list=true;
            this.handleGetListABMRealizado();
            this.handleGetListABMPendiente();
       },
       handleGetItems(solicitud_id){
           var url='/api/solicitud/detalle/items';
           axios.post(url,{
                'solicitud_id':solicitud_id
           }).then(response=>{
                this.items=response.data;
           });
       },
       handleCreateItem(){
            $('#createItem').modal('show');    
       },
       handleGetEspecialidades(){
           var url='/api/solicitud/detalle/datos/especialidades';
           axios.get(url).then(responce=>{
               this.especialidades=responce.data;
           });
       },
       handleGetProveedores(value){
           if (value !== '') {
            this.loading = true;
                var url='/api/solicitud/detalle/proveedores';
                axios.post(url,{
                    'value':value
                }).then(responce=>{
                    this.proveedores=responce.data;
                    this.loading = false;
                });
          } else {
            this.proveedores = [];
          }
       },
       handleGetFabricantes(value){           
           if (value !== '') {
            this.loading = true;
                var url='/api/solicitud/detalle/fabricantes';
                axios.post(url,{
                    'value':value
                }).then(responce=>{
                    this.fabricantes=responce.data;
                    this.loading = false;
                });
          } else {
            this.fabricantes = [];
          }
       }, 
       handleStoreItem(){
            this.$refs['FormItem'].validate((valid) => {
                if (valid) {
                    const loading = this.$loading({
                        lock: true,
                        text: 'Cargando',
                        background: 'rgba(255, 255, 255)'
                    });
                    this.createItem.solicitud_id=this.solicitud.id;
                    var url='/api/solicitud/detalle/storeitem';
                    axios.post(url,this.createItem).then(response=>{
                        this.handleGetItems(this.solicitud.id);
                        $('#createItem').modal('hide');    
                        this.handleCleanItem();
                        this.$refs['FormItem'].resetFields();
                        loading.close();
                        this.$message({
                            type: 'success',
                            message: 'El articulo fue creado correctamente'
                        });
                    });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
       },
       handleCleanItem(){
            this.createItem.serie='Manual';
            this.createItem.fabricante='';
            this.createItem.proveedor='';
            this.createItem.cod_especialidad='';
            this.createItem.medida='';
            this.createItem.cod_venta='';
            this.createItem.cod_compra='';
            this.createItem.descripcion='';
            this.createItem.comentarios='';
            this.createItem.upc='';
            this.createItem.solicitud_id='';
            this.createItem.pre_cod='';
            this.show.pre_cod=false;
            this.disable.fabricante=false,
            this.disable.proveedor=false
       },
       handleDeleteItem(inde,row){
            this.$confirm('¿ Eliminar el articulo ?', 'Warning', {
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                type: 'warning'
            }).then(() => {
                var url='/api/solicitud/detalle/'+row.id;
                   axios.delete(url).then(response=>{
                        this.handleGetItems(this.solicitud.id);     
                        this.$message({
                            type: 'success',
                            message: 'El articulo fue eliminado correctamente'
                        });
                   });
            }).catch(() => {
            });
       },
       handleSendMail(){
            this.$confirm('¿ Enviar Solicitud ?', 'Warning', {
                            confirmButtonText: 'Enviar',
                            cancelButtonText: 'Cancelar',
                            type: 'warning'
            }).then(() => {
                const loading = this.$loading({
                    lock: true,
                    text: 'Cargando',
                    background: 'rgba(255, 255, 255)'
                });
                var url='/api/solicitud/mail/'+this.solicitud.id+"/"+moment().format('Y-MM-DDTh-mm-ss');
                axios.get(url).then(response=>{
                    if (response.status) {
                        this.handleGetSolicitudEstado(this.solicitud.id);
                        loading.close();
                        this.$message({
                            type: 'success',
                            message: 'La solicitud fue realizada'
                        });
                    }
                }).catch(function (error) {

                });
            }).catch(() => {
            });
       },
       handleGetPreCod(fabricante){
           var url='/api/solicitud/detalle/precod';
           axios.post(url,{
               'fabricante':fabricante
           }).then(response=>{
               this.createItem.pre_cod=response.data;
               this.show.pre_cod=true;
           });
       }
   },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#abm');  