<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportHarianServiceSeeder extends Seeder
{
    public function run(): void
    {
        $csvFile = fopen(base_path("database/python/jobdesk_harian_baru.csv"), "r");

        // Cek apakah file bisa dibuka
        if ($csvFile === false) {
            die("Tidak dapat membuka file CSV.");
        }

        // Baca header
        $headers = fgetcsv($csvFile);

        while (($row = fgetcsv($csvFile)) !== false) {
            $data = array_combine($headers, $row);

            DB::table('report_harian_services')->insert([
                'date' => isset($data['date']) ? Carbon::parse($data['date'])->format('Y-m-d') : now(),
                'agenda' => $data['agenda'] ?? null,
                'kategori_harian_id' => !empty($data['kategori_harian_id']) ? $data['kategori_harian_id'] : 9,
                'user_id' => !empty($data['user_id']) ? $data['user_id'] : 13,
                'status' => $data['status'] ?? 'Belum Selesai',
                'detail_kerja' => $data['detail_kerja'] ?? null,
                'poin' => !empty($data['poin']) ? $data['poin'] : 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        fclose($csvFile);
    }
}
