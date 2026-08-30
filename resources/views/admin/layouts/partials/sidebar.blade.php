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

            <li
                class="nav-item dropdown {{ request()->is('admin/category/*', 'admin/product/*', 'admin/coupon/*', 'admin/delivery/*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown">
                    <i class="fas fa-folder"></i>
                    <span>Manage Product</span>
                </a>
                <ul class="dropdown-menu">
                    <li
                        class="{{ request()->routeIs('admin.category.index') || request()->routeIs('admin.category.create') || request()->routeIs('admin.category.edit') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.category.index') }}">
                            <i class="fas fa-angle-right"></i>Category
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/product/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.product.index') }}">
                            <i class=" fas fa-angle-right"></i>Product
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/coupon/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.coupon.index') }}">
                            <i class=" fas fa-angle-right"></i>Coupon
                        </a>
                    </li>
                    <li class="{{ request()->is('admin/delivery/*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('admin.delivery.index') }}">
                            <i class=" fas fa-angle-right"></i>Delivery
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ request()->routeIs('admin.order.index') ? 'active' : '' }}"><a class="nav-link"
                    href="{{ route('admin.order.index') }}"><i class="fas fa-list"></i>
                    <span>Manage Orders</span></a></li>

            <li><a class="nav-link" href="{{ route('admin.logout') }}"><i class="fas fa-sign-out-alt"></i>
                    <span>Logout</span></a></li>

        </ul>
    </aside>
</div>
