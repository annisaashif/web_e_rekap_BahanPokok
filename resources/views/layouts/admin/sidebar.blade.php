<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route('home') }}" class="logo">
                <h1>#</h1>
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
        <!-- End Logo Header -->
    </div>
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="collapsed">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Components</h4>
                </li>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kabupaten.index') }}">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Data Kabupaten</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('kategori.index') }}">
                        <i class="fas fa-th-list"></i>
                        <p>Kategori</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#base">
                        <i class="fas fa-layer-group"></i>
                        <p>Input Data</p>
                        <span class="caret"></span>
                    </a>
                    @php
                        $data = App\Models\Kategori::orderBy('nama_komoditi', 'asc')->get();
                    @endphp
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            @if ($data->isEmpty())
                                <li>
                                    <a href="{{ route('kategori.create') }}">
                                        <span class="sub-item">Belum ada Data, Input Kategori</span>
                                    </a>
                                </li>
                            @else
                                @foreach ($data as $item)
                                    <li>
                                        <a href="{{ route('detail.index', $item->id) }}">
                                            <span class="sub-item">{{ $item->nama_komoditi }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </div>
            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
