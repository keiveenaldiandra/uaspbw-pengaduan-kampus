<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        Kategori::create([
            'nama_kategori' => 'Elektronik'
        ]);

        Kategori::create([
            'nama_kategori' => 'Kebersihan'
        ]);

        Kategori::create([
            'nama_kategori' => 'Infrastruktur'
        ]);

        Kategori::create([
            'nama_kategori' => 'Internet'
        ]);
    }
}