<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ route('profile.show') }}" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div> --}}

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('events.index') }}" class="nav-link  @if(request()->routeIs('events.*')) active @endif">
                    <i class="fas fa-calendar-alt pl-1 pr-2"></i>
                    <p>
                        {{ __('Manage Events') }}
                    </p>
                </a>
            </li>

            @if(auth()->user()->isAdmin())
                <li class="nav-item @if(request()->routeIs('students.*')|| request()->routeIs('faculties.*')) menu-is-opening menu-open @endif">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            {{ __('Users') }}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: @if(request()->routeIs('students.*') || request()->routeIs('faculties.*')) block @else none @endif;">
                        <li class="nav-item">
                            <a href="{{ route('students.index') }}" class="nav-link @if(request()->routeIs('students.*')) active @endif">
                                <i class="fas fa-user-graduate"></i>
                                <p>Manage Students</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('faculties.index') }}" class="nav-link @if(request()->routeIs('faculties.*')) active @endif">
                                <i class="fas fa-user-tie"></i>
                                <p>Manage Faculties</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a href="{{ route('about') }}" class="nav-link">
                        <i class="nav-icon far fa-address-card"></i>
                        <p>
                            {{ __('About us') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-circle nav-icon"></i>
                        <p>
                            Two-level menu
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none;">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Child menu</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->