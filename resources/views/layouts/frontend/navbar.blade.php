<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
    <a href="{{ url('/') }}" class="navbar-brand d-flex align-items-center text-center py-0 px-4 px-lg-5">
        <h1 class="m-0 text-primary">e-Rekap BaPok</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto p-4 p-lg-0">
            <a href="{{ url('/') }}" class="nav-item nav-link active">Home</a>
            <a href="{{ route('about') }}" class="nav-item nav-link">About</a>
            @auth
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Data Komoditi</a>
                    @php
                        $data = App\Models\Kategori::orderBy('nama_komoditi', 'asc')->get();
                    @endphp
                    <div class="dropdown-menu rounded-0 m-0">
                        @if ($data->isEmpty())
                            <li>
                                <a href="{{ route('kategori.create') }}">
                                    <span class="sub-item">Belum ada Data</span>
                                </a>
                            </li>
                        @else
                            @foreach ($data as $item)
                                <a href="{{ route('detail.index', $item->id) }}"
                                    class="dropdown-item">{{ $item->nama_komoditi }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Master Data</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="{{ route('kabupaten.index') }}" class="dropdown-item">List Kabupaten</a>
                        <a href="{{ route('kategori.index') }}" class="dropdown-item">List Komoditi</a>
                    </div>
                </div>
            </div>
        @endauth
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @method('POST')
                @csrf
                <button type="submit" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">login<i
                    class="fa fa-arrow-right ms-3"></i></a>
        @endauth
    </div>
</nav>
<!-- Navbar End -->
