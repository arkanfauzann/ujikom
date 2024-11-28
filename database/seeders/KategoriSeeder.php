<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        $kategoris = [
            ['judul' => 'Informasi'],
            ['judul' => 'Agenda'],
            ['judul' => 'Galeri'],
        ];

        foreach ($kategoris as $kategori) {
            Kategori::create($kategori);
        }
    }
} 