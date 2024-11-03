<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Komoditi</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    @include('layouts.frontend.css')
</head>

<body>
    <div class="wrapper">
        <div class="container header mb-4 bg-success p-4">
            <div class="row  align-items-center">
                <div class="col-md-12 d-flex align-items-center">
                    <img src="{{ asset('frontend') }}/img/logoSumbar.png" style="width:100px; height:auto;"
                        alt="">
                    <div class="ms-5 text-white">
                        <h2 class="fw-bold text-white">Dinas Perindustrian dan Perdagangan Provinsi Sumatera Barat</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Komoditi</th>
                                <th>Kabupaten</th>
                                <th>Tanggal</th>
                                <th>Harga (kg)</th>
                                <th>Keterangan</th>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="container mt-2 fw-bold">
                        <p>Harga Tertinggi :
                            Rp. {{ $hargaTertinggi != null ? number_format($hargaTertinggi->harga, 2) : 0 }}</p>
                        <p>Harga Terendah :
                            Rp. {{ $hargaTerendah != null ? number_format($hargaTerendah->harga, 2) : 0 }}</p>
                        <p>Rata-Rata : Rp. {{ number_format($rataRata, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.admin.js')
</body>
<script>
    window.print();
</script>

</html>
