<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriHarianSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $kategori = ['QC', 'Audit', 'Rutinan', 'Mesin', 'Sipil', 'Proyek Besar', 'Komplain', 'Kunjungan', 'Unknown', 'Proyek'];
        foreach ($kategori as $kategoris) {
            DB::table('kategori_harians')->insert([
                'nama' => $kategoris,
                'poin' => 2,
            ]);
        }
    }
}
