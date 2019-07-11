<template>
    <div>
    <van-collapse v-model="activeName" accordion>
        <van-collapse-item icon="chart-trending-o" title="Panel" name="1">
        <van-cell is-link icon="bar-chart-o">
            <template slot="title">
                <span class="custom-title">Ventas</span>
            </template>
        </van-cell>
        </van-collapse-item>
        <van-collapse-item title="Administración" name="2" icon="notes-o">
            <van-cell is-link icon="friends-o">
                <template slot="title">
                    <span class="custom-title">Usuarios</span>
                </template>
            </van-cell>
            <van-cell is-link icon="manager-o">
                <template slot="title">
                    <span class="custom-title">Perfiles</span>
                </template>
            </van-cell>
            <van-cell is-link icon="wap-home">
                <template slot="title">
                    <span class="custom-title">Sucursal</span>
                </template>
            </van-cell>
        </van-collapse-item>
        <van-collapse-item icon="records" title="Solicitudes" name="3">
            <van-cell is-link icon="label-o">
                <template slot="title">
                    <span class="custom-title">Articulos ABM</span>
                </template>
            </van-cell>
        </van-collapse-item>
        <van-collapse-item icon="completed" title="Generación de EDIs" name="4">
            <van-cell is-link icon="orders-o">
                <template slot="title">
                    <span class="custom-title">EDI 852</span>
                </template>
            </van-cell>
            <van-cell is-link icon="orders-o">
                <template slot="title">
                    <span class="custom-title">EDI 867 (GPOS)</span>
                </template>
            </van-cell>
        </van-collapse-item>
        <van-collapse-item icon="paid" title="Ventas" name="5">
            <van-cell is-link icon="apps-o">
                <template slot="title">
                    <span class="custom-title">Stock Articulos</span>
                </template>
            </van-cell>
               <van-cell is-link icon="apps-o">
                <template slot="title">
                    <span class="custom-title">Stock Articulos</span>
                </template>
            </van-cell>
        </van-collapse-item>
    </van-collapse>
    </div>
</template>
<script>
export default {
    data() {
        return {
             activeName: ''
        }
    },
}
</script>