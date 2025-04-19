<?php

namespace App\Livewire;

use Livewire\Component;

class HarianPage extends Component
{
    public $tanggal = null;

    protected $listeners = ['setTanggal'];

    public function setTanggal($tanggal)
    {
        $this->tanggal = $tanggal;
    }
    public function kembali(){
        $this->tanggal = null;
        $this->dispatch('reset-calendar');
    }
    public function render()
    {
        return view('livewire.harian-page');
    }
}
