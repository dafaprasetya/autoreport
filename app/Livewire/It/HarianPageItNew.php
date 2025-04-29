<?php

namespace App\Livewire\It;

use Livewire\Component;

class HarianPageItNew extends Component
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
        return view('livewire.it.harian-page-it-new');
    }
}
