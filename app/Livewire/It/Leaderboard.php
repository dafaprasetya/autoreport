<?php

namespace App\Livewire\It;

use Livewire\Component;
use App\Models\ReportHarianIt as HarianModel;

class Leaderboard extends Component
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
        return view('livewire.it.leaderboard', $data);
    }
}
