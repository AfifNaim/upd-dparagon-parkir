<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="">{{ config('app.name') }}</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="parking">{{ strtoupper(substr(config('app.name'), 0, 2)) }}</a>
    </div>
    <ul class="sidebar-menu">
        <li class="menu-header">DASHBOARD</li>
        <li {{ Route::is('parking.index') ? 'class=active' : '' }} ><a class="nav-link" href="{{ route('parking.index') }}"><i class="fas fa-home"></i><span>Parkir</span></a></li>
        <li><a class="nav-link" target="_blank" href="#"><i class="fas fa-scroll"></i> <span>Halaman Utama</span></a></li>
  
        @if (Auth::user()->is_admin == true)
          <li class="menu-header">Master</li>
          <li {{ Route::is('parking.report') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('parking.report') }}"><i class="fas fa-file"></i><span>Laporan Parkir</span></a></li>
          <li {{ Route::is('vehicle.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('vehicle.index') }}"><i class="fas fa-car"></i><span>Jenis Kendaraan</span></a></li>
          <li {{ Route::is('price.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('price.index') }}"><i class="fas fa-money-bill"></i><span>Tarif Parkir Kendaraan</span></a></li>
          <li {{ Route::is('capacity.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('capacity.index') }}"><i class="fas fa-parking"></i><span>Kapasitas Parkir Kendaraan</span></a></li>
          <li {{ Route::is('user.index') ? 'class=active' : '' }}><a class="nav-link" href="{{ route('user.index') }}"><i class="fas fa-user-alt"></i><span>User</span></a></li>
        @endif
  
    </ul>
  </aside>
  