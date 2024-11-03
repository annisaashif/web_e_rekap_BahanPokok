@extends('layouts.frontend.main')

@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Edit Harga {{ $data->kategori->nama_komoditi }}</h3>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Harga</h4>
                            </div>
                            <form action="{{ route('detail.update', $data->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group mb-3">
                                        <label for="komoditiName">Nama Komoditi</label>
                                        <input type="text" class="form-control form-control-lg" id="komoditiName"
                                            value="{{ $data->kategori->nama_komoditi }}" readonly />
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="kabupatenSelect">Pilih Kabupaten</label>
                                        <select class="form-select" id="kabupatenSelect" name="kabupaten_id" required>
                                            <option value="">Pilih Kabupaten</option>
                                            @foreach ($kabupaten as $item)
                                                <option value="{{ $item->id }}"
                                                    {{ $item->id == $data->kabupaten_id ? 'selected' : '' }}>
                                                    {{ $item->nama_kabupaten }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="tanggalInput">Tanggal</label>
                                        <input type="date" class="form-control form-control-lg" name="tanggal"
                                            id="tanggalInput" value="{{ $data->tanggal }}" required />
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="hargaInput">Harga</label>
                                        <input type="number" class="form-control form-control-lg" min="1"
                                            name="harga" id="hargaInput" placeholder="Rp." value="{{ $data->harga }}"
                                            required />
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="keteranganTextarea">Keterangan <small
                                                class="text-muted">*optional</small></label>
                                        <textarea class="form-control" id="keteranganTextarea" name="keterangan" placeholder="Keterangan" rows="5">{{ $data->keterangan }}</textarea>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{ route('detail.index', $data->kategori->id) }}"
                                        class="btn btn-danger ms-2">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
