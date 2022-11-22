<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">Sekolah Vokasi UNS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">SV</a>
        </div>
        <ul class="sidebar-menu">
            @if (auth()->user()->hasRole('admin'))
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="{{ url('admin/') }}"><i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span></a></li>
            <li class="menu-header">Data Pemilu</li>
            <li><a class="nav-link" href="{{ url('admin/pemilu') }}"><i class="fas fa-tachometer-alt"></i>
                    <span>Data Pemilu</span></a></li>
            <li><a class="nav-link" href="{{ url('admin/dapil') }}"><i class="fas fa-tachometer-alt"></i>
                    <span>Data Dapil</span></a></li>
            <li class="menu-header">President</li>
            <li><a class="nav-link" href="{{ url('admin/president') }}"><i class="fas fa-tachometer-alt"></i> <span>Calon President</span></a></li>
            @endif
            @if (auth()->user()->hasRole('pemilih'))
            <li class="menu-header">Dashboard</li>
            <li><a class="nav-link" href="{{ url('/') }}"><i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span></a></li>
            @endif
        </ul>
    </aside>
</div>
