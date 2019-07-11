<template>
    <div>
      <van-pull-refresh loading-text="Cargando...." pulling-text="Recargar" loosing-text="Recargar.." v-model="isLoading" @refresh="onRefresh">
          <apexchart type="area" height="290" :options="chartOptions" :series="series" />
      </van-pull-refresh>
    </div>
</template>
<script>
export default {
    data() {
      return {
        isLoading: false,
      series: [{
        name: 'series1',
        data: [31, 40, 28, 51, 42, 109, 100]
      }, {
        name: 'series2',
        data: [11, 32, 45, 32, 34, 52, 41]
      }],
      chartOptions: {
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'smooth'
        },
        xaxis: {
          type: 'datetime',
          categories: ["2018-09-19T00:00:00", "2018-09-19T01:30:00", "2018-09-19T02:30:00",
            "2018-09-19T03:30:00", "2018-09-19T04:30:00", "2018-09-19T05:30:00",
            "2018-09-19T06:30:00"
          ],
        },
        tooltip: {
          x: {
            format: 'dd/MM/yy HH:mm'
          },

        }
      }

    }
    },
    methods: {
        onRefresh() {
           setTimeout(() => {
              this.$toast('Refresh Success');
              this.isLoading = false;
            }, 500);
          }
    }
}
</script>
<style lang="css">
    #chart {
  max-width: 760px;
  margin: 35px auto;
  opacity: 0.9;
}
</style>