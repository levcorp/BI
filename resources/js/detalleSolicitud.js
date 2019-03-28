import Vue from 'vue';
import axios from 'axios';
import swal from 'sweetalert';
Vue.component('pagination', require('laravel-vue-pagination'));

new Vue({
    el: '#detalle',
    data:{
        detalles:{},
        paginacion:5,
        selected:'',
        fabricante:'',
        fdisabled:false,
        proveedor:'',
        pdisabled:false,
    },
    watch:{
        selected:function(){
            switch(this.selected){
                case "ROCKWELL AUTOMATION":
                    this.fabricante='ALLEN BRADLEY';
                    this.fdisabled=true;
                    this.proveedor='ROCKWELL AUTOMATION ARGENTINA S.A.';
                    this.pdisabled=true;
                break;
                case "FESTO":
                    this.fabricante='FESTO';
                    this.fdisabled=true;
                    this.proveedor='FESTO AG';
                    this.pdisabled=true;
                break;
                case "ENDRESS+HAUSER":
                    this.fabricante='ENDRESS + HAUSER';
                    this.fdisabled=true;
                    this.proveedor='ENDRESS + HAUSER INTERNATIONAL AG';
                    this.pdisabled=true;
                break;
                case "KAESER":
                    this.fabricante='KAESER'
                    this.fdisabled=true;
                    this.proveedor='KAESER COMPRESORES';
                    this.pdisabled=true;

                break;
                case "YALE":
                    this.fabricante='YALE'
                    this.fdisabled=true;
                    this.proveedor='COLUMBUS McKINNON DE URUGUAY S.A.';
                    this.pdisabled=true;
                break;
                case "BELDEN":
                    this.fabricante='BELDEN';
                    this.fdisabled=true;
                    this.proveedor='BELDEN';
                    this.pdisabled=true;
                break;
                case "MANUAL":
                    this.fabricante='';
                    this.fdisabled=false;
                    this.proveedor='';
                    this.pdisabled=false;
                break;
            }
        }
    },
    mounted(){
        this.getResultadoDetalle();
    },
    methods:{
        getResultadoDetalle(page=1){
           var url='/api/solicitud/'+this.paginacion+'/detalles?page=' + page;
           axios.get(url).then(response=>{
               this.detalles=response.data;
           })
        },
        getPaginacionDetalle:function(numero)
        {   
            this.paginacion=numero;
            this.getResultadoDetalle();
        }
    }
});