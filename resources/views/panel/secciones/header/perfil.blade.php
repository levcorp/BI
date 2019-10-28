<li class="dropdown user user-menu">
  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    @if(Auth::user()->avatar)
    <img src="{{asset('/archivos/perfil/'.Auth::user()->avatar)}}" class="user-image" alt="User Image">
    @else
    <img src="{{ Avatar::create(ucwords(Auth::user()->nombre." ".Auth::user()->apellido))->toBase64() }}" class="user-image" alt="User Image" />
    @endif
    <span class="hidden-xs">
      <strong>
        {{ucwords(Auth::user()->nombre." ".Auth::user()->apellido)}}
      </strong>
    </span>
  </a>
  <ul class="dropdown-menu">
    <!-- User image -->
    <li class="user-header">
      @if(Auth::user()->avatar)
      <img src="{{asset('/archivos/perfil/'.Auth::user()->avatar)}}" class="img-circle" alt="User Image">
      @else
      <img src="{{ Avatar::create(ucwords(Auth::user()->nombre." ".Auth::user()->apellido))->toBase64() }}" class="img-circle" alt="User Image" />
      @endif
      <p style="font-size:13px;font-family: inherit;color:#FFF">
        <strong>
          {{ucwords(Auth::user()->nombre." ".Auth::user()->apellido)}} - {{Auth::user()->cargo}}
        </strong>
      </p>
    </li>
    <!-- Menu Body -->
    <!-- Menu Footer-->
    <li class="user-footer">
      <div class="pull-left">
        <a data-toggle="modal" data-target="#user" class="el-button el-button--primary el-button--mini is-round" style="color:#FFF;">Perfil</a>
      </div>
      <div class="pull-right">
        <a href="{{route('logout')}}" class="el-button el-button--default el-button--mini is-round">Salir</a>
      </div>
    </li>
  </ul>
</li>