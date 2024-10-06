<aside class="main-sidebar sidebar-dark-primary elevation-4" style="background:#611c8f">
    
    <!-- Brand Logo -->
    <a href="{{routeHelper('dashboard')}}" class="brand-link">
      <center><img src="/uploads/setting/{{setting('logo')}}" alt="AdminLTE Logo" class="" style="opacity: .8;float:none;height:70px; width: 70px;"></center>  
        {{-- <span class="brand-text font-weight-light">AdminLTE 3</span> --}}
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{Auth::user()->avatar != 'default.png' ? '/uploads/member/'.Auth::user()->avatar:'/default/user.jpg'}}" class="img-circle elevation-2" alt="User Image" style="width:50px;height:50px">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{Auth::user()->name}}</a>
                <span class="text-white">Import/Exporter Panel</span>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            
                <li class="nav-item {{Request::is('dashboard') ? 'menu-is-opening menu-open':''}}">
                    <a href="{{routeHelper('dashboard')}}" class="nav-link">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item {{Request::is('list') ? 'menu-is-opening menu-open':''}}">
                    <a href="{{routeHelper('list')}}" class="nav-link">
                      <i class="nav-icon fas fa-tachometer-alt"></i>
                      <p>Import/Export Items</p>
                    </a>
                </li>
                

                <li class="nav-item {{Request::is('admin/profile*') ? 'menu-is-opening menu-open':''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            Profile
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{routeHelper('profile')}}" class="nav-link {{Request::is('admin/profile/show') ? 'active':''}}">
                                <i class="fas fa-user nav-icon"></i>
                                <p>My Profile</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{routeHelper('profile/change-password')}}" class="nav-link {{Request::is('admin/profile/change-password') ? 'active':''}}">
                                <i class="fas fa-key nav-icon"></i>
                                <p>Change Password</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-power-off"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
   
    <!-- /.sidebar -->
</aside>