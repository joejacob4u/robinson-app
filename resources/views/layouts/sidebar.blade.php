<aside class="main-sidebar">
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="/images/contact-icon.png" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>Admin</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
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


    <li class="header text-yellow"><strong>ADMIN</strong></li>

     <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>Inventory</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right"></span>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-circle-o"></i>Books</a></li>
            <li><a href="/admin/documents"><i class="fa fa-circle-o"></i>Documents</a></li>

          </ul>
      </li>
      <li><a href="{{url('admin/results')}}"><i class="fa fa-circle-o"></i>Results</a></li>
      <li>
              <a href="{{ route('logout') }}"  onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="fa fa-sign-out"></i> <span>Logout</span>
              </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                </form>
      </li>
  </ul>
</section>
</aside>
