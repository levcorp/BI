    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{asset('/archivos/perfil/'.Auth::user()->avatar)}}" class="img-circle" alt="Avatar ">
          </div>
          <div class="pull-left info">
            <p>{{ucwords(Auth::user()->nombre." ".Auth::user()->apellido)}}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> En Linea</a>
          </div>
        </div>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">Menu Principal</li>
          @if(isset(Auth::user()->perfil->asignacionModulo))
          @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','4'))
            <li class="treeview {{active(['panel/dashboard/*','panel'])}}">
              <a href="#">
                <i class="fa fa-bar-chart-o"></i> <span>Panel</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                @if(isset(Auth::user()->perfil->asignacionModulo))
                  @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','4'))
                  <li class="{{active(['panel/dashboard/*','panel'])}}"><a href="{{route('panel')}}"><i class="fa fa-line-chart"></i> Ventas</a></li>
                  @endif
                @endif
              </ul>
            </li>
          @endif
          @endif
          @if(isset(Auth::user()->perfil->asignacionModulo))
            @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','5') || Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','6') || Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','7'))
            <li class="treeview {{active(['usuarios','perfiles','sucursales'])}}">
              <a href="#">
                <i class="fa fa-cubes"></i> <span>Administración</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                 @if(isset(Auth::user()->perfil->asignacionModulo))
                  @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','5'))
                    <li class="{{active('usuarios')}}"><a href="{{route('usuarios')}}"><i class="fa fa-users"></i> Usuarios</a></li>
                  @endif
                  @endif
                  @if(isset(Auth::user()->perfil->asignacionModulo))
                  @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','6'))
                    <li class="{{active('panel/perfiles', 'active')}}"><a href="{{route('perfiles')}}"><i class="fa fa-object-group"></i> Perfiles</a></li>
                  @endif
                  @endif
                  @if(isset(Auth::user()->perfil->asignacionModulo))
                  @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','7'))
                    <li class="{{active('sucursales')}}"><a href="{{route('sucursales')}}"><i class="fa fa-building-o"></i> Sucursales</a></li>
                  @endif
                  @endif
              </ul>
            </li>
            @endif
          @endif
          @if(isset(Auth::user()->perfil->asignacionModulo))
            @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','1'))
              <li class="treeview {{active(['solicitud.*','detalle.*'])}}">
                <a href="#">
                  <i class="fa fa-files-o"></i> <span>Solicitudes</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  @if(isset(Auth::user()->perfil->asignacionModulo))
                    @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','1'))
                      <li class="{{active(['solicitud.*','detalle.*'])}}"><a href="{{route('solicitud.index')}}"><i class="fa fa-file-text-o"></i> Articulos ABM</a></li>
                    @endif
                  @endif
                </ul>
            </li>
            @endif
          @endif
          @if(isset(Auth::user()->perfil->asignacionModulo))
          @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','2') || Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','3'))
            <li class="treeview {{active(['edi','gpos'])}}">
              <a href="#">
                <i class="fa fa-tasks"></i> <span>Generacion de EDIS</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                @if(isset(Auth::user()->perfil->asignacionModulo))
                  @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','2'))
                  <li class="{{active(['edi'])}}">
                    <a href="{{route('edi')}}"><i class="fa fa-bookmark-o"></i> <span>EDI 852</span></a>
                  </li>
                  @endif
                @endif
                @if(isset(Auth::user()->perfil->asignacionModulo))
                  @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','3'))
                  <li class="{{active(['gpos'])}}">
                    <a href="{{route('gpos')}}"><i class="fa fa-bookmark-o"></i> <span>EDI 867 (GPOS)</span></a>
                  </li>
                  @endif
                @endif
              </ul>
          </li>
          @endif
          @endif
          @if(isset(Auth::user()->perfil->asignacionModulo))
          @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','8') || Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','9') || Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','10') || Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','11') || Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','12') )
          <li class="treeview {{active(['stock'])}}">
              <a href="#">
                <i class="fa fa-shopping-bag"></i> <span>Ventas</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                  @if(isset(Auth::user()->perfil->asignacionModulo))
                  @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','8'))
                  <li class="{{active(['stock'])}}">
                    <a href="{{route('stock')}}"><i class="fa fa-cubes"></i> <span>Stock Articulos</span></a>
                  </li>
                  @endif
                  @endif
                  @if(isset(Auth::user()->perfil->asignacionModulo))
                  @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','9'))
                  <li class="{{active(['tareas'])}}">
                    <a href="{{route('tareas')}}"><i class="fa fa-cubes"></i> <span>Tareas Ventas (General)</span></a>
                  </li>
                  @endif
                  @endif
                  @if(isset(Auth::user()->perfil->asignacionModulo))
                  @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','10'))
                  <li class="{{active(['tareasUsuario'])}}">
                    <a href="{{route('tareasUsuario')}}"><i class="fa fa-cubes"></i> <span>Tareas Asignadas</span></a>
                  </li>
                  @endif
                  @endif
                  @if(isset(Auth::user()->perfil->asignacionModulo))
                  @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','11'))
                  <li class="{{active(['tareasCusuario'])}}">
                    <a href="{{route('tareasCusuario')}}"><i class="fa fa-cubes"></i> <span>Tareas Creadas</span></a>
                  </li>
                  @endif
                  @endif
                  @if(isset(Auth::user()->perfil->asignacionModulo))
                  @if(Auth::user()->perfil->asignacionModulo->firstWhere('modulo_id','12'))
                  <li class="{{active(['tareasEspecialidad'])}}">
                    <a href="{{route('tareasEspecialidad')}}"><i class="fa fa-cubes"></i> <span>Tareas Especialidad</span></a>
                  </li>
                  @endif
                  @endif
              </ul>
          </li>
          @endif
          @endif
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>