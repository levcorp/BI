<template>
    <div>
        <div>
            <van-cell-group>
                <van-field placeholder="Codigo Venta" left-icon="qr"/>
                <van-field placeholder="Descripción" left-icon="other-pay">
                    <van-button @click="handleSearch" slot="button" size="small" type="info" round color="#409EFF" icon="search"></van-button>
                </van-field>
            </van-cell-group>
        </div>
        <transition name="van-slide-left">
            <div class="grey" v-if="showList">
                <div class="sep"></div>
                <div class="box">
                    <p class="text-size"><strong>SD00AS15D10025</strong></p>                        
                    <p class="text-size">VALVULA ST GGG-40 C/D10 BS 5156 C/B ASA 150 1BS DN25VALVULA ST GGG-40 C/D10 BS 5156 C/B ASA 150 1BS DN25VALVULA ST GGG-40 C/D10 BS 5156 C/B ASA 150 1BS DN25VALVULA </p>
                    <div class="right">
                        <van-button @click="handleShow()" color="#E6A23C" round size="mini" type="warning">Mas</van-button>
                    </div>
                    <div class="left">
                    <van-tag round color="#409EFF">OTRO</van-tag>
                    </div>
                    <br>
                </div>
                <div class="box">
                    <p class="text-size"><strong>SD00AS15D10025</strong></p>                        
                    <p class="text-size">VALVULA ST GGG-40 C/D10 BS 5156 C/B ASA 150 1BS DN25VALVULA ST GGG-40 C/D10 BS 5156 C/B ASA 150 1BS DN25VALVULA ST GGG-40 C/D10 BS 5156 C/B ASA 150 1BS DN25VALVULA </p>
                    <div class="right">
                        <van-button @click="handleShow()" color="#E6A23C" round size="mini" type="warning">Mas</van-button>
                    </div>
                    <div class="left">
                    <van-tag round color="#409EFF">OTRO</van-tag>
                    </div>
                    <br>
                </div>
                <div class="box">
                    <p class="text-size"><strong>SD00AS15D10025</strong></p>                        
                    <p class="text-size">VALVULA ST GGG-40 C/D10 BS 5156 C/B ASA 150 1BS DN25VALVULA ST GGG-40 C/D10 BS 5156 C/B ASA 150 1BS DN25VALVULA ST GGG-40 C/D10 BS 5156 C/B ASA 150 1BS DN25VALVULA </p>
                    <div class="right">
                        <van-button @click="handleShow()" color="#E6A23C" round size="mini" type="warning">Mas</van-button>
                    </div>
                    <div class="left">
                    <van-tag round color="#409EFF">OTRO</van-tag>
                    </div>
                    <br>
                </div>
                <br>
                <br>
            </div>
            <div v-else style="height:100%">
                <div class="text-center">
                    <div class="middle">
                        <van-icon name="info-o" size="50" color="#E6A23C"/>
                        <p class="p12">Sin resultados</p>
                    </div>
                </div>
            </div>
        </transition>
        <van-action-sheet v-model="show" title="Detalle de Articulo">
            <van-row>
                <van-col span="12">
                    <div class="text-center title">
                        <p style="color: white;font-size: 13px;"><strong>LEV</strong></p>
                    </div>
                </van-col>
                <van-col span="12">
                    <div class="text-center title">
                        <p style="color: white;font-size: 13px;"><strong>LPZ</strong></p>
                    </div>
                </van-col>
                <van-col span="12">
                    <div class="text-center">
                        <p class="pgrey"><strong>Stock : </strong><van-tag color="#67C23A" plain size="medium">1</van-tag></p>
                    </div>
                </van-col>
                <van-col span="12">
                    <div class="text-center">
                        <p class="pgrey"><strong>Pedido OV : </strong><van-tag color="#909399" plain size="medium">1</van-tag></p>
                    </div>
                </van-col>
                <van-col span="12">
                    <div class="text-center">
                        <p class="pgrey"><strong>Compra : </strong><van-tag color="#909399" plain size="medium">1</van-tag></p>
                    </div>
                </van-col>
                <van-col span="12">
                    <div class="text-center">
                        <p class="pgrey"><strong>Trasladandose : </strong><van-tag color="#909399" plain size="medium">1</van-tag></p>
                    </div>
                </van-col>
                <van-col span="12">
                    <div class="text-center">
                        <p class="pgrey"><strong>En Transito : </strong><van-tag color="#909399" plain size="medium">1</van-tag></p>
                    </div>
                </van-col>
                <van-col span="12">
                    <div class="text-center">
                        <p class="pgrey"><strong>Cant. OV : </strong><van-tag color="#909399" plain size="medium">1</van-tag></p>
                    </div>
                </van-col>
                <van-col span="12">
                    <div class="text-center">
                        <p class="pgrey"><strong>Cant. OC : </strong><van-tag color="#909399" plain size="medium">1</van-tag></p>
                    </div>
                </van-col>
                <van-col span="12">
                    <div class="text-center">
                        <p class="pgrey"><strong>Disponibilidad : </strong><van-tag color="#909399" plain size="medium">1</van-tag></p>
                    </div>
                </van-col>
            </van-row>
        </van-action-sheet>
    </div>
</template>
<script>
export default {
    data() {
        return {
            list: [],
            loading: false,
            finished: false,
            show:false,
            showList:false
        }
    },
    methods:{
        handleShow(){
            this.show=true;
            console.log('here');
        },
        handleSearch(){
            this.showList=true;
        }
    }
}
</script>
<style lang="css">
    .text-center{
        text-align: center;
    }
    .grey{
        background-color: #f0f3f6;
    }
    .box{
        background-color: white;
        margin: 15px;
        border-radius: 15px;
        padding: 10px;
        box-shadow: 0 0 4px rgba(0, 0, 0, 0.1);
    }
    .text-size{
        font-size: 10px;  
    }
    .pull-right{
        float:none;
        text-align: right;
    }
    .pull-left{
        float:none;
        text-align: left;
    }
    .left{
        float: left;
    }
    .right{
        float: right;
    }
    .mb15{
        margin: 15px;
    }
    .sep{
        height: 1px;
    }
    .p12{
        font-size: 12px;
        color: #909399;
    }
    .pgrey{
        color: #606266;
        font-size: 12px;
    }
    .middle{
        position: absolute;
        top: 48%;
        left: 0;
        right: 0;
        bottom: 0;
        margin: auto
    }
    .table{
        width: 96%;
    }
    .cell{
        background-color: #f0f3f6;
        border-radius: 15px;
        margin: 15px;
    }
    .title{
        background-color: #409EFF;
        margin-left: 4px;
        margin-right: 4px;
        border-radius: 5px;
    }
</style>