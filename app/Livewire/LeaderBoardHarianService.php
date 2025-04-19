<?php

namespace App\Livewire;

use App\Models\ReportHarianService as HarianModel;
use Livewire\Component;

class LeaderBoardHarianService extends Component
{
    public $tanggal;
    public $waktu;

    public function render()
    {
        $poin = HarianModel::select('user_id')
                        ->selectRaw('SUM(poin) as total_poin')
                        // ->whereMonth('date', now()->month)
                        ->{$this->waktu}('date', $this->tanggal)
                        ->groupBy('user_id')
                        ->orderByDesc('total_poin')
                        ->get();

        $data = [
            'poin' => $poin,
        ];
        return view('livewire.leader-board-harian-service', $data);
    }
}
