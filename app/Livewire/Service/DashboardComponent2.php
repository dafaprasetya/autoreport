<?php

namespace App\Livewire\Service;

use Livewire\Component;

class DashboardComponent2 extends Component
{
    public $tanggal;
    public $waktu;
    public $waktu2;

    // Method untuk update chart saat model berubah
    public function updatedWaktu2()
    {
        dump($this->waktu2);
        $this->dispatch('setWaktu', waktu: $this->waktu, waktu2: $this->waktu2);   // Method untuk load data chart sesuai waktu2
    }

    public function render()
    {
        $data = [
            'tanggal' => $this->tanggal
        ];
        return view('livewire.service.dashboard-component2', $data);
    }
}
