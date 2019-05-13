import Vue from 'vue';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import VueDataTables from 'vue-data-tables';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';

locale.use(lang);
Vue.use(VueDataTables)
Vue.use(ElementUI);
var EDILP = {
    data() {
        return {
            now: new Date().toISOString().slice(0, 10),
            date: new Date().toISOString().slice(0, 10),
            archivosLP: [],
            table: {
                border: true,
                //stripe: true,
            },
            titles: [
                { prop: "name", label: "Archivo", align: 'center' },
            ],
            filters: [{
                prop: 'name',
            }
            ],
            dowload: {
                label: 'Acciones',
                props: {
                    align: 'center',
                },
                buttons: [{
                    props: {
                        type: 'primary',
                        icon: 'el-icon-download',
                        size: 'small',
                    },
                    handler: row => {
                        var name = row.name;
                        var urlApi = '/api/gpos/download/lapaz/' + name;
                        axios({
                            url: urlApi,
                            method: 'GET',
                            responseType: 'blob', // important
                        }).then(response => {
                            const url = window.URL.createObjectURL(new Blob([response.data]));
                            const link = document.createElement('a');
                            link.href = url;
                            link.setAttribute('download', row.name); //or any other extension
                            document.body.appendChild(link);
                            link.click();
                            this.$message('Se descargo el archivo ' + JSON.stringify(row.name));
                        });
                    },
                    label: ''
                }]
            }
        }
    },
    mounted() {
        this.getEdiLP();
    },
    methods: {
        getEdiLP: function () {
            var url = '/api/gpos/lapaz';
            axios.get(url).then(response => {
                this.archivosLP = response.data;
            });
        },
        generar: function () {
            var url = '/api/gpos/generar/lapaz/';
            axios.get(url).then(response => {
                this.getEdiLP();
            })
        }
    },
}
var LP = Vue.extend(EDILP);
new LP().$mount('#lp');