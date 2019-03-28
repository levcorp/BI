import Vue from 'vue';
import axios from 'axios';
Vue.component('pagination', require('laravel-vue-pagination'));
import swal from 'sweetalert';

new Vue({
    el  : '#solicitud',
    data: {
        solicitudesPendiente:{},
        solicitudesRealizado:{},
        paginacionPendiente:'5',
        paginacionRealizado:'5',
        solicitud:{
            numero:'',
            fecha: new Date(),
            usuario_id:22,
        },
        numero:0,
    },
    mounted() {
        this.getResultadoRealizado();
        this.getResultadoPendiente();
    },
    created(){
        
    },
    methods: {
        getnumero: function(){
            axios.get('/api/solicitud/numero')
            .then(response => {
                this.solicitud.numero=response.data;
            });
        },
        getResultadoPendiente(page = 1) {
			axios.get('/api/solicitud/datos/'+this.paginacionPendiente +'/pendiente?page=' + page)
				.then(response => {
                    this.solicitudesPendiente = response.data;
                    this.getnumero();
                });
        },
        getResultadoRealizado(page = 1){
            axios.get('/api/solicitud/datos/'+ this.paginacionRealizado +'/realizado?page=' + page)
                .then(response => {
                    this.solicitudesRealizado = response.data;
                    this.getnumero();
                });
        },
        getPaginacionPendiente: function(numero){   
            this.paginacionPendiente=numero;
            this.getResultadoPendiente();
        },
        getPaginacionRealizado: function(numero){   
            this.paginacionRealizado=numero;
            this.getResultadoRealizado();
        },
        postSolicitud:function()
        {
            var url='/api/solicitud';
            axios.post(url,this.solicitud).then(response =>{
                this.getResultadoPendiente();
                $('#myModal').modal('hide');
                swal({
                    title: "Exito!!!!",
                    text: "Usuario registrado correctamente.",
                    icon: "success",
                });
            });
        },
        deleteSolicitud:function (id)
        {
            swal({
                title: "Eliminar Registro",
                text: "¿ Esta seguro de borrar el registro ?",
                icon: "warning",
                buttons: ["Cancelar","Eliminar"],
                dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                    var url='/api/solicitud/'+id;
                    axios.delete(url).then(response=>{
                        this.getResultadoPendiente();                
                    });
                    swal("¡ Registro Eliminado Correctamente ! ", {
                        icon: "success",
                    });
                }
              });
        }
    },
});