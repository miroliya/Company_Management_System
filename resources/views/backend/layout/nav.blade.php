<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->


        @if (Auth::user()->user_permission == '1,2,3,4')
            <li class="nav-item  ">
                <a href="{{ route('admin.dashboard') }}"
                    class="nav-link {{ Request::is('admin-dashboard') ? 'active' : '' }} ">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item  ">
                <a href="{{ route('admin.user.list') }}"
                    class="nav-link {{ Request::is('admin-dashboard/admin-list') ? 'active' : '' }} ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Admin</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('admin.employee.list') }}"
                    class="nav-link {{ Request::is('admin-dashboard/employee-list') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Employee</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('admin.task.list') }}"
                    class="nav-link {{ Request::is('admin-dashboard/task-list') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Task</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('admin.event.list') }}"
                    class="nav-link {{ Request::is('admin-dashboard/event-list') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Events</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('admin.department.list') }}"
                    class="nav-link {{ Request::is('admin-dashboard/department-list') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Departments</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('admin.leave.list') }}"
                    class="nav-link {{ Request::is('admin-dashboard/leave-list') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Leaves</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('admin.salary.list') }}"
                    class="nav-link {{ Request::is('admin-dashboard/salary-list') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Salary</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('admin.attendance.list') }}"
                    class="nav-link {{ Request::is('admin-dashboard/attendance-list') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Attendance</p>
                </a>
            </li>
          @elseif(Auth::user()->user_permission == ',4')
            <li class="nav-item ">
                <a href="{{ route('admin.employee.list') }}"
                    class="nav-link {{ Request::is('admin-dashboard/employee-list') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Employee</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('admin.event.list') }}"
                    class="nav-link {{ Request::is('admin-dashboard/event-list') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Events</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('admin.salary.list') }}"
                    class="nav-link {{ Request::is('admin-dashboard/salary-list') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Salary</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('admin.attendance.list') }}"
                    class="nav-link {{ Request::is('admin-dashboard/attendance-list') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Attendance</p>
                </a>
            </li>
        @endif
        @if (Auth::user()->user_permission == ',3')
            <li class="nav-item ">
                <a href="{{ route('admin.department.list') }}"
                    class="nav-link {{ Request::is('admin-dashboard/department-list') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Departments</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('admin.leave.list') }}"
                    class="nav-link {{ Request::is('admin-dashboard/leave-list') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Leaves</p>
                </a>
            </li>
        @endif
        @if (Auth::user()->user_permission == ',2')
            <li class="nav-item ">
                <a href="{{ route('admin.task.list') }}"
                    class="nav-link {{ Request::is('admin-dashboard/task-list') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Task</p>
                </a>
            </li>
        @endif
        <li class="nav-item ">
            <a href="{{ route('admin.meta.list') }}"
                class="nav-link {{ Request::is('admin-dashboard/meta-list') ? 'active' : '' }}  ">
                <i class="far fa-circle nav-icon"></i>
                <p>User Meta</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="javascript:void(0)" data-toggle="modal" data-target="#changepassword" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                    Change Password
                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('admin.logout') }}" class="nav-link">
                <i class="nav-icon fas fa-power-off"></i>
                <p>
                    Logout
                </p>
            </a>
        </li>


    </ul>
</nav>
