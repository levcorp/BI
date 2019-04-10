    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="{{asset('../../dist/img/avatar04.png')}}" class="img-circle" alt="User Image">
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
          <li class="treeview {{active(['panel/dashboard/*','panel'])}}">
            <a href="#">
              <i class="fa fa-bar-chart-o"></i> <span>Panel</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{active(['panel/*','panel.*'])}}"><a href="{{route('panel')}}"><i class="fa fa-line-chart"></i> Ventas</a></li>
            </ul>
          </li>
          <li class="treeview {{active(['solicitud.*','detalle.*'])}}">
          <a href="#">
            <i class="fa fa-files-o"></i> <span>Solicitudes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{active(['solicitud.*','detalle.*'])}}"><a href="{{route('solicitud.index')}}"><i class="fa fa-file-text-o"></i> Articulos ABM</a></li>
          </ul>
        </li>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>