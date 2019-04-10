            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('../../dist/img/avatar04.png')}}" class="user-image" alt="User Image">
                <span class="hidden-xs">{{ucwords(Auth::user()->nombre." ".Auth::user()->apellido)}}</span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="{{asset('../../dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                  <p>
                    {{ucwords(Auth::user()->nombre." ".Auth::user()->apellido)}} - {{Auth::user()->cargo}}
                  </p>
                </li>
                <!-- Menu Body -->
             
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Perfil</a>
                  </div>
                  <div class="pull-right">
                    <a href="{{route('salir')}}" class="btn btn-default btn-flat">Salir</a>
                  </div>
                </li>
              </ul>
            </li>