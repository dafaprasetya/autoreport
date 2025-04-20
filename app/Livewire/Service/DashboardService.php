<?php

namespace App\Livewire\Service;

use App\Models\Divisi;
use App\Models\JenisPekerjaan;
use App\Models\Lokasi;
use App\Models\ReportService;
use Livewire\Component;
use App\Models\ReportHarianService as HarianModel;

class DashboardService extends Component
{
    public $waktu;
    public $waktu2;

    public $hexPekerjaan = [];
    public function getRandomHex($data) {
        $hexData = [];  // Membuat array kosong untuk menampung data divisi;
        $count = 0;
        foreach ($data as $item) {
            $warna = str_replace([" ", "&"], ["_", "dan"], $item->nama);
            $count++;
            // Menambahkan warna hex acak
            $warna_hex = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $this->hexPekerjaan[] = $warna_hex;
        }
    }

    public function boot() {
        $jenis_pekerjaan = JenisPekerjaan::withCount(['reportservice as jumlah' => function ($query) {
            $query->{$this->waktu}('tanggal', $this->waktu2);
        }])->having('jumlah', '>', 0)
        ->get();
        $this->getRandomHex($jenis_pekerjaan);
    }

    public function render()
    {
        $belumselesai = ReportService::{$this->waktu}('tanggal', $this->waktu2)->whereNull('tanggal_selesai')->count();
        $selesai = ReportService::{$this->waktu}('tanggal', $this->waktu2)->whereNotNull('tanggal_selesai')->count();
        $totalkerjaan = ReportService::{$this->waktu}('tanggal', $this->waktu2)->count();
        $lokasi = Lokasi::withCount(['reportservice as jumlah' => function ($query) {
            $query->{$this->waktu}('tanggal', $this->waktu2);
        }])->having('jumlah', '>', 0)->get();
        $divisi = Divisi::withCount(['reportservice as jumlah' => function ($query) {
            $query->{$this->waktu}('tanggal', $this->waktu2);
        }])->having('jumlah', '>', 0)
        ->get();
        $jenis_pekerjaan = JenisPekerjaan::withCount(['reportservice as jumlah' => function ($query) {
            $query->{$this->waktu}('tanggal', $this->waktu2);
        }])->having('jumlah', '>', 0)
        ->get();
        $internal = ReportService::where('keterangan', 'Internal')->{$this->waktu}('tanggal', $this->waktu2)->count();
        $eksternal = ReportService::where('keterangan', 'External')->{$this->waktu}('tanggal', $this->waktu2)->count();
        $leaderboard = HarianModel::select('user_id')
                        ->selectRaw('SUM(poin) as total_poin')
                        // ->whereMonth('date', now()->month)
                        ->{$this->waktu}('date', $this->waktu2)
                        ->groupBy('user_id')
                        ->orderByDesc('total_poin')
                        ->paginate(5);

        $data = [
            'selesai' => $selesai,
            'belumselesai' => $belumselesai,
            'totalkerjaan' => $totalkerjaan,
            'leaderboard' => $leaderboard,
            'lokasi' => $lokasi,
            'internal' => $internal,
            'eksternal' => $eksternal,
            'tanggal' => $this->waktu2,
            'divisi' => $divisi,
            'jenis_pekerjaan' => $jenis_pekerjaan,
            'warnaPekerjaan' => $this->hexPekerjaan,
        ];
        return view('livewire.service.dashboard-service', $data);
    }
}
