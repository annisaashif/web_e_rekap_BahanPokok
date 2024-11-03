<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Komoditi</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    @include('layouts.frontend.css')
    <style>
        @media print {

            /* Ensuring the table is fully visible when printed */
            .table-wrapper {
                overflow-x: auto;
                width: 100%;
            }

            /* Reducing font size for fitting more columns */
            table {
                font-size: 8px;
                border-collapse: collapse;
            }

            /* Reducing padding in table cells for more information */
            th,
            td {
                padding: 2px;
                border: 1px solid #000;
            }

            /* Landscape orientation for better fit */
            @page {
                size: landscape;
                margin: 10mm;
            }

            /* Hiding elements not needed in print */
            .no-print {
                display: none;
            }

            /* Removing unnecessary Bootstrap table effects */
            .table-striped tbody tr:nth-of-type(odd) {
                background-color: transparent !important;
            }

            .table-hover tbody tr:hover {
                background-color: transparent !important;
            }
        }

        /* Adding horizontal scroll for wide tables */
        .table-wrapper {
            overflow-x: auto;
        }

        /* Table border styling for screen display */
        th,
        td {
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-wrapper">
                        <table class="display table table-striped table-hover">
                            @php
                                $hariIni = \Carbon\Carbon::now()->format('Y-m-d');
                                $kemaren = \Carbon\Carbon::now()->subDay()->format('Y-m-d');
                            @endphp
                            <thead>
                                <tr>
                                    <th rowspan="2">#</th>
                                    <th rowspan="2">Kabupaten/Kota</th>
                                    @foreach ($tableKategori as $item)
                                        <th colspan="3" class="text-center">{{ $item->nama_komoditi }}</th>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach ($tableKategori as $item)
                                        <th>{{ $kemaren }}</th>
                                        <th>{{ $hariIni }}</th>
                                        <th>%</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tableKabupaten as $kabupaten)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $kabupaten->nama_kabupaten }}</td>
                                        @foreach ($tableKategori as $item)
                                            @php
                                                $yesterdayPrice = 0;
                                                $todayPrice = 0;
                                                $persen = 0;

                                                $today = App\Models\DetailKategori::where('kategori_id', $item->id)
                                                    ->where('tanggal', $hariIni)
                                                    ->where('kabupaten_id', $kabupaten->id)
                                                    ->orderBy('created_at', 'desc')
                                                    ->first();
                                                $yesterday = App\Models\DetailKategori::where('kategori_id', $item->id)
                                                    ->where('tanggal', $kemaren)
                                                    ->where('kabupaten_id', $kabupaten->id)
                                                    ->orderBy('created_at', 'desc')
                                                    ->first();
                                                $todayPrice = $today ? $today->harga : 0;
                                                $yesterdayPrice = $yesterday ? $yesterday->harga : 0;

                                                if ($yesterday && $today && $yesterday->harga > 0) {
                                                    $persen =
                                                        (($today->harga - $yesterday->harga) / $yesterday->harga) * 100;
                                                }
                                            @endphp
                                            <td>{{ number_format($yesterdayPrice, 2) }}</td>
                                            <td>{{ number_format($todayPrice, 2) }}</td>
                                            <td class="{{ $persen >= 0 ? 'text-danger' : 'text-success' }}">
                                                {{ number_format($persen, 2) }}%</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
