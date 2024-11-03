<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKategori extends Model
{
    use HasFactory;
    protected $fillable = [
        "kategori_id",
        "kabupaten_id",
        "harga",
        "tanggal",
        "keterangan",
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function kabupaten()
    {
        return $this->belongsTo(Kabupaten::class);
    }
}
