@if (Auth::user()->id_level == '1')
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-chart-pie"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-receipt"></i>
            <span>Generate Invoice</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('shortlink.index') }}">
            <i class="fas fa-code"></i>
            <span>Shortlink</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Penyewaan</div>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-camera"></i>
            <span>Penyewaan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-history"></i>
            <span>Riwayat Penyewaan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('barang.index') }}">
            <i class="fas fa-box"></i>
            <span>Data Barang</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
            aria-controls="collapseTable">
            <i class="fas fa-fw fa-table"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data</h6>
            <a class="collapse-item" href="{{route('kategori.index')}}">Kategori</a>
            <a class="collapse-item" href="{{route('jaminan.index')}}">Jaminan</a>
            <a class="collapse-item" href="{{route('status_sewa.index')}}">Status Sewa</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Event</div>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-calendar"></i>
            <span>Event</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-history"></i>
            <span>Riwayat Event</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('paket_event.index') }}">
            <i class="fas fa-box"></i>
            <span>Pricelist Event</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTableB" aria-expanded="true"
            aria-controls="collapseTableB">
            <i class="fas fa-fw fa-table"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseTableB" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data</h6>
            <a class="collapse-item" href="{{ route('status_event.index') }}">Status Event</a>
            <a class="collapse-item" href="{{ route('jobdesc_event.index') }}">Jobdesc Event</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Users</div>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('pegawai.index') }}">
            <i class="fas fa-user"></i>
            <span>Pegawai</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('level.index') }}">
            <i class="fas fa-user-shield"></i>
            <span>Level Users</span>
        </a>
    </li>
@elseif (Auth::user()->id_level == '2')
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-chart-pie"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('shortlink.index') }}">
            <i class="fas fa-code"></i>
            <span>Shortlink</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Penyewaan</div>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-camera"></i>
            <span>Penyewaan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-history"></i>
            <span>Riwayat Penyewaan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('barang.index') }}">
            <i class="fas fa-box"></i>
            <span>Data Barang</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
            aria-controls="collapseTable">
            <i class="fas fa-fw fa-table"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data</h6>
            <a class="collapse-item" href="{{route('kategori.index')}}">Kategori</a>
            <a class="collapse-item" href="{{route('jaminan.index')}}">Jaminan</a>
            <a class="collapse-item" href="{{route('status_sewa.index')}}">Status Sewa</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Event</div>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-calendar"></i>
            <span>Event</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-history"></i>
            <span>Riwayat Event</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('paket_event.index') }}">
            <i class="fas fa-box"></i>
            <span>Pricelist Event</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTableB" aria-expanded="true"
            aria-controls="collapseTableB">
            <i class="fas fa-fw fa-table"></i>
            <span>Master Data</span>
        </a>
        <div id="collapseTableB" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Data</h6>
            <a class="collapse-item" href="{{ route('status_event.index') }}">Status Event</a>
            <a class="collapse-item" href="{{ route('jobdesc_event.index') }}">Jobdesc Event</a>
            </div>
        </div>
    </li>
@elseif (Auth::user()->id_level == '3')
    <hr class="sidebar-divider my-0">
    <li class="nav-item">
        <a class="nav-link" href="{{route('home')}}">
            <i class="fas fa-chart-pie"></i>
            <span>Dashboard</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('shortlink.index') }}">
            <i class="fas fa-code"></i>
            <span>Shortlink</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Penyewaan</div>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-camera"></i>
            <span>Penyewaan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-history"></i>
            <span>Riwayat Penyewaan</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('barang.index') }}">
            <i class="fas fa-box"></i>
            <span>Data Barang</span>
        </a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Event</div>
    <li class="nav-item">
        <a class="nav-link" href="">
            <i class="fas fa-calendar"></i>
            <span>Event</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="fas fa-history"></i>
            <span>Riwayat Event</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('paket_event.index') }}">
            <i class="fas fa-box"></i>
            <span>Pricelist Event</span>
        </a>
    </li>
@endif