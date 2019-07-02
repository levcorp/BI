<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <img src="{{asset('/archivos/perfil/'.Auth::user()->avatar)}}" class="user-image" alt="User Image">
    <span class="hidden-xs">{{ucwords(Auth::user()->nombre." ".Auth::user()->apellido)}}</span>
  </a>
  <ul class="dropdown-menu">
    <!-- User image -->
    <li class="user-header">
      <img src="{{asset('/archivos/perfil/'.Auth::user()->avatar)}}" class="img-circle" alt="User Image">
      <p>
        {{ucwords(Auth::user()->nombre." ".Auth::user()->apellido)}} - {{Auth::user()->cargo}}
      </p>
    </li>
    <!-- Menu Body -->
  
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a data-toggle="modal" data-target="#user" class="btn btn-info ">Perfil</a>
      </div>
      <div class="pull-right">
        <a href="{{route('logout')}}" class="btn btn-default ">Salir</a>
      </div>
    </li>
  </ul>
</li>