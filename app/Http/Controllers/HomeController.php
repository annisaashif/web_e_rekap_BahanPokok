<?php

namespace App\Http\Controllers;

use App\Models\DetailKategori;
use App\Models\Kabupaten;
use App\Models\Kategori;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return redirect()->route('welcome');
        // // Ambil data terbaru dan kategori
        // $latest = DetailKategori::latest()->limit(10)->get();
        // $kategori = Kategori::select('nama_komoditi')->orderBy('nama_komoditi', 'asc')->limit(20)->get();
        // $kategoriNames = $kategori->pluck('nama_komoditi');


        // $kabupaten  = Kabupaten::count();
        // $totalKategori = Kategori::count();

        // // Ambil data dari database dan kelompokkan berdasarkan kategori_id
        // $data = DetailKategori::with('kategori')->select('kategori_id', 'tanggal', 'harga')
        //     ->get()
        //     ->groupBy('kategori_id');

        // $datasets = [];
        // $labels = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];

        // foreach ($data as $kategoriId => $values) {
        //     $dataset = [
        //         'label' => $values->first()->kategori->nama_komoditi,  // Nama kategori
        //         'borderColor' => '#' . substr(md5(rand()), 0, 6),  // Warna acak
        //         'pointBackgroundColor' => 'rgba(0,0,0,0.6)',
        //         'pointRadius' => 0,
        //         'backgroundColor' => 'rgba(0,0,0,0.4)',
        //         'legendColor' => '#' . substr(md5(rand()), 0, 6),
        //         'fill' => true,
        //         'borderWidth' => 2,
        //         'data' => array_fill(0, 12, 0)  // Data default 0 untuk setiap bulan
        //     ];

        //     foreach ($values as $value) {
        //         // Ambil bulan dari tanggal
        //         $monthIndex = Carbon::parse($value->tanggal)->month - 1;
        //         $dataset['data'][$monthIndex] = $value->harga;  // Mengisi data dengan harga
        //     }

        //     $datasets[] = $dataset;
        // }


        // $tableKategori = Kategori::orderBy('nama_komoditi', 'asc')->get();
        // $tableKabupaten = Kabupaten::orderBy('nama_kabupaten', 'asc')->get();

        // return view('home', [
        //     'latest' => $latest,
        //     'kategori' => $kategoriNames,
        //     'datasets' => $datasets,
        //     'kabupaten' => $kabupaten,
        //     'totalKategori' => $totalKategori,
        //     'labels' => $labels,
        //     'tableKategori' => $tableKategori,
        //     'tableKabupaten' => $tableKabupaten,
        // ]);
    }

    public function reportAll()
    {
        $tableKategori = Kategori::orderBy('nama_komoditi', 'asc')->get();
        $tableKabupaten = Kabupaten::orderBy('nama_kabupaten', 'asc')->get();

        return view('printAll', [
            'tableKategori' => $tableKategori,
            'tableKabupaten' => $tableKabupaten
        ]);
    }
    public function reportKomoditi($kategori_id)
    {
        $kategori = Kategori::find($kategori_id);
        $hargaTeringgi = DetailKategori::where('kategori_id', $kategori->id)->orderBy('harga', 'desc')->first();
        $hargaTerendah = DetailKategori::where('kategori_id', $kategori->id)->orderBy('harga', 'asc')->first();
        $rataRata = DetailKategori::where('kategori_id', $kategori->id)->average('harga');
        return view('printKomoditi', [
            'kategori' => $kategori,
            'hargaTerendah' => $hargaTerendah,
            'hargaTertinggi' => $hargaTeringgi,
            'rataRata' => $rataRata
        ]);
    }


    public function reportBanding($kabupatenBanding, $tanggal_mulai, $tanggal_selesai)
    {

        // search bandingkan harga

        $string2 = str_replace('-', ' ', $kabupatenBanding);
        $kabupatenBanding = ucwords($string2);
        $tanggalMulai = $tanggal_mulai;
        $tanggalSelesai = $tanggal_selesai;
        $dataKabupaten = Kabupaten::where('nama_kabupaten', $kabupatenBanding)->first();
        $kategori = Kategori::orderBy('nama_komoditi', 'asc')->get();
        return view('printBanding', [
            'kategori' => $kategori,
            'tanggalMulai' => $tanggalMulai,
            'tanggalSelesai' => $tanggalSelesai,
            'dataKabupaten' => $dataKabupaten,
        ]);
    }
}
