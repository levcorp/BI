import Vue from 'vue/dist/vue.common.dev';
import axios from 'axios';
import swal from 'sweetalert';
import vSelect from 'vue-select';
Vue.config.devtools=false
Vue.component('v-select', vSelect)
Vue.component('pagination', require('laravel-vue-pagination'));

Vue.component('blog-post', {
    // camelCase in JavaScript
    props: ['postTitle'],
    template: '<h3>{{ postTitle }}</h3>'
  })
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
        selectEspecialidad:null,
        selectProveedor:null,
        selectFabricante:null,
        selectFamilia:null,
        selectSubfamilia:null,
        medida:'',
        cod_venta:'',
        cod_compra:'',
        descripcion:'',
        comentarios:''
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
                this.selectEspecialidad=null;
                this.selectFamilia=null;
                this.selectSubfamilia=null;
                this.getFamilias();
            }
        },
        selectEspecialidad:function(){
            if(this.selectEspecialidad !=null){
                this.selectFamilia=null;
                this.selectSubfamilia=null;
                this.getFamilias();
            }
        },
        selectFamilia:function(){
            if(this.selectFamilia !=null){
                this.selectSubfamilia=null
                this.getsubfamilias();
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
                var fab  = this.selectFabricante.FirmName;
              }
            var url='/api/solicitud/detalle/datos/familias/'+fab+'/'+this.selectEspecialidad.Especialidad;
            axios.get(url).then(responce=>{
                this.familias=responce.data;
            });
        },
        getsubfamilias:function(){
            if(this.fabricante !=null){
                var fab  = this.fabricante;
              }else{
                var fab  = this.selectFabricante.FirmName;
              }
            var url='/api/solicitud/detalle/datos/subfamilias/'+fab+'/'+this.selectEspecialidad.Especialidad+'/'+this.selectFamilia.Familia;
            axios.get(url).then(responce=>{
                this.subfamilias=responce.data;
            });
        },
        postDetalle:function(){
            var url='/api/solicitud/detalle';
            if(this.fabricante!=null){
              var fab  = this.fabricante;
              var cod_fab = this.cod_fabricante;
            }else{
                var fab  = this.selectFabricante.FirmName;
                var cod_fab = this.selectFabricante.FirmCode;
            }
            if(this.proveedor!=null)
            {
                var pro = this.proveedor;
                var cod_pro = this.cod_proveedor;
            }else{
                var pro = this.selectProveedor.CardName;
                var cod_pro = this.selectProveedor.CardCode;
            }
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
            axios.post(url,datos).then(responce=>{
                this.getResultadoDetalle();
                $('#myModal').modal('hide');
                swal({
                    title: "Exito!!!!",
                    text: "Articulo registrado correctamente.",
                    icon: "success",
                });
                this.borrarCampos();
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
            this.selectEspecialidad=null;
            this.selectFabricante=null;
            this.selectProveedor=null;
            this.selectFamilia=null;
            this.selectSubfamilia=null;
            this.medida=null;
            this.cod_venta=null;
            this.cod_compra=null;
            this.comentarios=null;
            this.descripcion=null;
            this.fabricante=null;
            this.proveedor=null;
            this.serie='MANUAL';
        } 
    }
});