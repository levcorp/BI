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
            now: new Date().toISOString().slice(0, 10),
            date: new Date().toISOString().slice(0, 10),
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
        dateEDI: function() {
            var url = '/api/edi/generar/lapaz/' + this.date;     
            axios.get(url).then(response => {
                this.getEdiLP();
            })                   
        },
        getEdiLP: function () {
            var url = '/api/edi/lapaz';
            axios.get(url).then(response => {
                this.archivosLP = response.data;
            });
        },
        generar:function(){
            var url = '/api/edi/generar/lapaz/'+this.now;
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
            now: new Date().toISOString().slice(0, 10),
            date: new Date().toISOString().slice(0, 10),
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
        dateEDI: function () {
            var url = '/api/edi/generar/cochabamba/' + this.date;
            axios.get(url).then(response => {
                this.getEdiCO();
            })
        },
        getEdiCO: function () {
            var url = '/api/edi/cochabamba';
            axios.get(url).then(response => {
                this.archivosCO = response.data;
            });
        },
        generar: function () {
            var url = '/api/edi/generar/cochabamba/' + this.now;
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
            now: new Date().toISOString().slice(0, 10),
            date: new Date().toISOString().slice(0, 10),
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
        dateEDI: function () {
            var url = '/api/edi/generar/santacruz/' + this.date;
            axios.get(url).then(response => {
                this.getEdiSC();
            })
        },
        getEdiSC: function () {
            var url = '/api/edi/santacruz';
            axios.get(url).then(response => {
                this.archivosSC = response.data;
            });
        },
        generar: function () {
            var url = '/api/edi/generar/santacruz/' + this.now;
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
            now: new Date().toISOString().slice(0, 10),
            date: new Date().toISOString().slice(0, 10),
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
        dateEDI: function () {
            var url = '/api/edi/generar/hub/' + this.date;
            axios.get(url).then(response => {
                this.getEdiHUB();
            })
        },
        getEdiHUB: function () {
            var url = '/api/edi/hub';
            axios.get(url).then(response => {
                this.archivosHUB = response.data;
            });
        },
        generar: function () {
            var url = '/api/edi/generar/hub/' + this.now;
            axios.get(url).then(response => {
                this.getEdiHUB();
            })
        }
    },
}
var HUB = Vue.extend(EDIHUB);
new HUB().$mount('#hub');