<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
       
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
            <li class="nav-item">
                <a href="{{ route('users.index') }}"
                    class="nav-link {{ Request::is('users') ? 'active' : '' }} ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Admin</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('employee.index') }}"
                    class="nav-link {{ Request::is('employee') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Employee</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('task.index') }}"
                    class="nav-link {{ Request::is('task') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Task</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('event.index') }}"
                    class="nav-link {{ Request::is('event') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Events</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('department.index') }}"
                    class="nav-link {{ Request::is('department') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Departments</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('leave.index') }}"
                    class="nav-link {{ Request::is('leave') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Leaves</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('salary.index') }}"
                    class="nav-link {{ Request::is('salary') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Salary</p>
                </a>
            </li>
            <li class="nav-item ">
                <a href="{{ route('attendance.index') }}"
                    class="nav-link {{ Request::is('attendance') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Attendance</p>
                </a>
            </li>
          @elseif(Auth::user()->user_permission == ',4')
            <li class="nav-item">
                <a href="{{ route('admin.employee.list') }}"
                    class="nav-link {{ Request::is('admin-dashboard/employee-list') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Employee</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('event.list') }}"
                    class="nav-link {{ Request::is('event') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Events</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('salary.index') }}"
                    class="nav-link {{ Request::is('salary') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Salary</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('attendance.index') }}"
                    class="nav-link {{ Request::is('attendance') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Attendance</p>
                </a>
            </li>
        @endif
        @if (Auth::user()->user_permission == ',3')
            <li class="nav-item">
                <a href="{{ route('admin.department.list') }}"
                    class="nav-link {{ Request::is('department') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Departments</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.leave.list') }}"
                    class="nav-link {{ Request::is('leave') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Leaves</p>
                </a>
            </li>
        @endif
        @if (Auth::user()->user_permission == ',2')
            <li class="nav-item">
                <a href="{{ route('task.index') }}"
                    class="nav-link {{ Request::is('task') ? 'active' : '' }}  ">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Task</p>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a href="{{ route('meta.index') }}"
                class="nav-link {{ Request::is('meta') ? 'active' : '' }}  ">
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
