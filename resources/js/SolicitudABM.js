import Vue from 'vue';
import axios from 'axios';
Vue.component('pagination', require('laravel-vue-pagination'));
import swal from 'sweetalert';
import moment from 'moment';
import toastr from 'toastr';
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
            usuario_id:'',
        },
        numero:0,
        fecha:'',
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
                    toastr.options = {
                        "closeButton": true,
                        "newestOnTop": false,
                        "progressBar": true,
                        "positionClass": "toast-bottom-right",
                        "preventDuplicates": false,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                      }
                    toastr.info('Solicitudes Cargadas Correctamente', {timeOut: 5000})
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
        },
        solicitudID:function(id){
            this.mail.solicitud_id=id;
        },
        sendMail:function(id)
        {    
            swal({
                title: "Enviar Correo",
                text: "¿ Esta seguro en enviar el correo electronico con la lista de articulos ?",
                icon: "warning",
                buttons: ["Cancelar","Enviar"],
                dangerMode: false,
              })
              .then((willDelete) => {
                if (willDelete) {
                    var url='/api/solicitud/mail/'+id+"/"+moment().format('Y-MM-DDTh-mm-ss');
                    axios.get(url).then(
                        this.getResultadoPendiente(),
                    );
                    swal("¡ Correo Enviado Correctamente ! ", {
                        icon: "success",
                    });
                }
            });
            this.getResultadoPendiente();
        }
    },
});