<?php

namespace App\Http\Controllers;

use App\Models\DetailKategori;
use App\Models\Kabupaten;
use App\Models\Kategori;
use Illuminate\Http\Request;

class DetailKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($kategori_id)
    {
        $kategori = Kategori::find($kategori_id);
        $hargaTeringgi = DetailKategori::where('kategori_id', $kategori->id)->orderBy('harga', 'desc')->first();
        $hargaTerendah = DetailKategori::where('kategori_id', $kategori->id)->orderBy('harga', 'asc')->first();
        $rataRata = DetailKategori::where('kategori_id', $kategori->id)->average('harga');
        return view('detail-kategori.index', [
            'kategori' => $kategori,
            'hargaTerendah' => $hargaTerendah,
            'hargaTertinggi' => $hargaTeringgi,
            'rataRata' => $rataRata
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($kategori_id)
    {
        $kategori = Kategori::find($kategori_id);
        $kabupaten = Kabupaten::orderBy('nama_kabupaten', 'asc')->get();
        return view('detail-kategori.create', [
            'kategori' => $kategori,
            'kabupaten' => $kabupaten
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $kategori_id)
    {

        $this->validate($request, [
            "harga" => "required|numeric",
            "kabupaten_id" => "required",
            "tanggal" => "required",
        ]);

        DetailKategori::create([
            'kategori_id' => $kategori_id,
            'kabupaten_id' => $request->kabupaten_id,
            'tanggal' => $request->tanggal,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('detail.index', $kategori_id)->with('success', 'Berhasil Menambahkan Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $kabupaten = Kabupaten::orderBy('nama_kabupaten', 'asc')->get();
        $data = DetailKategori::find($id);
        return view('detail-kategori.edit', [
            'data' => $data,
            'kabupaten' => $kabupaten

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = DetailKategori::find($id);
        $this->validate($request, [
            "harga" => "required|numeric",
            "kabupaten_id" => "required",
            "tanggal" => "required",
        ]);

        $data->update([
            'kabupaten_id' => $request->kabupaten_id,
            'tanggal' => $request->tanggal,
            'harga' => $request->harga,
            'keterangan' => $request->keterangan,
        ]);
        return redirect()->route('detail.index', $data->kategori->id)->with('success', 'Berhasil Update Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DetailKategori::find($id)->delete();
        return redirect()->back()->with('success', 'Berhasil Mengapus Data');
    }
}
