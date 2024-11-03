<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KategoriController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kategori::orderBy("nama_komoditi", "asc")->get();
        return view("kategori.index", [
            "data" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("kategori.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'foto'     => 'required|image|mimes:jpeg,png,jpg|max:2048',
            "nama_komoditi" => "required|max:225|unique:kategoris",
        ]);

        //menerima data dari form input
        $foto = $request->file('foto');
        $foto->storeAs('/images/komoditi/', $foto->hashName());

        // simpan semua inputan form ke dalam array
        $data = [
            'foto'     => $foto->hashName(),
            'nama_komoditi' => $request->nama_komoditi,
        ];
        Kategori::create($data);
        return redirect()->route("kategori.index")->with("success", "Berhasil Menambahkan Data ");
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
        $data = Kategori::find($id);
        return view("kategori.edit", [
            "data" => $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Kategori::find($id);
        $this->validate($request, [
            "nama_komoditi" => "required|max:225|unique:kategoris,nama_komoditi," . $data->id,
        ]);


        //menerima data dari form input
        $foto = $request->file('foto');

        if ($foto) {

            //Hapus Gambar Lama yang ada di folder
            Storage::exists('/images/komoditi/' . $data->foto);
            Storage::delete('/images/komoditi/' . $data->foto);

            $foto->storeAs('/images/komoditi/', $foto->hashName());

            $dataInput = [
                'foto'     => $foto->hashName(),
                'nama_komoditi' => $request->nama_komoditi,
            ];
        } else {
            $dataInput = [
                'nama_komoditi' => $request->nama_komoditi,
            ];
        }


        // simpan semua inputan form ke dalam array

        $data->update($dataInput);
        return redirect()->route("kategori.index")->with("success", "Berhasil Update Data ");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Kategori::find($id);
        //Hapus Gambar Lama yang ada di folder
        Storage::exists('/images/komoditi/' . $data->foto);
        Storage::delete('/images/komoditi/' . $data->foto);

        $data->delete();
        return redirect()->route("kategori.index")->with("success", "Berhasil Menghapus Data");
    }
}
