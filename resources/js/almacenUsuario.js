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
    return {
      values:{
        sucursal_id:'',
        usuario_id:''
      },
      listas:[],
      loading:{
        listas:false,
        articulos:false,
        articulosCheck:false
      },
      show:{
        listas:true,
        fabricantes:false,
        articulos:false
      },
      lista:[],
      fabricantes:[],
      articulos:[],
      fabricante:[],
      articulosCheck:[],
      createArticulo:{
        COD_VENTA:'',
        ITEMCODE:'',
        ITEMNAME:'',
        FABRICANTE:'',
        ONHAND:'',
        ALMACEN:'',
        FABRICANTE_ASIGNACION_ID:'',
        OBSERVACION:'',
        UBICACION:''
      }
    }
  },
  mounted() {
    this.handleGetListas();
  },
  methods: {
    handleGetListas() {
      this.loading.listas=true;
      axios.get('/api/almacen/usuario/get/listas/'+this.values.usuario_id).then(response=>{
        this.listas=response.data;
        this.loading.listas=false;
      })
    },
    handleShow(index,row){
      this.lista=row;
      this.show.listas=false;
      this.show.fabricantes=true;
      this.handleGetFabricantes();
    },
    handleBackList(){
      this.show.listas=true;
      this.show.fabricantes=false
      this.fabricantes=[];
    },
    handleGetFabricantes(){
      axios.post('/api/almacen/usuario/get/fabricantes',{
        id:this.lista.id,
      }).then(response=>{
        this.fabricantes=response.data;
      });
    },
    handleShowArticulos(fabricante){
      this.show.fabricantes=false;
      this.show.listas=false;
      this.show.articulos=true;
      this.fabricante=fabricante;
      this.handleGetArticulosUncheck();
      this.handleGetArticulosCheck();
    },
    handleGetArticulosUncheck(){
      this.loading.articulos=true;
      axios.post('/api/almacen/usuario/get/articulos',{
        'FirmCode':this.fabricante.COD_FABRICANTE,
        'sucursal_id':this.values.sucursal_id,
        'fabricante_asignacion_id':this.fabricante.id
      }).then(response=>{
        this.articulos=response.data;
        this.loading.articulos=false;
      });
    },
    handleBackFabricantes(){
      this.show.fabricantes=true;
      this.show.listas=false;
      this.show.articulos=false;
      this.articulos=[];
      this.fabricante=[];
      this.handleGetFabricantes();
    },
    handleGetArticulosCheck(){
      this.loading.articulosCheck=true;
      axios.post('/api/almacen/usuario/get/checkarticulo',{
        asignacion_fabricante_id:this.fabricante.id
      }).then(response=>{
          this.articulosCheck=response.data;
          this.loading.articulosCheck=false;
      });
    },
    handleStoreArticulosCheck(index,row){
      axios.post('/api/almacen/usuario/store/articulo',this.createArticulo).then(response=>{
        $('#validarArticulo').modal('hide');
        this.createArticulo.ITEMCODE='';
        this.createArticulo.ITEMNAME='';
        this.createArticulo.FABRICANTE='';
        this.createArticulo.ONHAND='';
        this.createArticulo.ALMACEN='';
        this.createArticulo.COD_VENTA='';
        this.createArticulo.FABRICANTE_ASIGNACION_ID='';
        this.createArticulo.UBICACION='';
        this.createArticulo.OBSERVACION='';
        this.handleGetArticulosUncheck();
        this.handleGetArticulosCheck();
      });
    },
    handleCreateArticulos(index,row){
      this.createArticulo.ITEMCODE=row.ItemCode;
      this.createArticulo.ITEMNAME=row.ItemName;
      this.createArticulo.FABRICANTE=row.FirmName;
      this.createArticulo.ONHAND=row.OnHand;
      this.createArticulo.ALMACEN=row.WhsCode;
      this.createArticulo.COD_VENTA=row.U_Cod_Vent;
      this.createArticulo.FABRICANTE_ASIGNACION_ID=this.fabricante.id;
      this.createArticulo.UBICACION=row.U_UbicFis;
      $('#validarArticulo').modal('show');
    }
  },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');
