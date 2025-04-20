<?php

namespace App\Livewire\Service;

use App\Models\Divisi;
use App\Models\Lokasi;
use App\Models\ReportService;
use Livewire\Component;
use App\Models\ReportHarianService as HarianModel;

class DashboardService extends Component
{
    public $waktu;
    public $waktu2;

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
        ];
        return view('livewire.service.dashboard-service', $data);
    }
}
