<?php

namespace App\Livewire\Service;

use Livewire\Component;

class HarianPageServiceNew extends Component
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
        return view('livewire.service.harian-page-service-new');
    }
}
