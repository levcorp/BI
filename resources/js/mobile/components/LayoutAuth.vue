<template>
    <div >
       <van-row class="background">
            <van-col span="2"></van-col>
            <van-col span="20" class="panel">
                <router-view></router-view>
            </van-col>
            <van-col span="2"></van-col>
        </van-row>
    </div>
</template>
<script>
export default {

}
</script>
<style lang="css">
.background{
    position: absolute;
    width: 100%;
    height: 100%;
}
.panel{
    margin-top: 130px;
    height: 250px;
    width: 100%;
}
</style>