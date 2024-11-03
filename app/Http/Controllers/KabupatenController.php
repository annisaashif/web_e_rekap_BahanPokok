<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Kabupaten::orderBy("nama_kabupaten","asc")->get();
        return view("kabupaten.index",[
            "data"=> $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("kabupaten.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "nama_kabupaten"=> "required|max:225|unique:kabupatens",
        ]);
        Kabupaten::create($request->all());
        return redirect()->route("kabupaten.index")->with("success","Berhasil Menambahkan Data Kabupaten");
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
        $data = Kabupaten::find($id);
        return view("kabupaten.edit",[
            "data"=> $data
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Kabupaten::find($id);
        $this->validate($request, [
            "nama_kabupaten" => "required|max:225|unique:kabupatens,nama_kabupaten," . $data->id,
        ]);
        $data->update($request->all());
        return redirect()->route("kabupaten.index")->with("success","Berhasil Update Data Kabupaten");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Kabupaten::find($id);
        $data->delete();
        return redirect()->route("kabupaten.index")->with("success","Berhasil Menghapus Data");
    }
}
