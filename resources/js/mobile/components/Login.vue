<template>
    <div>
        <div class="text-center">
            <van-image width="120" height="60" src="images/levcorp.png"/>
            <br>
            <br>
            <van-cell-group>
                <van-field
                    left-icon="contact"
                    placeholder="Usuario"
                    label="Usuario"
                />
            </van-cell-group>
            <br>
            <van-cell-group>
                <van-field
                    type="password"
                    left-icon="edit"
                    label="Contraseña"
                    placeholder="Contraseña"
                />
            </van-cell-group>
            <br>
            <van-button type="info" round>Primary</van-button>
        </div>
    </div>
</template>
<script>
export default {
    
}
</script>
<style lang="css">
.text-center{
    text-align: center;    
}
</style>