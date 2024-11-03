@extends('layouts.frontend.main')
@section('konten')
    <!-- Search Start -->
    <div class="container-fluid bg-primary mb-5 wow fadeIn" data-wow-delay="0.1s" style="padding: 35px;">
        <div class="container">
            <form action="{{ route('welcome') }}" method="GET">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="row g-2">
                            <div class="col-md-4">
                                <select class="form-select border-0" name="kabupaten" required>
                                    <option value="">Pilih Kabupaten</option>
                                    @foreach ($kabupaten as $item)
                                        <option value="{{ Str::slug($item->nama_kabupaten) }}"
                                            {{ Str::slug($item->nama_kabupaten) == request('kabupaten') ? 'selected' : '' }}>
                                            {{ $item->nama_kabupaten }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="date" name="tanggal" value="{{ request('tanggal') }}"
                                    class="form-control border-0" required />
                            </div>
                        </div>

                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-dark border-0 w-100">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Search End -->
    <!-- CategoryStart -->
    <div class="container-xxl py-5">
        <div class="container">
            <p class="h5 fw-bold">Data Terbaru</p>
            <div class="row g-4">
                @foreach ($detailKategori as $data)
                    <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                        <a class="cat-item rounded p-4 bg-bawang-merah d-block" href="#">
                            <!-- Image -->
                            <img src="{{ url('images/komoditi/' . $data->kategori->foto) }}"
                                alt="{{ $data->kategori->nama_komoditi }}" class="img-fluid rounded mb-3"
                                style="object-fit:cover; width:100%; height:200px">
                            <!-- Text Below Image -->
                            <div class="text-center">
                                <h6 class="mb-1">{{ $data->kategori->nama_komoditi }}
                                    Rp.{{ number_format($data->harga) }}</h6>
                                <p class="mb-0">{{ $data->kabupaten->nama_kabupaten }}
                                    <small>{{ $data->tanggal }}</small>
                                </p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Category End -->
    @php
        $hariIni = \Carbon\Carbon::now()->format('Y-m-d');
        $kemaren = \Carbon\Carbon::now()->subDay()->format('Y-m-d');
    @endphp
    <div class="container mt-5">
        <div class="header mb-4 bg-success p-4">
            <h2 class="fw-bold text-center text-white">Perbandingan Harga Bahan Pokok</h2>
        </div>
        <div class="filters mb-4">
            <form action="{{ route('welcome') }}" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <label for="city" class="form-label">City</label>
                        <select class="form-select" name="kabupatenBanding" required>
                            <option value="">Pilih Kabupaten</option>
                            @foreach ($kabupaten as $item)
                                <option value="{{ Str::slug($item->nama_kabupaten) }}"
                                    {{ Str::slug($item->nama_kabupaten) == request('kabupatenBanding') ? 'selected' : '' }}>
                                    {{ $item->nama_kabupaten }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="date1" class="form-label">Tanggal Mulai</label>
                        <input type="date" id="date1" name="tanggal_mulai" class="form-control"
                            value="{{ $tanggalMulai ?? $kemaren }}">
                    </div>
                    <div class="col-md-3">
                        <label for="date2" class="form-label">Tanggal Selesai</label>
                        <input type="date" id="date2" name="tanggal_selesai" class="form-control"
                            value="{{ $tanggalSelesai ?? $hariIni }}">
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Search</button>
                        @auth
                            @if ($tanggalMulai && $tanggalSelesai)
                                <a href="{{ route('report.banding', ['kabupatenBanding' => request('kabupatenBanding'), 'tanggal_mulai' => $tanggalMulai, 'tanggal_selesai' => $tanggalSelesai]) }}"
                                    class="btn btn-secondary" target="_blank"> <i class="fa fa-print"></i> Print</a>
                            @endif
                        @endauth

                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">

                <thead class="bg-success text-white">
                    <tr>
                        <th>Komoditas</th>
                        <th>{{ $tanggalMulai ?? $kemaren }}</th>
                        <th>{{ $tanggalSelesai ?? $hariIni }}</th>
                        <th>Perubahan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori as $item)
                        @php
                            // Initialize variables
                            $yesterdayPrice = 0;
                            $todayPrice = 0;
                            $persen = 0;

                            $today = App\Models\DetailKategori::where('kategori_id', $item->id)
                                ->where('tanggal', $tanggalSelesai)
                                ->where('kabupaten_id', $dataKabupaten->id)
                                ->orderBy('created_at', 'desc')
                                ->first();
                            $yesterday = App\Models\DetailKategori::where('kategori_id', $item->id)
                                ->where('tanggal', $tanggalMulai)
                                ->where('kabupaten_id', $dataKabupaten->id)
                                ->orderBy('created_at', 'desc')
                                ->first();
                            $todayPrice = $today ? $today->harga : 0;
                            $yesterdayPrice = $yesterday ? $yesterday->harga : 0;

                            // Calculate percentage change if both values exist
                            if ($yesterday && $today && $yesterday->harga > 0) {
                                $persen = (($today->harga - $yesterday->harga) / $yesterday->harga) * 100;
                            }
                        @endphp
                        <tr>
                            <td>{{ $item->nama_komoditi }}</td>
                            <td>Rp.{{ number_format($yesterdayPrice, 2) }}</td>
                            <td>RP.{{ number_format($todayPrice, 2) }}</td>
                            <td class="{{ $persen >= 0 ? 'text-danger' : 'text-success' }}">
                                {{ $persen >= 0 ? '↑' : '↓' }} {{ number_format($persen) }} %</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Perbandingan Harga Bahan Pokok End -->
@endsection
