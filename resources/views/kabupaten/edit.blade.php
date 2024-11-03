@extends('layouts.frontend.main')
@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Kabupaten</h3>
                    <h6 class="op-7 mb-2">List Semua Data Kabupaten</h6>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit Kabupaten</div>
                    </div>
                    <form action="{{ route('kabupaten.update', $data->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label for="nama_kabupaten" class="form-label">Nama Kabupaten</label>
                                <input type="text" class="form-control form-control-lg" name="nama_kabupaten"
                                    id="nama_kabupaten" placeholder="Nama Kabupaten" value="{{ $data->nama_kabupaten }}">
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-success btn-sm me-2">Submit</button>
                            <a href="{{ route('kabupaten.index') }}" class="btn btn-danger btn-sm">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
