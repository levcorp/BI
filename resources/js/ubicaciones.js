import Vue from 'vue';
import axios from 'axios';
import ElementUI, { Switch } from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import Vue2Filters from 'vue2-filters'
import round from 'vue-round-filter';
const moment = require('moment');
require('moment/locale/es');
require('vue2-animate/dist/vue2-animate.min.css')
Vue.use(Vue2Filters)
Vue.use(round)

Vue.use(require('vue-moment'), {
    moment
});
locale.use(lang);
Vue.use(ElementUI);
var Main={
    filters:{
        round,
    },
    data() {
        return {
            createList:{
                FECHA_CREACION:new Date(),
                USUARIO_ID:''
            },
            listsPendiente:[],
            listsRealizado:[],
            view:1,
            sucursal:'',// WhsCode=>Sucursal_id
            ubicacionesNull:[],
            loading:{
                ubicacionesNull:false,
                articulos:false,
            },
            search:{
                ubicacionesNull:'',
                articulos:'',
                codVenta:'',
                ciudad:''
            },
            lista:[],
            ubicaciones:[],
            articulos:[],
            rulesArticulos:{
                codVenta: [{ required: true, message: 'El campo es requerido', trigger: 'change' }],
            },
            ubicacion:[],
            usuario_id:'',
            ciudad:{
                new:'',
                init:'',
                add:''
            }
        }
    },
    mounted() {
        this.handleGetPendiente();
        this.handleGetRealizado();
    },
    methods: {
        handleGetPendiente(){
            var url='/api/ubicacion/get';
            axios.post(url,{
                'estado':0,
                'usuario_id':this.usuario_id
            }).then(response=>{
                this.listsPendiente=response.data;
            });
        },
        handleGetRealizado(){
            var url='/api/ubicacion/get';
            axios.post(url,{
                'estado':1,
                'usuario_id':this.usuario_id
            }).then(response=>{
                this.listsRealizado=response.data;
            });
        },
        handleAddView(index,row){
            this.lista=row;
            this.view=2;
            this.handleArticulosUbicacion();
            this.handleUbicacionNull();
            //console.log(this.lista);
        },
        handleStore(){
            var url='/api/ubicacion/store';
            axios.post(url,this.createList).then(response=>{
                this.handleGetPendiente();
                $('#create').modal('hide');
            });
        },
        handleCreate(){
            $('#create').modal('show');
        },
        handleBack(){
            this.view=1;
        },
        handleUbicacionNull(){
            var url='/api/ubicacion/null';
            this.loading.ubicacionesNull=true
            axios.post(url,{
                'WhsCode':this.sucursal,
                'lista_id':this.lista.id
            }).then(response=>{
                this.ubicacionesNull=response.data
                this.loading.ubicacionesNull=false;
            });
        },
        handleAdd(){
            $('#add').modal('show');
        },
        handelChoseUbicacionNull(option){
            var url='/api/ubicacion/chosenull';
            this.loading.ubicacionesNull=true;
            this.ciudad.new=option
            axios.post(url,{
                WhsCode:option
            }).then(response=>{
                this.ubicacionesNull=response.data
                this.loading.ubicacionesNull=false
            });
           // dc:a2:66:52:7a:35
        },
        handleArticulosUbicacion(){
            var url='/api/ubicacion/items';
            axios.post(url,{
                LISTA_ID:this.lista.id,
            }).then(response=>{
                this.ubicaciones=response.data;
            });
        },
        handleDeleteList(index,row){
            this.$confirm('¿ Eliminar Lista Ubicaciones ?', 'Warning', {
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                type: 'warning'
            }).then(() => {
                var url ='/api/ubicacion/delete/'+row.id;
                axios.delete(url).then(response=>{
                    this.handleGetPendiente();
                    this.$message({
                        type:'success',
                        message:'La lista fue eliminada correctamente'
                    });
                });
            }).catch(() => {
            });
        },
        handleSearchCodVenta(){
            this.$refs['formArticulos'].validate((valid) => {
                if (valid) {
                    this.loading.articulos=true;
                    var url='/api/ubicacion/searchcodventa';
                    axios.post(url,{
                        'codVenta':this.search.codVenta,
                        'ciudad':this.ciudad.add?this.ciudad.add:this.ciudad.init
                    }).then(response=>{
                        this.loading.articulos=false;
                        this.articulos=response.data;
                    });
                } else {
                    console.log('error submit!!');
                    return false;
                }
            });
        },
        handleStoreItem(index,row){
            switch (row.WhsCode) {
                case 'LPZ001':
                    var almacen='7'
                    break;
                case 'SCZ001':
                    var almacen='11';
                    break;
                case 'CBB001':
                    var almacen='0';
                    break;
            }
            var url='/api/ubicacion/item/store';
            axios.post(url,{
                'ITEMCODE':row.ItemCode,
                'COD_VENTA':row.U_Cod_Vent,
                'COD_COMPRA':row.U_Cod_comp,
                'DESCRIPCION':row.ItemName,
                'MEDIDA':row.InvntryUom,
                'STOCK':row.OnHand,
                'ALMACEN':row.WhsCode,
                'COD_ALMACEN':almacen,
                'LISTA_ID':this.lista.id
            }).then(response=>{
                this.handleArticulosUbicacion();
                this.handleUbicacionNull();
                $('#add').modal('hide');
                this.$message({
                    type:'success',
                    message: 'Articulo añadido correctamente'
                });
            });
        },
        handleDeleteItem(index,row){
            this.$confirm('¿ Eliminar Articulo ?', 'Warning', {
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar',
                type: 'warning'
            }).then(() => {
                var url='/api/ubicacion/item/delete/'+row.id;
                axios.delete(url).then(reponse=>{
                    this.handleArticulosUbicacion();
                    this.handleUbicacionNull();
                    this.$message({
                        type:'success',
                        message:'Articulo eliminado correctamente'
                    })
                });
            }).catch(() => {
            });
        },
        handleUpdateUbicacion(index,row){
            var url='/api/ubicacion/item/update';
            axios.post(url,{
                'id':row.id,
                'UBICACION_FISICA':this.ubicacion[index]
            }).then(response=>{
                this.handleArticulosUbicacion();
                this.$message({
                    type:'success',
                    message:'La ubicacion fue actualizada correctamente'
                })
            });
        },
        handleDeleteUbicacion(index,row){
            var url='/api/ubicacion/item/deleteubic';
            axios.post(url,{
                'id':row.id
            }).then(response=>{
                this.handleArticulosUbicacion();
                this.$message({
                    type:'success',
                    message:'La ubicacion fue removida correctamente'
                })
            });
        },
        handleExportForItem(){
            this.$confirm('¿ Enviar Solicitud ?', 'Warning', {
                confirmButtonText: 'Enviar',
                cancelButtonText: 'Cancelar',
                type: 'warning'
            }).then(() => {
                const loading = this.$loading({
                    lock: true,
                    text: 'Enviando....',
                    background: 'rgba(255, 255, 255)'
                });
                var url='/api/ubicacion/item/export/'+this.lista.id;
                axios.get(url).then(response=>{
                    var urlMail='/api/ubicacion/item/mail/'+this.lista.id;
                    axios.get(urlMail).then(response=>{
                        this.handleArticulosUbicacion();
                        this.handleGetPendiente();
                        this.handleGetRealizado();
                        this.handleBack();
                        loading.close();
                    });
                });
            }).catch(() => {
            });
        },
        handleExportForList(index,row){
            this.$confirm('¿ Enviar Solicitud ?', 'Warning', {
                confirmButtonText: 'Enviar',
                cancelButtonText: 'Cancelar',
                type: 'warning'
            }).then(() => {
                const loading = this.$loading({
                    lock: true,
                    text: 'Enviando...',
                    background: 'rgba(255, 255, 255)'
                });
                var url='/api/ubicacion/item/export/'+row.id;
                axios.get(url).then(response=>{
                    var urlMail='/api/ubicacion/item/mail/'+row.id;
                    axios.get(urlMail).then(response=>{
                        this.handleGetPendiente();
                        this.handleGetRealizado();
                        loading.close();
                    });
                });
            }).catch(() => {
            });
        },
        handleChoseSucursal(command){
            switch (command) {
                case 'La Paz':
                    this.ciudad.add='La Paz'
                    break;
            
                case 'Cochabamba':
                    this.ciudad.add='Cochabamba'

                    break;

                case 'Santa Cruz':
                    this.ciudad.add='Santa Cruz'

                    break;
            }
        }
    }
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');
