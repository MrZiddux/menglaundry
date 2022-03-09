<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="/">ZiLaundry</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">ZL</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="/" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
            <li class="menu-header">CRUD</li>
            <li class="{{ request()->is('outlets') ? 'active' : '' }}"><a href="/outlets" class="nav-link"><i class="fas fa-store"></i><span>Outlets</span></a></li>
            <li class="{{ request()->is('members') ? 'active' : '' }}"><a href="/members" class="nav-link"><i class="fas fa-users"></i><span>Members</span></a></li>
            <li class="{{ request()->is('packages') ? 'active' : '' }}"><a href="/packages" class="nav-link"><i class="fas fa-cube"></i><span>Packages</span></a></li>
            <li class="menu-header">Transaction</li>
            <li class="{{ request()->is('transactions') ? 'active' : '' }}"><a href="/transactions" class="nav-link"><i class="fas fa-shopping-cart"></i><span>Transactions</span></a></li>
            <li class="{{ request()->is('transaction/new') ? 'active' : '' }}"><a href="/transaction/new" class="nav-link"><i class="fas fa-cart-plus"></i><span>New Transaction</span></a></li>
            <li class="{{ request()->is('transaction/manage') ? 'active' : '' }}"><a href="/transaction/manage" class="nav-link"><i class="fas fa-cart-arrow-down"></i><span>Manage Transaction</span></a></li>
            <li class="menu-header">Manage</li>
            <li class="{{ request()->is('users') ? 'active' : '' }}"><a href="/users" class="nav-link"><i class="fas fa-user-circle"></i><span>Users</span></a></li>
            <li class="menu-header">Algoritm</li>
            <li class="{{ request()->is('algoritma') ? 'active' : '' }}"><a href="/algoritma" class="nav-link"><i class="fas fa-project-diagram"></i><span>Algoritma</span></a></li>
        </ul>

        {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
            <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Documentation
            </a>
        </div> --}}
    </aside>
</div>