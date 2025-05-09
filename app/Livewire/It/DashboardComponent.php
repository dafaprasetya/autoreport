<?php

namespace App\Livewire\It;

use App\Models\Divisi;
use App\Models\JenisPekerjaan;
use App\Models\KategoriHarianNew;
use App\Models\Lokasi;
use App\Models\ReportIt;
use Livewire\Component;
use App\Models\ReportHarianIt as HarianModel;
use App\Models\WaitingList;
use Carbon\Carbon;


class DashboardComponent extends Component
{
    public $waktu;
    public $waktu2;

    protected $listeners = ['setWaktu'];

    public function setWaktu($waktu)
    {
        $this->waktu2 = Carbon::parse($waktu);
        $this->dispatch("contol");
    }

    public function getRandomHex($data) {
        $hexData = [];
        $count = 0;
        foreach ($data as $item) {
            $warna = str_replace([" ", "&"], ["_", "dan"], $item->nama);
            $count++;
            // Menambahkan warna hex acak
            $warna_hex = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $hexData[] = $warna_hex;
        }
        return $hexData;
    }

    // Method untuk update chart saat model berubah
    public function updatedWaktu2($value)
    {
        $this->loadChartData();  // Method untuk load data chart sesuai waktu2
    }

    // Method untuk mengambil data chart berdasarkan waktu2
    public function loadChartData()
    {

        // Emit event untuk memberi tahu JS tentang data baru
        $this->dispatch('updateWaktu2');
    }

    public function render()
    {
        $belumselesai = ReportIt::{$this->waktu}('tanggal', $this->waktu2)->whereNull('tanggal_selesai')->count();
        $selesai = ReportIt::{$this->waktu}('tanggal', $this->waktu2)->whereNotNull('tanggal_selesai')->count();
        $totalkerjaan = ReportIt::{$this->waktu}('tanggal', $this->waktu2)->count();
        $lokasi = Lokasi::withCount(['Reportit as jumlah' => function ($query) {
            $query->{$this->waktu}('tanggal', $this->waktu2);
        }])->having('jumlah', '>', 0)->get();
        $divisi = Divisi::withCount(['Reportit as jumlah' => function ($query) {
            $query->{$this->waktu}('tanggal', $this->waktu2);
        }])->having('jumlah', '>', 0) ->get();

        $katharian = KategoriHarianNew::withCount(['reportHarianIt as jumlah' => function ($query) {
            $query->{$this->waktu}('date', $this->waktu2);
        }])->having('jumlah', '>', 0)->get();

        $jenis_pekerjaan = JenisPekerjaan::withCount(['Reportit as jumlah' => function ($query) {
            $query->{$this->waktu}('tanggal', $this->waktu2);
        }])->having('jumlah', '>', 0)->get();
        $internal = ReportIt::where('keterangan', 'Internal')->{$this->waktu}('tanggal', $this->waktu2)->count();
        $eksternal = ReportIt::where('keterangan', 'External')->{$this->waktu}('tanggal', $this->waktu2)->count();
        $leaderboard = HarianModel::select('user_id')
                        ->selectRaw('SUM(poin) as total_poin')
                        // ->whereMonth('date', now()->month)
                        ->{$this->waktu}('date', $this->waktu2)
                        ->groupBy('user_id')
                        ->orderByDesc('total_poin')
                        ->paginate(5);
        $waiting = WaitingList::{$this->waktu}('tanggal', $this->waktu2)->where('kategori', 'IT')->where('status', 'Belum Selesai')->count();

        $data = [
            'selesai' => $selesai,
            'belumselesai' => $belumselesai,
            'totalkerjaan' => $totalkerjaan,
            'leaderboard' => $leaderboard,
            'waiting' => $waiting,
            'lokasi' => $lokasi,
            'internal' => $internal,
            'eksternal' => $eksternal,
            'tanggal' => $this->waktu2,
            'divisi' => $divisi,
            'katharian' => $katharian,
            'jenis_pekerjaan' => $jenis_pekerjaan,
            'warnaPekerjaan' => $this->getRandomHex($jenis_pekerjaan),
            'warnaKat' => $this->getRandomHex($katharian),
        ];
        return view('livewire.it.dashboard-component', $data);
    }
}
