<aside class="main-sidebar sidebar-light-blue elevation-4">
  <!-- Brand Logo -->
  <!-- <a href="" class="brand-link">
    <img src="{{ asset('templates/backend/AdminLTE-3.1.0') }}/dist/img/laravel.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">E-Tagihan</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="my-auto ml-3">
        <i class="nav-icon fas fa-user-circle fa-2x text-dark"></i>
      </div>
      <div class="info">
        <a href="javascript:void(0)" class="d-block">{{ Auth::user()->username }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        @role('admin')
        <li class="nav-item">
          <a href="{{ route('dashboard.index') }}" class="nav-link {{ Request::segment(2) == 'dashboard' ? 'active' : '' }}">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('home.index') }}" class="nav-link {{ Request::segment(1) == 'home' ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        @endrole
        
        @role('petugas')
        <li class="nav-item">
          <a href="{{ route('home.index') }}" class="nav-link {{ Request::segment(1) == 'home' ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        @elserole('dokter')
        <li class="nav-item">
          <a href="{{ route('home.index') }}" class="nav-link {{ Request::segment(1) == 'home' ? 'active' : '' }}">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        @endrole
        
        @role('admin')
        <li class="nav-header">MANAJEMEN DATA</li>
        <li class="nav-item">
          <a href="{{ route('dokter.index') }}" class="nav-link {{ Request::segment(2) == 'dokter' ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Dokter
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pembayaran-tagihan.index') }}" class="nav-link {{ Request::segment(2) == 'pembayaran-tagihan' ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Pembayaran
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('admin-list.index') }}" class="nav-link {{ Request::segment(2) == 'admin-list' ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-tie"></i>
            <p>
              Admin
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('user.index') }}" class="nav-link {{ Request::segment(2) == 'user' ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Daftar Akun
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('petugas.index') }}" class="nav-link {{ Request::segment(2) == 'petugas' ? 'active' : '' }}">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Petugas
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('tagihan.index') }}" class="nav-link {{ Request::segment(2) == 'tagihan' ? 'active' : '' }}">
            <i class="nav-icon fas fa-money-bill"></i>
            <p>
              Tagihan
            </p>
          </a>
        </li>
        @endrole
        
        @role('petugas')
        <li class="nav-header">MANAJEMEN DATA</li>
        <li class="nav-item">
          <a href="{{ route('dokter.index') }}" class="nav-link {{ Request::segment(2) == 'dokter' ? 'active' : '' }}">
            <i class="nav-icon fas fa-users"></i>
            <p>
              Dokter
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pembayaran-tagihan.index') }}" class="nav-link {{ Request::segment(2) == 'pembayaran-tagihan' ? 'active' : '' }}">
            <i class="nav-icon fas fa-list"></i>
            <p>
              Pembayaran
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('tagihan.index') }}" class="nav-link {{ Request::segment(2) == 'tagihan' ? 'active' : '' }}">
            <i class="nav-icon fas fa-money-bill"></i>
            <p>
              Tagihan
            </p>
          </a>
        </li>
        @endrole

        @role('admin|petugas')
        <li class="nav-header">Surat</li>
        <li class="nav-item">
          <a href="{{ route('rekomendasi.index') }}" class="nav-link {{ Request::segment(2) == 'rekomendasi' ? 'active' : '' }}">
            <i class="nav-icon fas fa-envelope"></i>
            <p>
              Buat Rekomendasi
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('rekomendasi.surat-rekomendasi') }}" class="nav-link {{ Request::segment(2) == 'surat-rekomendasi' ? 'active' : '' }}">
            <i class="nav-icon fas fa-print fa-fw"></i>
            <p>
              Cetak Rekomendasi
            </p>
          </a>
        </li>
        @endrole

        @role('admin|petugas')
        <li class="nav-header">PEMBAYARAN</li>
        <li class="nav-item">
          <a href="{{ route('pembayaran.index') }}" class="nav-link {{ Request::segment(2) == 'bayar' ? 'active' : '' }}">
            <i class="nav-icon fas fa-money-check"></i>
            <p>
              Pembayaran Tagihan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pembayaran.status-pembayaran') }}" class="nav-link {{ Request::segment(2) == 'status-pembayaran' ? 'active' : '' }}">
            <i class="nav-icon fas fa-money-bill"></i>
            <p>
              Status Pembayaran
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pembayaran.history-pembayaran') }}" class="nav-link {{ Request::segment(2) == 'history-pembayaran' ? 'active' : '' }}">
            <i class="nav-icon fas fa-history"></i>
            <p>
              Riwayat Pembayaran
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('pembayaran.laporan') }}" class="nav-link {{ Request::segment(2) == 'laporan' ? 'active' : '' }}">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Laporan Pembayaran
            </p>
          </a>
        </li>
        @endrole
        
        @role('dokter')
        <li class="nav-header">PEMBAYARAN</li>
        <li class="nav-item">
          <a href="{{ route('dokter.pembayaran-tagihan') }}" class="nav-link {{ Request::segment(2) == 'pembayaran-tagihan' ? 'active' : '' }}">
            <i class="nav-icon fas fa-money-bill"></i>
            <p>
              Pembayaran
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dokter.history-pembayaran') }}" class="nav-link {{ Request::is('dokter/history-pembayaran') ? 'active' : '' }}">
            <i class="nav-icon fas fa-history"></i>
            <p>
              Riwayat Pembayaran
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('dokter.laporan-pembayaran') }}" class="nav-link {{ Request::is('dokter/laporan-pembayaran') ? 'active' : '' }}">
            <i class="nav-icon fas fa-file"></i>
            <p>
              Laporan
            </p>
          </a>
        </li>
        @endrole

        @role('admin')
        <li class="nav-header">ROLES - PERMISSIONS</li>
        <li class="nav-item">
          <a href="{{ route('roles.index') }}" class="nav-link {{ Request::segment(2) == 'roles' ? 'active' : '' }}">
            <i class="nav-icon fas fa-user-tie"></i>
            <p>
              Roles List
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('permissions.index') }}" class="nav-link {{ Request::segment(2) == 'permissions' ? 'active' : '' }}">
            <i class="nav-icon fas fa-key"></i>
            <p>
              Permissions List
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('role-permission.index') }}" 
          class="nav-link {{ Request::segment(2) == 'role-permission' ? 'active' : '' }}">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              Role - Permission
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('user-role.index') }}" 
          class="nav-link {{ Request::segment(2) == 'user-role' ? 'active' : '' }}">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              User - Role
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('user-permission.index') }}" 
          class="nav-link {{ Request::segment(2) == 'user-permission' ? 'active' : '' }}">
            <i class="nav-icon fas fa-circle"></i>
            <p>
              User - Permission
            </p>
          </a>
        </li>
        @endrole
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>