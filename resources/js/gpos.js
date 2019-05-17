import Vue from 'vue';
import axios from 'axios';
import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css';
import VueDataTables from 'vue-data-tables';
import lang from 'element-ui/lib/locale/lang/es';
import locale from 'element-ui/lib/locale';
import moment from  'moment';
import 'moment/locale/es';
import VCalendar from 'v-calendar/lib/v-calendar.umd';
locale.use(lang);
Vue.use(VueDataTables)
Vue.use(ElementUI);
Vue.use(VCalendar, {
    componentPrefix: 'v',  // Use <vc-calendar /> instead of <v-calendar />
});
var GPOSLP = {
    data() {
        return {
            selectedDate: {
                start: new Date(2018, 0, 9),
                end: new Date(2018, 0, 18)
            },
            now: new Date().toISOString().slice(0, 10),
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
        this.getLP();
    },
    methods: {
        getLP: function () {
            var url = '/api/gpos/lapaz';
            axios.get(url).then(response => {
                this.archivosLP = response.data;
            });
        },
        generar: function () {
            var url = '/api/gpos/generar/lapaz/';
            axios.get(url).then(response => {
                this.getLP();
            })
        },
         formatDates(dateOne, dateTwo) {
            let formattedDates = ''
            if (dateOne) {
                formattedDates = format(dateOne, this.dateFormat)
            }
            if (dateTwo) {
                formattedDates += ' - ' + format(dateTwo, this.dateFormat)
            }
            return formattedDates
        }
    },
}
var LP = Vue.extend(GPOSLP);
new LP().$mount('#lp');

var GPOSCO = {
    data() {
        return {
            selectedDate: {
                start: new Date(2018, 0, 9),
                end: new Date(2018, 0, 18)
            },
            now: new Date().toISOString().slice(0, 10),
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
                        var urlApi = '/api/gpos/download/cochabamba/' + name;
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
        this.getCO();
    },
    methods: {
        getCO: function () {
            var url = '/api/gpos/cochabamba';
            axios.get(url).then(response => {
                this.archivosCO = response.data;
            });
        },
        generar: function () {
            var url = '/api/gpos/generar/cochabamba/';
            axios.get(url).then(response => {
                this.getCO();
            })
        },
        formatDates(dateOne, dateTwo) {
            let formattedDates = ''
            if (dateOne) {
                formattedDates = format(dateOne, this.dateFormat)
            }
            if (dateTwo) {
                formattedDates += ' - ' + format(dateTwo, this.dateFormat)
            }
            return formattedDates
        }
    },
}
var CO = Vue.extend(GPOSCO);
new CO().$mount('#co');

var GPOSSC = {
    data() {
        return {
            selectedDate: {
                start: new Date(2018, 0, 9),
                end: new Date(2018, 0, 18)
            },
            now: new Date().toISOString().slice(0, 10),
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
                        var urlApi = '/api/gpos/download/santacruz/' + name;
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
        this.getSC();
    },
    methods: {
        getSC: function () {
            var url = '/api/gpos/santacruz';
            axios.get(url).then(response => {
                this.archivosSC = response.data;
            });
        },
        generar: function () {
            var url = '/api/gpos/generar/santacruz/';
            axios.get(url).then(response => {
                this.getSC();
            })
        },
        formatDates(dateOne, dateTwo) {
            let formattedDates = ''
            if (dateOne) {
                formattedDates = format(dateOne, this.dateFormat)
            }
            if (dateTwo) {
                formattedDates += ' - ' + format(dateTwo, this.dateFormat)
            }
            return formattedDates
        }
    },
}
var SC = Vue.extend(GPOSSC);
new SC().$mount('#sc');

var GPOSGEN = {
    data() {
        return {
            selectedDate: {
                start: new Date(2018, 0, 9),
                end: new Date(2018, 0, 18)
            },
            now: new Date().toISOString().slice(0, 10),
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
                        var urlApi = '/api/gpos/download/general/' + name;
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
        this.getSC();
    },
    methods: {
        getSC: function () {
            var url = '/api/gpos/general';
            axios.get(url).then(response => {
                this.archivosSC = response.data;
            });
        },
        generar: function () {
            var url = '/api/gpos/generar/general/';
            axios.get(url).then(response => {
                this.getSC();
            })
        },
        formatDates(dateOne, dateTwo) {
            let formattedDates = ''
            if (dateOne) {
                formattedDates = format(dateOne, this.dateFormat)
            }
            if (dateTwo) {
                formattedDates += ' - ' + format(dateTwo, this.dateFormat)
            }
            return formattedDates
        }
    },
}
var GENERAL = Vue.extend(GPOSGEN);
new GENERAL().$mount('#general');
