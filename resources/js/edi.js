import Vue from 'vue/dist/vue.common.prod';
import axios from 'axios';
import ElementUI from 'element-ui'
Vue.config.devtools = false;
import 'element-ui/lib/theme-chalk/index.css';
import VueDataTables from 'vue-data-tables';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import swal from 'sweetalert';
locale.use(lang);
Vue.use(VueDataTables)
Vue.use(ElementUI);

/////////////////////////LA PAZ///////////////////////////////////////
var EDILP = {
    data() {
        return {
            loading:false,
            loadingTable:false,
            now: new Date().toISOString().slice(0, 10),
            date: new Date().toISOString().slice(0, 10),
            archivosLP: [],
            search: '',
            EDILP:[]
        }
    },
    mounted() {
        this.getEdiLP();
    },
    methods: {
        dateEDI: function() {
            swal("¿Generar archivo de la fecha " + this.date+" ?", {
                buttons: {
                    cancel: "Cancelar",
                    catch: {
                        text: "Generar",
                        value: "catch",
                    },
                },
                icon: "warning",
            })
            .then((value) => {
                switch (value) {
                    case "catch":
                        var url = '/api/edi/generar/lapaz/' + this.date;
                        axios.get(url).then(response => {
                            swal("Exito!", "Archivo generado correctamente", "success");
                            this.getEdiLP();
                        })   
                    break;
                }
            });        
        },
        getEdiLP: function () {
            var url = '/api/edi/lapaz';
            this.loadingTable= true;
            axios.get(url).then(response => {
                this.archivosLP = response.data;
                this.loadingTable = false;
            });
        },
        handleDownload(index, row) {
            var name = row.name;
            var urlApi = '/api/edi/download/lapaz/' + name;
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
                this.$message({
                    message: 'Se descargo el archivo' +row.name,
                    type: 'success'
                });
            });
        },
        handleTable(index, row) {
            var urlApi = '/api/edi/datos/lapaz/' + row.name;
            this.loading = true;
            $('#modalLP').modal('show'); 
            axios.get(urlApi).then(response => {
                this.EDILP = response.data;
                this.loading = false;
            }); 
        }
    },
}
var LP = Vue.extend(EDILP);
new LP().$mount('#lp');
/////////////////////////COCHABAMBA///////////////////////////////////////
var EDICO = {
    data() {
        return {
            loading: false,
            loadingTable: false,
            now: new Date().toISOString().slice(0, 10),
            date: new Date().toISOString().slice(0, 10),
            archivosCO: [],
            search: '',
            EDICO: []
        }
    },
    mounted() {
        this.getEdiCO();
    },
    methods: {
        dateEDI: function () {
            swal("¿Generar archivo de la fecha " + this.date + " ?", {
                buttons: {
                    cancel: "Cancelar",
                    catch: {
                        text: "Generar",
                        value: "catch",
                    },
                },
                icon: "warning",
            })
                .then((value) => {
                    switch (value) {
                        case "catch":
                            var url = '/api/edi/generar/cochabamba/' + this.date;
                            axios.get(url).then(response => {
                                swal("Exito!", "Archivo generado correctamente", "success");
                                this.getEdiCO();
                            })
                            break;
                    }
                });
        },
        getEdiCO: function () {
            var url = '/api/edi/cochabamba';
            this.loadingTable = true;
            axios.get(url).then(response => {
                this.archivosCO = response.data;
                this.loadingTable = false;
            });
        },
        handleDownload(index, row) {
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
                this.$message({
                    message: 'Se descargo el archivo' + row.name,
                    type: 'success'
                });
            });
        },
        handleTable(index, row) {
            var urlApi = '/api/edi/datos/cochabamba/' + row.name;
            this.loading= true,
            $('#modalCO').modal('show');
            axios.get(urlApi).then(response => {
                this.EDICO = response.data;
                this.loading= false;
            });
        }
    },
}
var CO = Vue.extend(EDICO);
new CO().$mount('#co');
/////////////////////////SANTA CRUZ///////////////////////////////////////
var EDISC = {
    data() {
        return {
            loading: false,
            loadingTable: false,
            now: new Date().toISOString().slice(0, 10),
            date: new Date().toISOString().slice(0, 10),
            archivosSC: [],
            search: '',
            EDISC: []
        }
    },
    mounted() {
        this.getEdiSC();
    },
    methods: {
        dateEDI: function () {
            swal("¿Generar archivo de la fecha " + this.date + " ?", {
                buttons: {
                    cancel: "Cancelar",
                    catch: {
                        text: "Generar",
                        value: "catch",
                    },
                },
                icon: "warning",
            })
                .then((value) => {
                    switch (value) {
                        case "catch":
                            var url = '/api/edi/generar/santacruz/' + this.date;
                            axios.get(url).then(response => {
                                swal("Exito!", "Archivo generado correctamente", "success");
                                this.getEdiSC();
                            })
                            break;
                    }
                });
        },
        getEdiSC: function () {
            var url = '/api/edi/santacruz';
            this.loadingTable = true;
            axios.get(url).then(response => {
                this.archivosSC = response.data;
                this.loadingTable = false;
            });
        },
        generar: function () {
            var url = '/api/edi/generar/santacruz/' + this.now;
            axios.get(url).then(response => {
                this.getEdiSC();
            })
        },
        handleDownload(index, row) {
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
                this.$message({
                    message: 'Se descargo el archivo' + row.name,
                    type: 'success'
                });
            });
        },
        handleTable(index, row) {
            var urlApi = '/api/edi/datos/santacruz/' + row.name;
            this.loading = true;
            $('#modalSC').modal('show');
            axios.get(urlApi).then(response => {
                this.EDISC = response.data;
                this.loading = false;
            });
        }
    },
}
var SC = Vue.extend(EDISC);
new SC().$mount('#sc');
/////////////////////////HUB///////////////////////////////////////
var EDIHUB = {
    data() {
        return {
            loading : false,
            loadingTable: false,
            now: new Date().toISOString().slice(0, 10),
            date: new Date().toISOString().slice(0, 10),
            archivosHUB: [],
            search: '',
            EDIHUB: []
        }
    },
    mounted() {
        this.getEdiHUB();
    },
    methods: {
        dateEDI: function () {
            swal("¿Generar archivo de la fecha " + this.date + " ?", {
                buttons: {
                    cancel: "Cancelar",
                    catch: {
                        text: "Generar",
                        value: "catch",
                    },
                },
                icon: "warning",
            })
                .then((value) => {
                    switch (value) {
                        case "catch":
                            var url = '/api/edi/generar/hub/' + this.date;
                            axios.get(url).then(response => {
                                swal("Exito!", "Archivo generado correctamente", "success");
                                this.getEdiHUB();
                            })
                            break;
                    }
                });
        },
        getEdiHUB: function () {
            var url = '/api/edi/hub';
            this.loadingTable = true;
            axios.get(url).then(response => {
                this.archivosHUB = response.data;
                this.loadingTable = false;
            });
        },
        handleDownload(index, row) {
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
                this.$message({
                    message: 'Se descargo el archivo' + row.name,
                    type: 'success'
                });
            });
        },
        handleTable(index, row) {
            var urlApi = '/api/edi/datos/hub/' + row.name;
            this.loading = true;
            $('#modalHUB').modal('show');
            axios.get(urlApi).then(response => {
                this.EDIHUB = response.data;
                this.loading = false;
            });
        }
    },
}
var HUB = Vue.extend(EDIHUB);
new HUB().$mount('#hub');