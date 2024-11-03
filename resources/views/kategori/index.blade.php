@extends('layouts.frontend.main')
@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Kategori</h3>
                    <h6 class="op-7 mb-2">List Semua Data Kategori Komoditi</h6>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List Data</h4>
                            <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-round ms-auto">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th width="200px">Image</th>
                                        <th>Nama Komoditi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $komoditi)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <img src="{{ url('images/komoditi/' . $komoditi->foto) }}"
                                                    class="img-fluid rounded"
                                                    style="object-fit: cover; width: 150px; height: 100px;"
                                                    alt="{{ $komoditi->nama_komoditi }}">
                                            </td>
                                            <td>{{ $komoditi->nama_komoditi }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('kategori.edit', $komoditi->id) }}"
                                                        class="btn btn-link btn-primary btn-sm me-2" data-toggle="tooltip"
                                                        title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('kategori.destroy', $komoditi->id) }}"
                                                        method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link btn-danger btn-sm"
                                                            data-toggle="tooltip" title="Remove">
                                                            <i class="fa fa-times"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
