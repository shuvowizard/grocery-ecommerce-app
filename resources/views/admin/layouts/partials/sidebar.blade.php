<div class="main-sidebar">
        <aside id="sidebar-wrapper">
                <div class="sidebar-brand">
                        <a href="{{ route('admin.dashboard') }}">Admin Panel</a>
                </div>
                <div class="sidebar-brand sidebar-brand-sm">
                        <a href="{{ route('admin.dashboard') }}"></a>
                </div>

                <ul class="sidebar-menu">

                        <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('admin.dashboard') }}"><i class="fas fa-home"></i>
                                        <span>Dashboard</span></a></li>

                        <li class="{{ request()->is('admin/profile') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('admin.profile') }}"><i class="fas fa-user"></i>
                                        <span>Profile</span></a></li>

                        <li class="{{ request()->routeIs('admin.user.index') ? 'active' : '' }}"><a class="nav-link"
                                        href="{{ route('admin.user.index') }}"><i class="fas fa-users"></i>
                                        <span>Manage User</span></a></li>

                        <li class="nav-item dropdown {{ request()->is('admin/category/*') ? 'active' : '' }}">
                                <a href="#"
                                        class="nav-link has-dropdown"><i
                                                class="fas fa-folder"></i><span>Manage Product</span></a>
                                <ul class="dropdown-menu">
                                        <li class="{{ request()->routeIs('admin.category.index') ? 'active' : '' }}"><a
                                                        class="nav-link" href="{{ route('admin.category.index') }}"><i
                                                                class="fas fa-angle-right"></i>Category</a></li>
                                        <li class=""><a class="nav-link" href=""><i
                                                                class="fas fa-angle-right"></i>Product</a></li>
                                </ul>
                        </li>

                        <li><a class="nav-link" href="{{ route('admin.logout') }}"><i class="fas fa-sign-out-alt"></i>
                                        <span>Logout</span></a></li>

                </ul>
        </aside>
</div>