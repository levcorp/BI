<template>
    <div>
        <div>
            <van-cell-group>
                <van-field v-on:keyup.enter="handleSearch" v-model="inputs.U_Cod_Vent" placeholder="Codigo Venta" left-icon="qr"/>
                <van-field v-on:keyup.enter="handleSearch" v-model="inputs.ItemName" placeholder="Descripción" left-icon="other-pay">
                    <van-button @click="handleSearch" slot="button" size="mini" type="info" round color="#409EFF" icon="search"></van-button>
                </van-field>
            </van-cell-group>
        </div>
        <transition name="van-slide-left">
            <div class="grey" v-if="showList">
                <div class="sep"></div>
                <div class="box" v-for="item in items" :key="item.ItemCode">
                    <p class="text-size"><strong>{{item.U_Cod_Vent}}</strong></p>                        
                    <p class="text-size">{{item.ItemName}}</p>
                    <div class="right">
                        <van-button @click="handleShow(item)" color="#E6A23C" round size="mini" type="warning">Mas</van-button>
                    </div>
                    <div class="left">
                    <van-tag round color="#409EFF">{{item.ItemCode}}</van-tag>
                    </div>
                    <br>
                </div>
                <br>
                <br>
            </div>
        </transition>
        <div v-if="showLoading" style="height:100%">
            <div class="text-center">
                <div class="middle">
                    <van-loading color="#1989fa" />
                </div>
            </div>
        </div>
        <div v-if="showIcon" style="height:100%">
            <div class="text-center">
                <div class="middle">
                    <van-icon name="info-o" size="50" color="#E6A23C"/>
                    <p class="p12">Sin resultados</p>
                </div>
            </div>
        </div>
        <van-action-sheet v-model="show">
            <van-row>
                <van-col span="20">
                    <p class="ml15 p13"><strong>{{item.ItemName}}</strong></p>
                </van-col>
                <van-col span="4">
                    <p class="text-center" style="font-size:15px;">
                        <van-icon name="close" color="#F56C6C" @click="handleClose"/>
                    </p>
                </van-col>  
            </van-row>
            <div v-for="(item,index) in stock" :key="index">
            <van-row>
                <van-col span="8">
                    <div class="text-center title">
                        <p style="color: white;font-size: 13px;"><strong>{{item.EMPRESA}}</strong></p>
                    </div>
                </van-col>
                <van-col span="8">
                    <div class="text-center title">
                        <p style="color: white;font-size: 13px;"><strong>{{item.ALMACEN}}</strong></p>
                    </div>
                </van-col>
                <van-col span="8">
                    <div class="text-center title">
                        <p style="color: white;font-size: 13px;"><strong>{{item.Clasificacion}}</strong></p>
                    </div>
                </van-col>
                <van-col span="12">
                    <van-row>
                        <van-col span="16">
                            <p class="pgrey ml15"><strong>Stock : </strong></p>
                        </van-col>
                        <van-col span="8" class="text-center">
                            <p class="pgrey">
                               <van-tag :color="item.OnHand>0?'#67C23A':'#909399'" plain size="medium">{{item.OnHand}}</van-tag>
                            </p> 
                        </van-col>
                    </van-row>
                </van-col>
                <van-col span="12">
                    <van-row>
                        <van-col span="16">
                            <p class="pgrey ml15"><strong>Pedido OV : </strong></p>
                        </van-col>
                        <van-col span="8" class="text-center">
                            <p class="pgrey">
                               <van-tag :color="item.IsCommited>0?'#67C23A':'#909399'" plain size="medium">{{item.IsCommited}}</van-tag>
                            </p> 
                        </van-col>
                    </van-row>                  
                </van-col>
                <van-col span="12">
                    <van-row>
                        <van-col span="16">
                            <p class="pgrey ml15"><strong>Compra OC: </strong></p>
                        </van-col>
                        <van-col span="8" class="text-center">
                            <p class="pgrey">
                                <van-tag :color="item.OnOrder>0?'#67C23A':'#909399'" plain size="medium">{{item.OnOrder}}</van-tag>
                            </p> 
                        </van-col>
                    </van-row> 
                </van-col>
                <van-col span="12">
                    <van-row>
                        <van-col span="16">
                            <p class="pgrey ml15"><strong>Trasladandose : </strong></p>
                        </van-col>
                        <van-col span="8" class="text-center">
                            <p class="pgrey">
                                <van-tag :color="item.TRASLADOS_OUT>0?'#67C23A':'#909399'" plain size="medium">{{item.TRASLADOS_OUT}}</van-tag>
                            </p> 
                        </van-col>
                    </van-row> 
                </van-col>
                <van-col span="12">
                     <van-row>
                        <van-col span="16">
                            <p class="pgrey ml15"><strong>En Transito : </strong></p>
                        </van-col>
                        <van-col span="8" class="text-center">
                            <p class="pgrey">
                                <van-tag :color="item.TRASLADOS_IN>0?'#67C23A':'#909399'" plain size="medium">{{item.TRASLADOS_IN}}</van-tag>
                            </p> 
                        </van-col>
                    </van-row> 
                </van-col>
                <van-col span="12">
                    <van-row>
                        <van-col span="16">
                            <p class="pgrey ml15"><strong>Cant. OV : </strong></p>
                        </van-col>
                        <van-col span="8" class="text-center">
                            <p class="pgrey">
                                <van-tag :color="item.OV>0?'#67C23A':'#909399'" plain size="medium">{{item.OV}}</van-tag>
                            </p> 
                        </van-col>
                    </van-row> 
                </van-col>
                <van-col span="12">
                    <van-row>
                        <van-col span="16">
                            <p class="pgrey ml15"><strong>Cant. OC : </strong></p>
                        </van-col>
                        <van-col span="8" class="text-center">
                            <p class="pgrey">
                                <van-tag :color="item.PO>0?'#67C23A':'#909399'" plain size="medium">{{item.PO}}</van-tag>
                            </p> 
                        </van-col>
                    </van-row> 
                </van-col>
                <van-col span="12">
                    <van-row>
                        <van-col span="16">
                            <p class="pgrey ml15"><strong>Disponibilidad : </strong></p>
                        </van-col>
                        <van-col span="8" class="text-center">
                            <p class="pgrey">
                                <van-tag :color="item.DISPONIBLE>0?'#67C23A':'#909399'" plain size="medium">{{item.DISPONIBLE}}</van-tag>
                            </p> 
                        </van-col>
                    </van-row> 
                </van-col>
            </van-row>
            <div class="van-hairline--top"></div>
            </div>
        </van-action-sheet>
    </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            list: [],
            loading: false,
            finished: false,
            show:false,
            showList:false,
            item:[],
            inputs:{
                ItemName:'',
                U_Cod_Vent:''
            },
            items:[],
            showLoading:false,
            showIcon:true,
            stock:[],
        }
    },
    methods:{
        handleSearch(){
            this.showLoading=true;
            this.showIcon=false;
            var url = '/api/stock';
            axios.post(url,{
                ItemName : this.inputs.ItemName,
                U_Cod_Vent : this.inputs.U_Cod_Vent
            }).then(response=>{
                if(response.data!=''){
                    this.items=response.data;
                    this.showList=true;
                    this.showLoading=false;
                }else{
                    this.showLoading=false;
                    this.showIcon=true;
                    this.showList=false;
                }
            });
        },
        handleShow(item){
            this.item=item;
            this.showLoading=true;
            var url='/api/stock/detalle';
            axios.post(url,{
                U_Cod_Vent : item.U_Cod_Vent
            }).then(response=>{
                this.stock=response.data;
                this.show=true;
                this.showLoading=false;
            });
        },
        handleClose(){
            this.show=false;
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
    .ml15{
        margin-left: 15px;
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
    .p13{
        font-size: 13px;
    }
</style>