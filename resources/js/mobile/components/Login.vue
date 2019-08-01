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
                    v-model="log.user"
                    required
                />
            </van-cell-group>
            <br>
            <van-cell-group>
                <van-field
                    :type="typePassword"
                    left-icon="edit"
                    label="Contraseña"
                    placeholder="Contraseña"
                    required
                    v-model="log.password"
                >
                <div slot="right-icon">
                    <van-icon v-if="!showPassword" name="eye-o" color="#1989fa" @click="hanldeShowPassword()"/>
                    <van-icon v-else name="closed-eye" color="#1989fa" @click="hanldeShowPassword()"/>
                </div>
                </van-field>
            </van-cell-group>
            <br>
              <a @click="handleShow()">¿ Olvide mi contraseña ?</a>
            <br>    
            <br>
            <br>
            <van-button @clik="handleLogin()" type="info" round to="panel">Iniciar Sesión</van-button>
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
            showPassword:false,
            typePassword:'password',
            log:{
                user:'',
                password:''
            }
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
        },
        handleLogin(){

        },
        hanldeShowPassword(){
            if(this.showPassword){
                this.showPassword=false;
                this.typePassword="password";
            }else{
                this.showPassword=true;
                this.typePassword="text";
            }

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