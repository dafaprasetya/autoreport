<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class SeederService extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->seedReportServices();

    }
    private function seedReportServices()
    {
        // Path ke file CSV
        $csvFile = fopen(base_path("database/python/datarapih.csv"), "r");

        // Memastikan file CSV ada
        if ($csvFile === false) {
            die("Tidak dapat membuka file CSV.");
        }

        // Mengabaikan header CSV
        $firstline = true;

        // Membaca baris dari file CSV
        while (($row = fgetcsv($csvFile)) !== false) {
            // Lewati header
            if ($firstline) {
                $firstline = false;
                continue;
            }

            // Memasukkan data ke dalam tabel divisis
            DB::table('report_services')->insert([
                'tanggal' => date('Y-m-d', strtotime($row[0])),
                'keterangan' => $row[1] ?? null,
                'user_id' => $row[2] ?? null,
                'deskripsi_pekerjaan' => $row[3] ?? null,
                'divisi_id' => $row[4] ?? null,
                'jenis_pekerjaan_id' => $row[5] ?? null,
                'lokasi_id' => $row[6] ?? null,
                'foto_before' => $row[7] ?? null,
                'foto_after' => $row[8] ?? null,
                'tanggal_selesai' => date('Y-m-d', strtotime($row[9])) ?? null,
                'status' => "Selesai",
                'lead_time' => intval($row[10]) ?? null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Menutup file CSV
        fclose($csvFile);
    }

    private function parseDate($dateString)
    {
        // Coba parsing tanggal dengan format d/m/Y
        try {
            return Carbon::createFromFormat('d/m/Y', $dateString)->format('Y-m-d');
        } catch (\Exception $e) {
            return null; // Jika parsing gagal, kembalikan null
        }
    }

    private function getUserId($teknisi)
    {
        $users = [
            "Iwan" => 1,
            "Irawan" => 2,
            "Vendor" => 3,
            "Dafa" => 4,
            "Iyus" => 5,
            "iyus Dan Fahmi" => 6,
            "iwan dan irawan" => 7,
            "Rico" => 8,
            "Fahmi" => 9,
            "fahmi" => 10,
            "Tim OB dan CS" => 11,
            "vendor" => 12
        ];

        return $users[$teknisi] ?? 1; // Jika tidak ditemukan, gunakan nilai default 1
    }

    private function getDivisiId($divisi)
    {
        $divisis = DB::table('divisis')->pluck('id', 'nama');
        return $divisis[$divisi] ?? 1; // Jika tidak ditemukan, gunakan nilai default 1
    }

    private function getJenisPekerjaanId($jenisPekerjaan)
    {
        $jenisPekerjaans = DB::table('jenis_pekerjaans')->pluck('id', 'nama');
        return $jenisPekerjaans[$jenisPekerjaan] ?? 1; // Jika tidak ditemukan, gunakan nilai default 1
    }

    private function getLokasiId($lokasi)
    {
        $lokasis = DB::table('lokasis')->pluck('id', 'nama');
        return $lokasis[$lokasi] ?? 1; // Jika tidak ditemukan, gunakan nilai default 1
    }
}
