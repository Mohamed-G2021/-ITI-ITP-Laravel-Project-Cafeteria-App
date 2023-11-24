<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{url('admin/dashboard/order-products')}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link {{ request()->is('admin/dashboard/order-products') ? 'active' : '' }}" 
        href="{{url('admin/dashboard/order-products')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item {{ request()->is('admin/dashboard/products') ? 'active' : '' }}">          
        <a class="nav-link collapsed" href="{{url('admin/dashboard/products')}}">                          
            <i class="fas fa-fw fa-shopping-bag"></i>
            Products
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/dashboard/categories') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{url('admin/dashboard/categories')}}" >
            <i class="fas fa-fw fa-tags"></i>
            Categories
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/dashboard/orders') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{url('admin/dashboard/orders')}}" >
            <i class="fas fa-fw fa-sort-amount-up"></i>
            Orders
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/dashboard/checks') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{url('admin/dashboard/checks')}}" >
            <i class="fas fa-fw fa-check"></i>
            Checks
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/dashboard/branches') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{url('admin/dashboard/branches')}}" >
            <i class="fas fa-fw fa-code-branch"></i>
            Branches
        </a>
    </li>

    <li class="nav-item {{ request()->is('admin/dashboard/users') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="{{url('admin/dashboard/users')}}" >
            <i class="fas fa-fw fa-user"></i>
            Users
        </a>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!</p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div>

</ul>
<!-- End of Sidebar -->