<template>
    <div>
        <van-nav-bar title="LEVCORP">
            <van-button plain hairline type="info" size="mini" slot="right">Salir</van-button>      
        </van-nav-bar>
        <router-view></router-view>
        <van-tabbar v-model="active">
            <van-tabbar-item to="/panel" icon="home-o">Inicio</van-tabbar-item>
            <van-tabbar-item to="/menu" icon="apps-o">Menu</van-tabbar-item>
            <van-tabbar-item to="/perfil" icon="user-o">Perfil</van-tabbar-item>
        </van-tabbar>
    </div>
</template>
<script>
export default {
    data() {
        return {
            active: 0
        }
    },
}
</script>
<style lang="css">
    
</style>