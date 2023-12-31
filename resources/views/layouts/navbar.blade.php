<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ asset('images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ asset('images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ asset('images/logo-light.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">
            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                @if (Auth::user()->role_id == 1)
                    <li class="nav-item">
                        <a class="nav-link menu-link @if(Request::segment(2) == 'dashboard') active @endif " href="{{route('admin.dashboard')}}">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets">Dashboards</span>
                        </a>
                    </li> <!-- end Dashboard Menu -->
                    <li class="nav-item">
                        <a class="nav-link menu-link @if(Request::segment(3) == 'index') active @endif " href="{{ route('admin.adminManagement.index') }}">
                            <i class="ri-account-circle-line"></i> <span data-key="t-widgets">Quản lý Admin</span>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->role_id == 2)
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('dashboard-teacher')}}" @if(Request::segment(2) == 'dashboard-teacher') active @endif ">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets">Dashboards</span>
                        </a>
                    </li> <!-- end Dashboard Menu -->
                @endif
                @if (Auth::user()->role_id == 3)
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('dashboard-student')}}" @if(Request::segment(2) == 'dashboard-student') active @endif ">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets">Dashboards</span>
                        </a>
                    </li> <!-- end Dashboard Menu -->
                @endif
                @if (Auth::user()->role_id == 4)
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route('dashboard-parent')}}" @if(Request::segment(2) == 'dashboard-parent') active @endif ">
                            <i class="ri-dashboard-2-line"></i> <span data-key="t-widgets">Dashboards</span>
                        </a>
                    </li> <!-- end Dashboard Menu -->
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
