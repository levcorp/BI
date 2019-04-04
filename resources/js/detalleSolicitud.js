import Vue from 'vue/dist/vue.common.dev';
import axios from 'axios';
import swal from 'sweetalert';
import vSelect from 'vue-select';
import VeeValidate , { Validator }from 'vee-validate';
import es from 'vee-validate/dist/locale/es';
Vue.config.devtools=false
Vue.component('v-select', vSelect)
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.use(VeeValidate);
Validator.localize('es', es);
new Vue({
    el: '#detalle',
    data:{
        detalles:{},
        paginacion:5,
        serie:'MANUAL',
        fabricante:null,
        cod_fabricante:null,
        fdisabled:false,
        proveedor:null,
        cod_proveedor:null,
        pdisabled:false,
        especialidades:[],
        proveedores:[],
        fabricantes:[],
        familias:[],
        subfamilias:[],
        selectEspecialidad:{
            Descripcion:null,
            Especialidad:null
        },
        selectProveedor:{
            CardCode:null,
            CardName:null
        },
        selectFabricante:{
            FirmName:null,
            FirmCode:null
        },
        selectFamilia:{
            Familia:null,
        },
        selectSubfamilia:{
            Subfamilia:null,
        },
        medida:'',
        cod_venta:'',
        cod_compra:'',
        descripcion:'',
        comentarios:'',
        detalle_id:'',
    },
    watch:{
        serie:function(){
            switch(this.serie){
                case "ROCKWELL AUTOMATION":
                    this.fabricante='ALLEN BRADLEY';
                    this.fdisabled=true;
                    this.proveedor='ROCKWELL AUTOMATION ARGENTINA S.A.';
                    this.pdisabled=true;
                    this.cod_fabricante='1';
                    this.cod_proveedor='PE-0010001'
                break;
                case "FESTO":
                    this.fabricante='FESTO';
                    this.fdisabled=true;
                    this.proveedor='FESTO AG';
                    this.pdisabled=true;
                    this.cod_fabricante='2';
                    this.cod_proveedor='PE-0010003'
                break;
                case "ENDRESS+HAUSER":
                    this.fabricante='ENDRESS + HAUSER';
                    this.fdisabled=true;
                    this.proveedor='ENDRESS + HAUSER INTERNATIONAL AG';
                    this.pdisabled=true;
                    this.cod_fabricante='4';
                    this.cod_proveedor='PE-0010002'
                break;
                case "KAESER":
                    this.fabricante='KAESER'
                    this.fdisabled=true;
                    this.proveedor='KAESER COMPRESORES';
                    this.pdisabled=true;
                    this.cod_fabricante='5';
                    this.cod_proveedor='PE-0010007'
                break;
                case "YALE":
                    this.fabricante='YALE'
                    this.fdisabled=true;
                    this.proveedor='COLUMBUS McKINNON DE URUGUAY S.A.';
                    this.pdisabled=true;
                    this.cod_fabricante='6';
                    this.cod_proveedor='PE-0010121'
                break;
                case "BELDEN":
                    this.fabricante='BELDEN';
                    this.fdisabled=true;
                    this.proveedor='BELDEN';
                    this.pdisabled=true;
                    this.cod_fabricante='9';
                    this.cod_proveedor='PE-0010021'
                break;
                case "MANUAL":
                    this.fabricante=null;
                    this.fdisabled=false;
                    this.proveedor=null;
                    this.pdisabled=false;
                    this.cod_fabricante=null;
                    this.cod_proveedor=null;
                break;
            }
        },
        selectFabricante:function(){
            if(this.selectFabricante != null){
                this.selectEspecialidad.Especialidad=null;
                this.selectEspecialidad.Descripcion=null;
                this.selectFamilia.Familia=null;
                this.familias=[];
                this.subfamilias=[];
                this.selectSubfamilia.Subfamilia=null;
                this.getFamilias();
                this.getEspecialidades();
            }else{
                this.selectEspecialidad.Especialidad=null;
                this.selectEspecialidad.Descripcion=null;
                this.selectFamilia.Familia=null;
                this.familias=[];
                this.subfamilias=[];
                this.selectSubfamilia.Subfamilia=null;
                this.getFabricantes();
                this.getEspecialidades();
            }
            if(this.selectFabricante==null)
            {
                this.errors.fabricante="Fabricante es requerido";
            }
        },
        selectEspecialidad:function(){
            if(this.selectEspecialidad !=null){
                this.selectFamilia.Familia=null;
                this.familias=[];
                this.subfamilias=[];
                this.selectSubfamilia.subfamilia=null;
                this.getFamilias();
            }else{
                this.selectFamilia.Familia=null;                
                this.subfamilias.Subfamilia=[];
                this.familias=[];
                this.subfamilias=[];
                this.getEspecialidades();
            }
        },
        selectFamilia:function(){
            if(this.selectFamilia !=null){
                this.selectSubfamilia.Subfamilia=null
                this.getsubfamilias();
            }else{
                this.selectSubfamilia.Subfamilia=null
                this.getFamilias();
            }
        }
    },
    mounted(){
            this.getResultadoDetalle();
            this.getEspecialidades();
            this.getProveedores();
            this.getFabricantes();
    },
    methods:{
        getResultadoDetalle(page=1){
           var url='/api/solicitud/'+ID+'/'+this.paginacion+'/detalles?page=' + page;
           axios.get(url).then(response=>{
               this.detalles=response.data;
           })
        },
        getPaginacionDetalle:function(numero)
        {   
            this.paginacion=numero;
            this.getResultadoDetalle();
        },
        getEspecialidades:function()
        {
            var url='/api/solicitud/detalle/datos/especialidades';
            axios.get(url).then(responce=>{
                this.especialidades=responce.data;
            });
        },
        getProveedores:function()
        {
            var url='/api/solicitud/detalle/datos/proveedores';
            axios.get(url).then(responce=>{
                this.proveedores=responce.data;
            })
        },
        getFabricantes:function()
        {
            var url='/api/solicitud/detalle/datos/fabricantes';
            axios.get(url).then(responce=>{
                this.fabricantes=responce.data;
            })
        }, 
        getFamilias:function()
        {
            if(this.fabricante !=null){
                var fab  = this.fabricante;
            }else{
                if(this.selectFabricante!=null){
                    var fab  = this.selectFabricante.FirmName;
                }
            }
            if(fab!=null && this.selectEspecialidad!=null){
                var url='/api/solicitud/detalle/datos/familias/'+fab+'/'+this.selectEspecialidad.Especialidad;
            axios.get(url).then(responce=>{
                this.familias=responce.data;
            });
            }
            
        },
        getsubfamilias:function(){
            if(this.fabricante !=null){
                var fab  = this.fabricante;
              }else{
                if(this.selectFabricante!=null){
                var fab  = this.selectFabricante.FirmName;
                }   
              }
            var url='/api/solicitud/detalle/datos/subfamilias/'+fab+'/'+this.selectEspecialidad.Especialidad+'/'+this.selectFamilia.Familia;
            axios.get(url).then(responce=>{
                this.subfamilias=responce.data;
            });
        },
        postDetalle:function(){
            this.$validator.validate();
            if(this.fabricante!=null){
              var fab  = this.fabricante;
              var cod_fab = this.cod_fabricante;
            }else{
                if(this.selectFabricante!=null){
                    var fab  = this.selectFabricante.FirmName;
                    var cod_fab = this.selectFabricante.FirmCode;            }   
            }
            if(this.proveedor!=null)
            {
                var pro = this.proveedor;
                var cod_pro = this.cod_proveedor;
            }else{
                if(this.selectProveedor!=null){
                    var pro = this.selectProveedor.CardName;
                    var cod_pro = this.selectProveedor.CardCode;              
                }   
            }
            if(pro !=null && fab !=null)
            {
                var datos={
                    serie:this.serie,
                    fabricante:fab,
                    cod_fabricante:cod_fab,
                    proveedor:pro,
                    cod_proveedor:cod_pro,
                    especialidad:this.selectEspecialidad.Descripcion,
                    cod_especialidad:this.selectEspecialidad.Especialidad,
                    familia:this.selectFamilia.Familia,
                    subfamilia:this.selectSubfamilia.Subfamilia,
                    medida:this.medida,
                    cod_venta:this.cod_venta,
                    cod_compra:this.cod_compra,
                    descripcion:this.descripcion,
                    comentarios:this.comentarios,
                    solicitud_id:ID,
                };
            }else{
                var datos={};
            }
            var url='/api/solicitud/detalle';   
            axios.post(url,datos).then(responce=>{
                this.getResultadoDetalle();
                this.borrarCampos();
                $('#myModal').modal('hide');
                swal({
                    title: "Exito!!!!",
                    text: "Articulo registrado correctamente.",
                    icon: "success",
                });
            });
        },
        deleteSolicitud:function(id)
        {
            swal({
                title: "Eliminar Registro",
                text: "¿ Esta seguro de borrar el articulo ?",
                icon: "warning",
                buttons: ["Cancelar","Eliminar"],
                dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                    var url='/api/solicitud/detalle/'+id;
                    axios.delete(url).then(response=>{
                        this.getResultadoDetalle();                
                    });
                    swal("¡ Registro Eliminado Correctamente ! ", {
                        icon: "success",
                    });
                }
              });
        },
        borrarCampos:function()
        {
            this.selectEspecialidad.Especialidad=null;
            this.selectEspecialidad.Descripcion=null;
            this.selectFabricante.FirmName=null;
            this.selectFabricante.FirmCode=null;
            this.selectProveedor.CardName=null;
            this.selectProveedor.CardCode=null;
            this.selectFamilia.Familia=null;
            this.selectSubfamilia.Subfamilia=null;
            this.medida='';
            this.cod_venta='';
            this.cod_compra='';
            this.comentarios='';
            this.descripcion='';
            this.fabricante=null;
            this.proveedor=null;
            this.serie='MANUAL';
            this.detalle_id=null;
            this.getEspecialidades();
            this.getFabricantes();
            this.getProveedores();
            this.getFamilias();
            this.getsubfamilias();
        },
        putArticulo:function(id){
            var url='/api/solicitud/detalle/'+id+'/edit';
            axios.get(url).then(response=>{
                if(response.data.serie=="MANUAL"){  
                    this.selectFabricante.FirmName=response.data.fabricante;
                    this.selectFabricante.FirmCode=response.data.cod_fabricante;
                    this.selectProveedor.CardName=response.data.proveedor;
                    this.selectProveedor.CardCode=response.data.cod_proveedor;
                }else{
                    this.proveedor=response.data.proveedor;
                    this.fabricante=response.data.fabricante;
                    this.cod_fabricante=response.data.cod_fabricante;
                    this.cod_proveedor=response.data.cod_proveedor;
                }
                this.serie=response.data.serie;  
                this.selectEspecialidad.Descripcion=response.data.especialidad;
                this.selectEspecialidad.Especialidad=response.data.cod_especialidad;
                this.selectFamilia.Familia=response.data.familia;
                this.selectSubfamilia.Subfamilia=response.data.subfamilia;
                this.medida=response.data.medida;
                this.cod_venta=response.data.cod_venta;
                this.cod_compra=response.data.cod_compra;
                this.descripcion=response.data.descripcion;
                this.comentarios=response.data.comentarios;
                this.detalle_id=response.data.id;
                this.getFamilias();
                this.getsubfamilias();
            });
        },
        updateArticulo:function(){
            if(this.fabricante!=null){
                var fab  = this.fabricante;
                var cod_fab = this.cod_fabricante;
              }else{
                  if(this.selectFabricante!=null){
                      var fab  = this.selectFabricante.FirmName;
                      var cod_fab = this.selectFabricante.FirmCode;            }   
                
              }
              if(this.proveedor!=null)
              {
                  var pro = this.proveedor;
                  var cod_pro = this.cod_proveedor;
              }else{
                  if(this.selectProveedor!=null){
                    var pro = this.selectProveedor.CardName;
                    var cod_pro = this.selectProveedor.CardCode;        
                  }   
              
              }
              if(pro !=null && fab !=null)
              {
                  var datos={
                      serie:this.serie,
                      fabricante:fab,
                      cod_fabricante:cod_fab,
                      proveedor:pro,
                      cod_proveedor:cod_pro,
                      especialidad:this.selectEspecialidad.Descripcion,
                      cod_especialidad:this.selectEspecialidad.Especialidad,
                      familia:this.selectFamilia.Familia,
                      subfamilia:this.selectSubfamilia.Subfamilia,
                      medida:this.medida,
                      cod_venta:this.cod_venta,
                      cod_compra:this.cod_compra,
                      descripcion:this.descripcion,
                      comentarios:this.comentarios,
                      solicitud_id:ID,
                  };
              }else{
                  var datos={};
              }
            var url='/api/solicitud/detalle/'+this.detalle_id;
            axios.put(url,datos).then(response=>{
                this.getResultadoDetalle();
                $('#EditSolicitud').modal('hide');
                swal({
                    title: "Exito!!!!",
                    text: "Articulo Editado correctamente.",
                    icon: "success",
                });
                this.borrarCampos();
            });
        }
    }
}); 