<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      
           <li class="nav-item  ">
            <a href="{{route('admin.dashboard')}}" class="nav-link {{ Request::is('admin-dashboard') ? 'active' : '' }} ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item  ">
            <a href="{{route('admin.user.list')}}" class="nav-link {{ Request::is('admin-dashboard/admin-list') ? 'active' : '' }} ">
              <i class="far fa-circle nav-icon"></i>
              <p>Admin</p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="{{route('admin.employee.list')}}" class="nav-link {{ Request::is('admin-dashboard/employee-list') ? 'active' : '' }}  ">
              <i class="far fa-circle nav-icon"></i>
              <p>Employee</p>
            </a>
          </li>
          {{-- <li class="nav-item ">
            <a href="{{route('admin.category.list')}}" class="nav-link {{ Request::is('admin-dashboard/category-list') ? 'active' : '' }}  ">
              <i class="far fa-circle nav-icon"></i>
              <p>HR</p>
            </a>
          </li> --}}
              {{-- <li class="nav-item ">
                <a href="#" class="nav-link ">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Others
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                
                </ul>
              </li> --}}
      
      {{-- <li class="nav-item  ">
        <a href="{{route('admin.system.setting')}}" class="nav-link {{ Request::is('admin-dashboard/system-setting') ? 'active' : '' }}">
          <i class="nav-icon fas fa-cog"></i>
          <p>
            Setting
          </p>
        </a>
      </li> --}}
     
      <li class="nav-item">
        <a href="javascript:void(0)" data-toggle="modal" data-target="#changepassword" class="nav-link">
          <i class="nav-icon fas fa-user"></i>
          <p>
            Change Password
          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{route('admin.logout')}}" class="nav-link">
          <i class="nav-icon fas fa-power-off"></i>
          <p>
            Logout
          </p>
        </a>
      </li>


    </ul>
  </nav>

