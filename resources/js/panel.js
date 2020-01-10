import Vue from "vue";
import VueApexCharts from "vue-apexcharts";
import axios from "axios";
import ElementUI from "element-ui";
import "element-ui/lib/theme-chalk/index.css";

Vue.use(ElementUI);
Vue.use(VueApexCharts);
Vue.component("apexchart", VueApexCharts);
var Main = {
    data() {
        return {
            series: [],
            chartOptions: {
                colors: ["#409EFF", "#67C23A"],
                fill: {
                    type: ["solid", "gradient"],
                    opacity: [0, 1],
                    gradient: {
                        inverseColors: false,
                        shade: "light",
                        type: "vertical",
                        opacityFrom: 0.25,
                        opacityTo: 0.25,
                        stops: [0, 50, 50, 50]
                    }
                },
                legend: {
                    position: "top",
                    horizontalAlign: "left"
                },
                chart: {
                    height: 350,
                    type: "area"
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: "smooth",
                    dashArray: [5, 0]
                },
                xaxis: {
                    categories: [
                        "Enero",
                        "Febrero",
                        "Marzo",
                        "Abril",
                        "Mayo",
                        "Junio",
                        "Julio",
                        "Agosto",
                        "Septiembre",
                        "Octubre",
                        "Noviembre",
                        "Diciembre"
                    ]
                }
            },
            loading: {
                presupuesto: false
            },
            button: {
                name: "General"
            }
        };
    },
    mounted() {
        this.handleGetPresupuesto();
    },
    methods: {
        handleGetPresupuesto() {
            this.loading.presupuesto = true;
            axios.get("/api/panel/get/presupuesto").then(response => {
                this.series.push({
                    name: "Presupuesto",
                    data: response.data
                });
                axios.get("/api/panel/get/facturacion").then(response => {
                    this.series.push({
                        name: "Facturación",
                        data: response.data
                    });
                    this.loading.presupuesto = false;
                });
            });
        },
        handleGetOption(mercado, name) {
            this.loading.presupuesto = true;
            this.series = [];
            this.button.name = name;
            axios
                .get("/api/panel/get/presupuesto/mercado/" + mercado)
                .then(response => {
                    this.series.push({
                        name: "Presupuesto",
                        data: response.data
                    });
                    axios
                        .get("/api/panel/get/facturacion/mercado/" + mercado)
                        .then(response => {
                            this.series.push({
                                name: "Facturación",
                                data: response.data
                            });
                            this.loading.presupuesto = false;
                        });
                });
        }
    }
};

var Ctor = Vue.extend(Main);
new Ctor().$mount("#app");
