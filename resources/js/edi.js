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
/////////////////////////LA PAZ///////////////////////////////////////
var EDILP = {
    data() {
        return {
            archivosLP: [],
            table: {
                border: true,
                //stripe: true,
            },
            titles: [
                { prop: "name", label: "Archivo", align: 'center'},
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
                        var name=row.name;
                        var urlApi = '/api/edi/download/lapaz/'+name;
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
            var url = '/api/edi/lapaz';
            axios.get(url).then(response => {
                this.archivosLP = response.data;
            });
        },
        generar:function(){
            var url ='/api/edi/generar/lapaz';
            axios.get(url).then(response=>{
                this.getEdiLP();
            })
        }
    },
}
var LP = Vue.extend(EDILP);
new LP().$mount('#lp');
/////////////////////////COCHABAMBA///////////////////////////////////////
var EDICO = {
    data() {
        return {
            archivosCO: [],
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
                        var urlApi = '/api/edi/download/cochabamba/' + name;
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
        this.getEdiCO();
    },
    methods: {
        getEdiCO: function () {
            var url = '/api/edi/cochabamba';
            axios.get(url).then(response => {
                this.archivosCO = response.data;
            });
        },
        generar: function () {
            var url = '/api/edi/generar/cochabamba';
            axios.get(url).then(response => {
                this.getEdiCO();
            })
        }
    },
}
var CO = Vue.extend(EDICO);
new CO().$mount('#co');
/////////////////////////SANTA CRUZ///////////////////////////////////////
var EDISC = {
    data() {
        return {
            archivosSC: [],
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
                        var urlApi = '/api/edi/download/santacruz/' + name;
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
        this.getEdiSC();
    },
    methods: {
        getEdiSC: function () {
            var url = '/api/edi/santacruz';
            axios.get(url).then(response => {
                this.archivosSC = response.data;
            });
        },
        generar: function () {
            var url = '/api/edi/generar/santacruz';
            axios.get(url).then(response => {
                this.getEdiSC();
            })
        }
    },
}
var SC = Vue.extend(EDISC);
new SC().$mount('#sc');
/////////////////////////HUB///////////////////////////////////////
var EDIHUB = {
    data() {
        return {
            archivosHUB: [],
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
                        var urlApi = '/api/edi/download/hub/' + name;
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
        this.getEdiHUB();
    },
    methods: {
        getEdiHUB: function () {
            var url = '/api/edi/hub';
            axios.get(url).then(response => {
                this.archivosHUB = response.data;
            });
        },
        generar: function () {
            var url = '/api/edi/generar/hub';
            axios.get(url).then(response => {
                this.getEdiHUB();
            })
        }
    },
}
var HUB = Vue.extend(EDIHUB);
new HUB().$mount('#hub');