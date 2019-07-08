<template>
    <div>
        <van-nav-bar
        title="Panel">
            <van-button plain icon="arrow-left" size="mini" type="default" slot="right" to="/">Salir</van-button>
        </van-nav-bar>
        <van-tabbar v-model="active">
            <van-tabbar-item icon="home-o">Tab</van-tabbar-item>
            <van-tabbar-item icon="search">Tab</van-tabbar-item>
            <van-tabbar-item icon="friends-o">Tab</van-tabbar-item>
            <van-tabbar-item icon="setting-o">Tab</van-tabbar-item>
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