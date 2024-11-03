@extends('layouts.frontend.main')
@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ $kategori->nama_komoditi }}</h3>
                    <h6 class="op-7 mb-2">List Semua Data {{ $kategori->nama_komoditi }}</h6>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List Data</h4>
                            <div class="ms-auto d-flex">
                                <a href="{{ route('detail.create', $kategori->id) }}" class="btn btn-primary btn-round">
                                    <i class="fa fa-plus"></i> Add
                                </a>
                                <a href="{{ route('report.komoditi', $kategori->id) }}"
                                    class="btn btn-secondary btn-round ms-2" target="_blank">
                                    <i class="fa fa-print"></i> Print
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="multi-filter-select" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Komoditi</th>
                                        <th>Kabupaten</th>
                                        <th>Tanggal</th>
                                        <th>Harga (kg)</th>
                                        <th>Keterangan</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kategori->detailKategori()->orderby('created_at', 'desc')->get() as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kategori->nama_komoditi }}</td>
                                            <td>{{ $item->kabupaten->nama_kabupaten }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>Rp. {{ number_format($item->harga, 0) }}</td>
                                            <td>{{ $item->keterangan }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('detail.edit', $item->id) }}"
                                                        class="btn btn-link btn-primary btn-sm me-2">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('detail.destroy', $item->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link btn-danger btn-sm">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="container mt-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <p class="fw-bold">Harga Tertinggi:</p>
                                        <p>Rp. {{ $hargaTertinggi != null ? number_format($hargaTertinggi->harga, 2) : 0 }}
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="fw-bold">Harga Terendah:</p>
                                        <p>Rp. {{ $hargaTerendah != null ? number_format($hargaTerendah->harga, 2) : 0 }}
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <p class="fw-bold">Rata-Rata:</p>
                                        <p>Rp. {{ number_format($rataRata, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
