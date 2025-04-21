<?php

namespace App\Livewire\Service;

use App\Models\Divisi;
use App\Models\JenisPekerjaan;
use App\Models\Lokasi;
use App\Models\ReportService;
use Livewire\Component;
use App\Models\ReportHarianService as HarianModel;

class DashboardPage extends Component
{
    public $waktu;
    public $waktu2;

    // Method untuk update chart saat model berubah
    public function updatedWaktu3()
    {
        $this->loadChartData();  // Method untuk load data chart sesuai waktu2
    }

    public function render()
    {

        $data = [
            'tanggal' => $this->waktu2
        ];
        return view('livewire.service.dashboard-page', $data);
    }
}
