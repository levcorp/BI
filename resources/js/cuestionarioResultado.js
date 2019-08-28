import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import Vue2Filters from 'vue2-filters'
import VueMoment from 'vue-moment';
import VueApexCharts from 'vue-apexcharts'
Vue.use(VueApexCharts)

locale.use(lang);
Vue.use(ElementUI);
Vue.use(Vue2Filters)
const moment = require('moment')
require('moment/locale/es')
 
Vue.use(require('vue-moment'), {
    moment
});

var colors = ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0', '#546E7A', '#26a69a', '#D10CE8'];
var Main = {
    components: {
        apexchart: VueApexCharts,
    },
    data() {
        return {
            activeNames: [],
            cuestionarios:[],
            respuestas:[],
            preguntas:[],
            cuestionario_id:'',
            cuestionario:[],
            showPreguntas:false,
            rule:{

            },
            loading:false,
        }
    },
    mounted() {
        this.handleGetCuestionarios();
    },
    methods: {
        handleGetCuestionarios(){
            var url='/api/cuestionarios/resultados/cuestionarios';
            axios.get(url).then(response=>{
                this.cuestionarios=response.data
            });
        },
        handleGetPreguntas(){
            var url='/api/cuestionarios/resultados/preguntas';
            axios.post(url,{
                CUESTIONARIO_ID:this.cuestionario_id
            }).then(response=>{
                this.preguntas=response.data;
                this.showPreguntas=true;
                this.handleGetCuestionario();
            });
        },
        handleGetCuestionario(){
            var url='/api/cuestionarios/resultados/cuestionario';
            axios.post(url,{
                CUESTIONARIO_ID:this.cuestionario_id
            }).then(response=>{
                this.cuestionario=response.data
            });
        },
        handleBack(){
            this.showPreguntas=false;         
            this.activeNames= [];
        },
        handleReporte(){
            this.loading=true;
            var urlApi = '/api/cuestionarios/resultado/pdf/' + this.cuestionario.id;
            axios({
                url: urlApi,
                method: 'GET',
                responseType: 'blob', // important
            }).then(response => {
                const url = window.URL.createObjectURL(new Blob([response.data]));
                const link = document.createElement('a');
                link.href = url;
                link.setAttribute('download',(this.cuestionario.TITULO).replace(/ /,"_")+'.pdf'); //or any other extension
                document.body.appendChild(link);
                link.click();
                this.loading=false;
                this.$message({
                    message: 'Se descargo el archivo ' +this.cuestionario.TITULO,
                    type: 'success'
                });
            });
        }
    },
}
var Ctor = Vue.extend(Main);
new Ctor().$mount('#app');