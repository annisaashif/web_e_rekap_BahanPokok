<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kabupaten;
use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // Membuat user dengan data spesifik
        User::create([
            'name' => 'superadmin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('admin123'),
        ]);


        //Membuat data kabupaten
        $kabupaten = [
            'Kabupaten Agam',
            'Kabupaten Damasraya',
            'Kabupaten Kepulauan Mentawai',
            'Kabupaten Lima Puluh Kota',
            'Kabupaten Padang Pariaman',
            'Kabupaten Pasanan',
            'Kabupaten Pasaman Barat',
            'Kabupaten Pesisir Selatan',
            'Kabupaten Sijunjung',
            'Kabupaten Solok',
            'Kabupaten Solok Selatan',
            'Kabupaten Tanah Datar',
            'Kota Bukittinggi',
            'Kota Padang',
            'Kota Padang Panjang',
            'Kota Pariaman',
            'Kota Payakumbuh',
            'Kota Sawahlunto',
            'Kota Solok',
        ];
        foreach ($kabupaten as $key => $value) {
            Kabupaten::create([
                'nama_kabupaten' => $value,
            ]);
        }


        // // membuat data untuk komoditi
        // $komoditi = [
        //     'Bawang Merah (KG)',
        //     'Bawang Putih (KG)',
        //     'Cabe Merah Keriting (KG)',
        //     'Cabe Rawit Hijau (KG)',
        //     'Daging Sapi (Paha Belakang) (KG)',
        //     'Daging Ayam Boiler (KG)',
        //     'Minyak Goreng Kemasan (Liter)',
        //     'Telur Ayam Ras (KG)',
        //     'Gula Pasir (KG)',
        //     'Tepung Terigu (KG)',
        //     'Beras Medium (KG)',
        //     'Beras Premium (KG)',                        
        // ];
        // foreach ($komoditi as $key => $item) {
        //     Kategori::create([
        //         'nama_komoditi'=> $item,
        //     ]);
        // }




    }
}
