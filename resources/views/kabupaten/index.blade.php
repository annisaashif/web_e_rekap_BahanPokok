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
                        <div class="d-flex align-items-center">
                            <h4 class="card-title">List Data</h4>
                            <a href="{{ route('kabupaten.create') }}" class="btn btn-primary btn-round ms-auto">
                                <i class="fa fa-plus"></i> Add
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="add-row" class="display table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Kabupaten</th>
                                        <th style="width: 10%;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $kabupaten)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $kabupaten->nama_kabupaten }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('kabupaten.edit', $kabupaten->id) }}"
                                                        class="btn btn-link btn-primary btn-sm me-2">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('kabupaten.destroy', $kabupaten->id) }}"
                                                        method="POST">
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
