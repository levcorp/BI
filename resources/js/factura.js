import Vue from 'vue';
import VueQrcodeReader from "vue-qrcode-reader";
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

Vue.use(VueQrcodeReader);

new Vue({
    el:'#app',
    data() {
        return {
            result: '',
            error: '', 
            factura:{
                NIT_Emisor:'',
                Numero_Factura:'',
                Numero_Autorizacion:'',
                Fecha_Emision:'',
                Total:'',
                Importe_Credito_Fiscal:'',
                Codigo_Control:'',
                NIT_Comprador:'',
                Importe_ICE:'',
                Importe_Ventas:'',
                Importe_No_Sujeto:'',
                Descuentos:''
            }
        }
    },
    mounted() {
        
    },
    methods: {
        onDecode (result) {
            var values = result.split('|');
            this.factura.NIT_Emisor=values[0];
            this.factura.Numero_Factura=values[1];
            this.factura.Numero_Autorizacion=values[2];
            this.factura.Fecha_Emision=values[3];
            this.factura.Total=values[4];
            this.factura.Importe_Credito_Fiscal=values[5];
            this.factura.Codigo_Control=values[6];
            this.factura.NIT_Comprador=values[7];
            this.factura.Importe_ICE=values[8];
            this.factura.Importe_Ventas=values[9];
            this.factura.Importe_No_Sujeto=values[10];
            this.factura.Descuentos=values[11]
        },
        async onInit (promise) {
            try {
                await promise
            } catch (error) {
                if (error.name === 'NotAllowedError') {
                this.error = "ERROR: you need to grant camera access permisson"
                } else if (error.name === 'NotFoundError') {
                this.error = "ERROR: no camera on this device"
                } else if (error.name === 'NotSupportedError') {
                this.error = "ERROR: secure context required (HTTPS, localhost)"
                } else if (error.name === 'NotReadableError') {
                this.error = "ERROR: is the camera already in use?"
                } else if (error.name === 'OverconstrainedError') {
                this.error = "ERROR: installed cameras are not suitable"
                } else if (error.name === 'StreamApiNotSupportedError') {
                this.error = "ERROR: Stream API is not supported in this browser"
                }
            }
        }
    },
});