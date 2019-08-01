<template>
    <div>
        <van-panel>
            <div>
                <div class="text-center">                    
                    <van-image  lazy-load width="100" height="100" src="https://img.yzcdn.cn/vant/cat.jpeg"/>
                    <p style="color:#323233"> Gabriel Angel</p>
                    <p style="color:#323233"> Analista de Sistemas</p>
                </div>
                <van-divider :style="{ color: '#1989fa', borderColor: '#1989fa', padding: '0 15px' }">
                    Datos de Usuario
                </van-divider>
                <van-cell-group>
                    <van-cell value="gpinto@levcorp.bo">
                        <div slot="title">
                            <van-icon name="envelop-o" color="#1989fa"/> Correo Electronico
                        </div>
                    </van-cell>
                    <van-cell value="Sistemas" >
                        <div slot="title">
                            <van-icon name="hotel-o" color="#1989fa"/> Departamento 
                        </div>
                    </van-cell>
                    <van-cell value="La Paz" >
                         <div slot="title">
                            <van-icon name="location-o" color="#1989fa"/> Ciudad 
                        </div>
                    </van-cell>
                    <van-cell value="76518845" >
                         <div slot="title">
                            <van-icon name="phone-circle-o" color="#1989fa"/> Celular 
                        </div>
                    </van-cell>
                    <van-cell value="281">
                        <div slot="title">
                            <van-icon name="phone-circle-o" color="#1989fa"/> Telefono Interno 
                        </div>
                    </van-cell>
                </van-cell-group>
            </div>
        </van-panel>
    </div>
</template>
<script>

export default {
    data() {
        return {
        }
    }, 
    created() {
    },
    mounted() {
    },
}
</script>
<style lang="css">
    img {
    border-radius: 50%;
    }
</style>