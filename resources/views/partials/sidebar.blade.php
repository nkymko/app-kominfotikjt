<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <img src="{{asset('img/jaktim.png')}}" alt="" class="img-brand" width="40px">
        </div>
        <div class="sidebar-brand-text mx-3">JakartaTimur</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ ($title === "Dashboard" ? 'active' : '') }}">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>
    
        
        @can('admin')
        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item {{ ($title === "Data Pegawai" || $title === "Data Sekbid" || $title === "Data Jabatan" || $title === 'Profile' ? 'active' : '') }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#nav-data"
                aria-expanded="true" aria-controls="nav-data">
                <i class="fas fa-fw fa-folder-open"></i>
                <span>Data</span>
            </a>
            <div id="nav-data" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Master Data:</h6>
                    <a class="collapse-item" href="/data-pegawai">Data Pegawai</a>
                    <a class="collapse-item" href="/data-sekbid">Data Sekbid</a>
                    <a class="collapse-item" href="/data-jabatan">Data Jabatan</a>
                </div>
            </div>
        </li>
        @endcan

        {{-- Nav Item - Absen Karyawan --}}
        <li class="nav-item {{ ($title === "Riwayat Absen" || $title === "Rekap Absen" ? 'active' : '') }}">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#nav-absen"
            aria-expanded="true" aria-controls="nav-absen">
            <i class="fas fa-fw fa-calendar"></i>
            <span>Data Absen</span>
        </a>
        <div id="nav-absen" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Data:</h6>
                @can('admin')
                <a class="collapse-item" href="/riwayat-absen">Riwayat Absen</a>
                <a class="collapse-item" href="/rekap-absen">Rekap Absen</a>
                @endcan
                @can('client')
                <a class="collapse-item" href="/riwayat-absen/{{ auth()->user()->username }}">Riwayat Absen</a>
                <a class="collapse-item" href="/rekap-absen/{{ auth()->user()->username }}">Rekap Absen</a>
                @endcan
            </div>
        </div>
    </li>       
    
    @can('admin')
    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Heading -->
    <div class="sidebar-heading">
        Admin Area
    </div>
    
    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#nav-arsip"
        aria-expanded="true" aria-controls="nav-arsip">
        <i class="fas fa-fw fa-folder"></i>
        <span>Arsip</span>
    </a>
    <div id="nav-arsip" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Master Data:</h6>
            <a class="collapse-item" href="buttons.html">Data Karyawan</a>
            <a class="collapse-item" href="cards.html">Data Jabatan</a>
        </div>
        </div>
    </li>
    
    <!-- Nav Item - Settings -->
    <li class="nav-item {{ ($title === "Settings" ? 'active' : '') }}">
        <a class="nav-link" href="/settings">
            <i class="fas fa-fw fa-cog"></i>
            <span>Settings</span></a>
        </li>
    @endcan
        
        
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>