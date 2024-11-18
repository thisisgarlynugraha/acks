<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <img class="d-inline-block" width="32px" height="30.61px" src="{{ asset('images/logo/acks.png') }}" alt=""> <b>Alat Cek Kesehatan</b>
        </div>
        
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('dashboard') }}">
                <img class="d-inline-block" width="32px" height="30.61px" src="{{ asset('images/logo/acks.png') }}" alt="">
            </a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">{{ __('Master') }}</li>
            @can('Dashboard')
                <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="fas fa-fire"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                </li>
            @endcan

            <li class="menu-header">{{ __('Management Data') }}</li>

            @can('Attendance - Read')
                <li class="{{ Request::routeIs('attendance.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('attendance.index') }}">
                        <i class="fas fa-users"></i>
                        <span>{{ __('Attendance') }}</span>
                    </a>
                </li>
            @endcan

            @can('Health Monitoring - Read')
                <li class="{{ Request::routeIs('health-monitoring.index') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('health-monitoring.index') }}">
                        <i class="fas fa-heart"></i>
                        <span>{{ __('Health Monitoring') }}</span>
                    </a>
                </li>
            @endcan

            <li class="menu-header">{{ __('Settings') }}</li>

            @can('Student - Read')
                <li class="dropdown">
                    <a href="" class="nav-link has-dropdown">
                        <i class="fas fa-th-large"></i>
                        <span>{{ __('Account') }}</span>
                    </a>
                    
                    <ul class="dropdown-menu">
                        <li class="{{ Request::routeIs('student.index') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('student.index') }}">{{ __('Student') }}</a>
                        </li>
                    </ul>
                </li>
            @endcan
        </ul>
    </aside>
</div>
