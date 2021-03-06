@extends('panel.dashboard.layout')
@section('opciones')
@endsection
@section('body')
<div class="row" id="app" v-cloak>
  <vs-button
         @click="openNotification('none')">
         Open Notification
       </vs-button>
  <vs-button @click="active=!active">
       Open Dialog
     </vs-button>
     <vs-dialog v-model="active">
       <template #header>
         <h4 class="not-margin">
           Welcome to <b>Vuesax</b>
         </h4>
       </template>


       <div class="con-form">
         <vs-input v-model="email" placeholder="Email">
           <template #icon>
             @
           </template>
         </vs-input>
         <vs-input type="password" v-model="password" placeholder="Password">
           <template #icon>
             <i class='bx bxs-lock'></i>
           </template>
         </vs-input>
         <div class="flex">
           <vs-checkbox v-model="remember">Remember me</vs-checkbox>
           <a href="#">Forgot Password?</a>
         </div>
       </div>

       <template #footer>
         <div class="footer-dialog">
           <vs-button block>
             Sign In
           </vs-button>

           <div class="new">
             New Here? <a href="#">Create New Account</a>
           </div>
         </div>
       </template>
     </vs-dialog>
  </div>

@section('script')
{!!Html::script('js/prueba.js')!!}
{!!Html::style('css/styleui.css')!!}
@endsection
@stop
