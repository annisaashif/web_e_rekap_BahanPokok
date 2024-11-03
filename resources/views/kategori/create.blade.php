@extends('layouts.frontend.main')
@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Kategori</h3>
                    <h6 class="op-7 mb-2">List Semua Data Komoditi</h6>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Tambah Kategori</div>
                            </div>
                            <form action="{{ route('kategori.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="foto" class="form-label">Upload Foto</label>
                                        <input type="file" class="form-control form-control-lg" name="foto"
                                            id="foto">
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="nama_komoditi" class="form-label">Nama Kategori</label>
                                        <input type="text" class="form-control form-control-lg" name="nama_komoditi"
                                            id="nama_komoditi" placeholder="Nama Kategori"
                                            value="{{ old('nama_komoditi') }}">
                                    </div>
                                </div>

                                <div class="card-footer d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success btn-sm me-2">Submit</button>
                                    <a href="{{ route('kategori.index') }}" class="btn btn-danger btn-sm">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
