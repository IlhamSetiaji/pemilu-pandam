<div class="main-sidebar">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="#">Pemilu-OSIS</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="#">PO</a>
      </div>
      <ul class="sidebar-menu">
        @if (auth()->user()->hasRole('admin'))
          <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="{{ url('admin/') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
          <li class="menu-header">Data Pemilu</li>
            <li><a class="nav-link" href="{{ url('admin/pemilu') }}"><i class="fas fa-tachometer-alt"></i> <span>Data Pemilu</span></a></li>
          <li class="menu-header">Data Calon Ketua</li>
            <li><a class="nav-link" href="{{ url('admin/calon') }}"><i class="fas fa-tachometer-alt"></i> <span>Data Calon Ketua</span></a></li>
        @endif
        @if (auth()->user()->hasRole('pemilih'))
          <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="{{ url('/') }}"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
        @endif
      </ul>
{{--         <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
          <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
            <i class="fas fa-rocket"></i> Documentation
          </a>
        </div> --}}
    </aside>
  </div>