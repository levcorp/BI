    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p>{{Auth::user()->nombre}}</p>
            <a href="#"><i class="fa fa-circle text-success"></i> En Linea</a>
          </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
          <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                  </button>
                </span>
          </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header">Menu Principal</li>
          <li class="treeview {{active(['panel/*','panel'])}}">
            <a href="#">
              <i class="fa fa-bar-chart-o"></i> <span>Panel</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{active('panel')}}"><a href="{{route('panel')}}"><i class="fa fa-line-chart"></i> Ventas</a></li>
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