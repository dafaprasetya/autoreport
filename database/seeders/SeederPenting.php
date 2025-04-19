<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class SeederPenting extends Seeder
{
    public function run()
    {
        $this->seedUsers();
        $this->seedDivisi();
        $this->seedJenisPekerjaan();
        $this->seedLokasi();
    }

    private function seedUsers()
    {
        // Path ke file CSV
        $csvFile = fopen(base_path("database/python/user_seeder.csv"), "r");

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

            // Memasukkan data ke dalam tabel users
            DB::table('users')->insert([
                'nik' => $row[0],
                'jabatan' => $row[1],
                'name' => $row[2],
                'email' => $row[3],
                'password' => Hash::make($row[4]),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Menutup file CSV
        fclose($csvFile);
    }

    private function seedDivisi()
    {
        // Path ke file CSV
        $csvFile = fopen(base_path("database/python/divisi_seeder.csv"), "r");

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
            DB::table('divisis')->insert([
                'nama' => $row[0],
                'deskripsi' => $row[1] ?? null, // Menggunakan null jika tidak ada deskripsi
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Menutup file CSV
        fclose($csvFile);
    }

    private function seedJenisPekerjaan()
    {
        // Path ke file CSV
        $csvFile = fopen(base_path("database/python/jenis_pekerjaan_seeder.csv"), "r");

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
            DB::table('jenis_pekerjaans')->insert([
                'nama' => $row[0],
                'deskripsi' => $row[1] ?? null, // Menggunakan null jika tidak ada deskripsi
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Menutup file CSV
        fclose($csvFile);
    }

    private function seedLokasi()
    {
        // Path ke file CSV
        $csvFile = fopen(base_path("database/python/lokasi_seeder.csv"), "r");

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
            DB::table('lokasis')->insert([
                'nama' => $row[0],
                'deskripsi' => $row[1] ?? null, // Menggunakan null jika tidak ada deskripsi
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Menutup file CSV
        fclose($csvFile);
    }


}
