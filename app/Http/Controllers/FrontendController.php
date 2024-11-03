<?php

namespace App\Http\Controllers;

use App\Models\DetailKategori;
use App\Models\Kabupaten;
use App\Models\Kategori;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function welcome(Request $request)
    {
        $komoditi = Kategori::orderBy("nama_komoditi", "asc")->get();
        $kabupaten = Kabupaten::orderBy("nama_kabupaten", "asc")->get();

        // search 
        $string = str_replace('-', ' ', $request->input('kabupaten'));
        $kabupatenSearch = ucwords($string);
        $tanggalSearch = $request->input('tanggal');

        $detailKategori = DetailKategori::orderBy('id', 'desc')->limit(10)->get();
        if ($kabupatenSearch && $tanggalSearch) {
            $kabupaten_id = Kabupaten::where('nama_kabupaten', $kabupatenSearch)->first('id');
            $detailKategori = DetailKategori::where('kabupaten_id', $kabupaten_id->id)->where('tanggal', $tanggalSearch)->get();
        }


        // search bandingkan harga

        $string2 = str_replace('-', ' ', $request->input('kabupatenBanding'));
        $kabupatenBanding = ucwords($string2);
        $tanggalMulai = $request->input('tanggal_mulai');
        $tanggalSelesai = $request->input('tanggal_selesai');



        $kategori = [];
        $dataKabupaten = [];
        if ($kabupatenBanding && $tanggalMulai & $tanggalSelesai) {
            $dataKabupaten = Kabupaten::where('nama_kabupaten', $kabupatenBanding)->first('id');
            $kategori = Kategori::orderBy('nama_komoditi', 'asc')->get();
        }


        return view('welcome', [
            'kabupaten' => $kabupaten,
            'komoditi' => $komoditi,
            'detailKategori' => $detailKategori,
            'kategori' => $kategori,
            'tanggalMulai' => $tanggalMulai,
            'tanggalSelesai' => $tanggalSelesai,
            'dataKabupaten' => $dataKabupaten,
        ]);
    }

    public function about()
    {
        return view('about');
    }
}
