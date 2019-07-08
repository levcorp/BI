<template>
    <div>
        <div class="text-center">
            <h2>
                <p>LEV<span class="corp">CORP</span></p>
            </h2>
            <br>
            <van-cell-group>
                <van-field
                    left-icon="contact"
                    placeholder="Usuario"
                    label="Usuario"
                    required
                />
            </van-cell-group>
            <br>
            <van-cell-group>
                <van-field
                    type="password"
                    left-icon="edit"
                    label="Contraseña"
                    placeholder="Contraseña"
                    required
                />
            </van-cell-group>
            <br>
              <a @click="handleShow()">¿ Olvide mi contraseña ?</a>
            <br>    
            <br>
            <br>
            <van-button type="info" round to="panel">Iniciar Sesión</van-button>
        </div>
        <van-action-sheet v-model="show" title="Olvide mi contraseña">
            <van-row class="background">
                <van-col span="2"></van-col>
                <van-col span="20">
                    <div class="text-center">
                        <br>
                        <van-cell-group>
                            <van-field
                                left-icon="envelop-o"
                                placeholder="Correo Electronico"
                                label=""
                                required
                            />
                        </van-cell-group>
                        <br>
                        <div class="mb-15">
                            <van-button type="info" @click="handleResetPassword()" round>Restablecer Contraseña</van-button>
                        </div>
                    </div>
                </van-col>
                <van-col span="2"></van-col>
            </van-row>
        </van-action-sheet>
    </div>
</template>
<script>
import { Notify } from 'vant';
export default {
    data() {
        return {
            show:false,
        }
    },
    methods: {
        handleShow(){
            this.show=true;
        },
        handleResetPassword(){
            this.show=false;
            Notify({
                message: 'Correo enviado correctamento!!',
                duration: 1000,
                background: '#1989fa'
            });
        }
    },
}
</script>
<style lang="css">
.mb-15{
    margin-bottom:15px;
}
.text-center{
    text-align: center;    
}
.corp{
    color:#1989fa;
}
a{ 
    color: #0366d6;
    text-decoration: none;
}
</style>