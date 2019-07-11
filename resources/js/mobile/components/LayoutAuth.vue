<template>
    <div >
       <van-row class="background">
            <van-col span="2"></van-col>
            <van-col span="20" class="login">
                <router-view></router-view>
            </van-col>
            <van-col span="2"></van-col>
        </van-row>
        <footer>
            <p>Copyright © 2019 Levcorp. Todos los derechos reservados.</p>
        </footer>
    </div>
</template>
<script>
export default {

}
</script>
<style lang="css">
@media (orientation: landscape) {
  .login {
    margin-top:2%;
  }
}

@media (orientation: portrait) {
  .login {
    margin-top:20%;
  }
}

@media (orientation: landscape) {
    footer{
        font-size:0;
        height:0;
    }
}

@media (orientation: portrait) {
    footer{
        font-size:11px;
        position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        padding: 1rem;
        background-color: #1989fa;
        text-align: center;
        color: #ffffff
    }
}
</style>