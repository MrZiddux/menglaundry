<div class="main-sidebar">
   <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
         <a href="/">ZiLaundry</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
         <a href="/">ZL</a>
      </div>
      <ul class="sidebar-menu">
         @if (Auth::user()->role == 'admin')
            <li class="menu-header">Dashboard</li>
            <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="/" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
            <li class="nav-item dropdown {{ request()->is('outlets') || request()->is('members') || request()->is('packages') || request()->is('kurir') ? 'active' : '' }}">
                  <a href="#" class="nav-link has-dropdown"><i class="fas fa-database"></i><span>CRUD</span></a>
                  <ul class="dropdown-menu">
                     <li class="{{ request()->is('outlets') ? 'active' : '' }}"><a href="/outlets" class="nav-link"><i class="fas fa-store"></i><span>Outlet</span></a></li>
                     <li class="{{ request()->is('members') ? 'active' : '' }}"><a href="/members" class="nav-link"><i class="fas fa-users"></i><span>Member</span></a></li>
                     <li class="{{ request()->is('packages') ? 'active' : '' }}"><a href="/packages" class="nav-link"><i class="fas fa-cube"></i><span>Paket</span></a></li>
                     <li class="{{ request()->is('kurir') ? 'active' : '' }}"><a href="/kurir" class="nav-link"><i class="fas fa-truck"></i><span>Kurir</span></a></li>
                  </ul>
            </li>
            <li class="nav-item dropdown {{ request()->is('transaction/new') || request()->is('transactions') || request()->is('transaction/penjemputan-laundry') ? 'active' : '' }}">
                  <a href="#" class="nav-link has-dropdown"><i class="fas fa-shopping-cart"></i><span>Transaksi</span></a>
                  <ul class="dropdown-menu">
                     <li class="{{ request()->is('transaction/new') ? 'active' : '' }}"><a href="/transaction/new" class="nav-link"><i class="fas fa-plus"></i><span>Tambah Transaksi</span></a></li>
                     <li class="{{ request()->is('transactions') ? 'active' : '' }}"><a href="/transactions" class="nav-link"><i class="fas fa-edit"></i><span>Kelola Transaksi</span></a></li>
                     <li class="{{ request()->is('transaction/penjemputan-laundry') ? 'active' : '' }}"><a href="/transaction/penjemputan-laundry" class="nav-link"><i class="fas fa-truck-loading"></i><span>Penjemputan</span></a></li>
                  </ul>
            </li>
            <li class="nav-item dropdown {{ request()->is('laporan/transaksi') || request()->is('laporan/harian') ? 'active' : '' }}">
                  <a href="#" class="nav-link has-dropdown"><i class="fas fa-book"></i><span>Laporan</span></a>
                  <ul class="dropdown-menu">
                     <li class="{{ request()->is('laporan/harian') ? 'active' : '' }}"><a href="/laporan/harian" class="nav-link"><i class="fas fa-calendar"></i><span>Laporan Harian</span></a></li>
                     <li class="{{ request()->is('laporan/transaksi') ? 'active' : '' }}"><a href="/laporan/transaksi" class="nav-link"><i class="fas fa-money-bill"></i><span>Laporan Transaksi</span></a></li>
                  </ul>
            </li>
            <li class="menu-header">Manage</li>
            <li class="{{ request()->is('users') ? 'active' : '' }}"><a href="/users" class="nav-link"><i class="fas fa-user-circle"></i><span>User</span></a></li>
            <li class="menu-header">Algoritm</li>
            {{-- <li class="{{ request()->is('algoritma') ? 'active' : '' }}"><a href="/algoritma" class="nav-link"><i class="fas fa-project-diagram"></i><span>Algoritma</span></a></li> --}}
            <li class="{{ request()->is('simulasi') ? 'active' : '' }}"><a href="/simulasi" class="nav-link"><i class="fas fa-project-diagram"></i><span>Simulasi</span></a></li>
            {{-- <li class="{{ request()->is('penggunaan-barang') ? 'active' : '' }}"><a href="/penggunaan-barang" class="nav-link"><i class="fas fa-project-diagram"></i><span>Penggunaan Barang</span></a></li> --}}
         @elseif (Auth::user()->role == 'kasir')

         @endif
      </ul>

      {{-- <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
         <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
         <i class="fas fa-rocket"></i> Documentation
         </a>
      </div> --}}
   </aside>
</div>
