<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriHarianNew extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = ['Proyek', 'Insidentil', 'Rutinan'];
        foreach ($kategori as $kategoris) {
            DB::table('kategori_harian_news')->insert([
                'nama' => $kategoris,
            ]);
        }
    }
}
