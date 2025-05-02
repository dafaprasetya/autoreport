<?php

namespace App\Livewire\It;

use Livewire\Component;

class EksekutorPage extends Component
{
    public $tanggal = null;

    protected $listeners = ['setTanggal', "jsload"];

    public function setTanggal($tanggal)
    {
        $this->tanggal = $tanggal;
        $this->dispatch('loadtom');
    }
    public function jsload()
    {
        // dd("gay");
        $this->dispatch('jsload');
    }
    public function kembali(){
        $this->tanggal = null;
        $this->dispatch('reset-calendar');
    }
    public function render()
    {
        return view('livewire.it.eksekutor-page');
    }
}
