<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'foto',
        'nama_komoditi',
    ];

    public function detailKategori()
    {
        return $this->hasMany(DetailKategori::class);
    }
}
