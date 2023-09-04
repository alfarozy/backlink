<aside class="main-sidebar sidebar-dark-success elevation-4">
    <!-- Brand Logo -->
    <a href="/admin" class="brand-link">

        <span class="brand-text font-weight-light"><b class="ml-3">Dashboard</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/backoffice/dist/img/no-avatar.svg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth()->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
                <li class="nav-item menu-open mt-3">
                    <a href="{{ route('dashboard.index') }}"
                        class="nav-link {{ request()->routeIs('dashboard.index') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>

                </li>

                <li class="nav-header">Master data</li>
                <li class="nav-item">
                    <a href="{{ route('backlink.index') }}"
                        class="nav-link {{ request()->routeIs('backlink*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-link"></i>
                        <p>
                            Data backlink
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('member.index') }}"
                        class="nav-link {{ request()->routeIs('member*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Member
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('data-backlink-premium.index') }}"
                        class="nav-link {{ request()->routeIs('data-backlink-premium*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-cart-arrow-down"></i>
                        <p>
                            Data Pesanan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('premium-package.index') }}"
                        class="nav-link {{ request()->routeIs('premium-package*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-gem"></i>
                        <p>
                            Paket layanan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('paket-member-premium.index') }}"
                        class="nav-link {{ request()->routeIs('paket-member-premium*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-gem"></i>
                        <p>
                            Paket berlangganan
                        </p>
                    </a>
                </li>

                {{--
                    <li class="nav-item">
                        <a href="{{ route('member.index') }}"
                            class="nav-link {{ request()->routeIs('member*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th-large"></i>
                            <p>
                                Member
                            </p>
                        </a>
                    </li>
                <li class="nav-item">
                    <a href="{{ route('category.index') }}"
                        class="nav-link {{ request()->routeIs('category*') ? 'active' : '' }}">
                        <i class="nav-icon far fa-list-alt"></i>
                        <p>
                            Categories
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('technology.index') }}"
                        class="nav-link {{ request()->routeIs('technology*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-laptop-code"></i>
                        <p>
                            Technologies
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                        class="nav-link {{ request()->routeIs('users*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Users
                        </p>
                    </a>
                </li> --}}

                <li class="nav-header">Settings</li>
                {{-- <li class="nav-item">
                    <a href="{{ route('profile') }}"
                        class="nav-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-user-circle"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('update-password') }}"
                        class="nav-link {{ request()->routeIs('update-password.*') ? 'active' : '' }}">
                        <i class="nav-icon fa fa-unlock-alt"></i>
                        <p>
                            Update Password
                        </p>
                    </a>
                </li> --}}
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
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
