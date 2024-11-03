<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Komoditi</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    @include('layouts.frontend.css')

    <style>
        @media print {

            /* Hides elements that are not needed in print */
            .container {
                width: 100%;
                padding: 0;
                margin: 0;
            }

            .header {
                margin-bottom: 0;
                padding: 0;
            }

            .header img {
                width: 100px;
                /* Adjust if needed */
                height: auto;
            }

            .table-responsive {
                overflow: visible;
            }

            table {
                width: 100%;
                border-collapse: collapse;
            }

            th,
            td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }

            thead {
                background-color: #28a745;
                color: white;
            }

            /* Ensure the colors are suitable for printing */
            .text-dark {
                color: black !important;
            }

            .text-white {
                color: black !important;
            }

            /* Hide elements you don't want to be printed */
            .no-print {
                display: none;
            }

            /* Adjust margins and padding for print */
            @page {
                margin: 1in;
            }
        }
    </style>

</head>

<body>
    <div class="container mt-5">
        <div class="header mb-4 bg-success p-4">
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
        <div class="container mt-4">

            <p class="text-dark">Kota :
                {{ $dataKabupaten->nama_kabupaten . ' (' . $tanggalMulai . ' s/d ' . $tanggalSelesai . ')' }}</p>

        </div>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">

                <thead class="bg-success text-white">
                    <tr>
                        <th>Komoditas</th>
                        <th>{{ $tanggalMulai }}</th>
                        <th>{{ $tanggalSelesai }}</th>
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

    @include('layouts.frontend.js')
</body>
<script>
    window.print();
</script>

</html>
