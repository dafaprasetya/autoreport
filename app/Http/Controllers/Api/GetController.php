<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Divisi;
use App\Models\Lokasi;
use Illuminate\Http\Request;

class GetController extends Controller
{
    public function getLokasi() {
        $lokasiList = [];
        $lokasi = Lokasi::all();
        foreach ($lokasi as $lokasis) {
            $loasiList[] = $lokasis->id;
        }
        return response()->json([
            $lokasi,
        ]);
    }
    public function getDivisi() {
        $divisi = Divisi::all();
        return response()->json([
            $divisi,
        ]);
    }
    public function getKategori() {
        $kategori = Divisi::all();
        return response()->json([
            $kategori,
        ]);
    }
}
