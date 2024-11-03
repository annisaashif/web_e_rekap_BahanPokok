@extends('layouts.admin.main')
@section('konten')
    <div class="container">
        <div class="page-inner">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">Dashboard</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fab fa-buromobelexperte"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Kabupaten</p>
                                        <h4 class="card-title">{{ $kabupaten }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-th-list"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Kategori </p>
                                        <h4 class="card-title">{{ $totalKategori }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row">
                            <div class="card-title">Statistik Komoditi</div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart-container" style="min-height: 375px">
                            <canvas id="statisticsChart"></canvas>
                        </div>
                        <div id="myChartLegend"></div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
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
                                            <th></th>
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
                                                    // Initialize variables
                                                    $yesterdayPrice = 0;
                                                    $todayPrice = 0;
                                                    $persen = 0;

                                                    $today = App\Models\DetailKategori::where('kategori_id', $item->id)
                                                        ->where('tanggal', $hariIni)
                                                        ->where('kabupaten_id', $kabupaten->id)
                                                        ->orderBy('created_at', 'desc')
                                                        ->first();
                                                    $yesterday = App\Models\DetailKategori::where(
                                                        'kategori_id',
                                                        $item->id,
                                                    )
                                                        ->where('tanggal', $kemaren)
                                                        ->where('kabupaten_id', $kabupaten->id)
                                                        ->orderBy('created_at', 'desc')
                                                        ->first();
                                                    $todayPrice = $today ? $today->harga : 0;
                                                    $yesterdayPrice = $yesterday ? $yesterday->harga : 0;

                                                    // Calculate percentage change if both values exist
                                                    if ($yesterday && $today && $yesterday->harga > 0) {
                                                        $persen =
                                                            (($today->harga - $yesterday->harga) / $yesterday->harga) *
                                                            100;
                                                    }
                                                @endphp
                                                <td>{{ number_format($yesterdayPrice, 2) }}</td>
                                                <td>{{ number_format($todayPrice, 2) }}</td>
                                                <td class="{{ $persen >= 0 ? 'text-danger' : 'text-success' }}">
                                                    {{ number_format($persen) }}%</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Daftar Harga Komoditi Terbaru</div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Komoditi</th>
                                        <th scope="col">Kabupaten</th>
                                        <th scope="col" class="text-end">Date & Time</th>
                                        <th scope="col" class="text-end">Harga</th>
                                        <th scope="col" class="text-end">keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($latest as $item)
                                        <tr>
                                            <th scope="row">
                                                <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                                {{ $item->kategori->nama_komoditi }}
                                            </th>
                                            <td class="text-start">{{ $item->kabupaten->nama_kabupaten }}</td>
                                            <td class="text-end">Rp. {{ $item->created_at }}</td>
                                            <td class="text-end">Rp. {{ number_format($item->harga, 2) }}</td>
                                            <td class="text-end">
                                                <span class="badge badge-success">{{ $item->keterangan }}</span>
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var ctx = document.getElementById('statisticsChart').getContext('2d');
        var statisticsChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($labels),
                datasets: @json($datasets)
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                tooltips: {
                    bodySpacing: 4,
                    mode: "nearest",
                    intersect: 0,
                    position: "nearest",
                    xPadding: 10,
                    yPadding: 10,
                    caretPadding: 10
                },
                layout: {
                    padding: {
                        left: 5,
                        right: 5,
                        top: 15,
                        bottom: 15
                    }
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            fontStyle: "500",
                            beginAtZero: false,
                            maxTicksLimit: 5,
                            padding: 10
                        },
                        gridLines: {
                            drawTicks: false,
                            display: false
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            zeroLineColor: "transparent"
                        },
                        ticks: {
                            padding: 10,
                            fontStyle: "500"
                        }
                    }]
                },
                legendCallback: function(chart) {
                    var text = [];
                    text.push('<ul class="' + chart.id + '-legend html-legend">');
                    for (var i = 0; i < chart.data.datasets.length; i++) {
                        // Gunakan borderColor untuk warna legenda
                        text.push('<li><span style="background-color:' + chart.data.datasets[i]
                            .borderColor + '"></span>');
                        if (chart.data.datasets[i].label) {
                            text.push(chart.data.datasets[i].label);
                        }
                        text.push('</li>');
                    }
                    text.push('</ul>');
                    return text.join('');
                }
            }
        });

        var myLegendContainer = document.getElementById("myChartLegend");

        // generate HTML legend
        myLegendContainer.innerHTML = statisticsChart.generateLegend();

        // bind onClick event to all LI-tags of the legend
        var legendItems = myLegendContainer.getElementsByTagName('li');
        for (var i = 0; i < legendItems.length; i += 1) {
            legendItems[i].addEventListener("click", legendClickCallback, false);
        }
    });
</script>
