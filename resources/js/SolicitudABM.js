import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
Vue.component('pagination', require('laravel-vue-pagination'));
import swal from 'sweetalert';
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
        usuario_id:'',
    },
    mounted() {

        this.getResultadoRealizado();
        this.getResultadoPendiente();
    },
    created(){
        
    },
    methods: {
        getnumero: function(){
            axios.get('/api/solicitud/numero/'+this.usuario_id)
            .then(response => {
                this.solicitud.numero=response.data;
            });
        },
        getResultadoPendiente(page = 1) {
			axios.get('/api/solicitud/datos/'+this.paginacionPendiente +'/'+this.usuario_id+'/pendiente?page=' + page)
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
            $.LoadingOverlaySetup({
                background: "rgba(0,192,239, 0.1)",
                image: "/images/spiner.gif",
                imageAnimation: "",
            });     
            $.LoadingOverlay("show");
            axios.get('/api/solicitud/datos/' + this.paginacionRealizado + '/' + this.usuario_id +'/realizado?page=' + page)
                .then(response => {
                    if (response.status) {
                        $.LoadingOverlay("hide");
                        this.solicitudesRealizado = response.data;
                        this.getnumero();
                    }
                }).catch(function (error) {
                    $.LoadingOverlay("hide");
                });;
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
                    $.LoadingOverlaySetup({
                        background: "rgba(0,192,239, 0.1)",
                        image: "/images/spiner.gif",
                        imageAnimation: "",
                    });
                    $.LoadingOverlay("show");
                    var url='/api/solicitud/mail/'+id+"/"+moment().format('Y-MM-DDTh-mm-ss');
                    axios.get(url).then(response=>{
                        if (response.status) {
                            this.getResultadoPendiente();
                            this.getResultadoRealizado();
                            $.LoadingOverlay("hide");
                            swal("¡ Correo Enviado Correctamente ! ", {
                                icon: "success",
                            });
                        }
                    });
                }
            });
        }
    },
});