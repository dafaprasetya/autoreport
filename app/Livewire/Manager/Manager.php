<?php

namespace App\Livewire\Manager;

use Carbon\Carbon;
use Livewire\Component;

class Manager extends Component
{
    public $page;
    public $waktu = "whereMonth";
    public $tanggal;

    public $waktu2;
    protected $listeners = ['setPage', 'setWaktu'];

    public function loadJS(){
        $this->dispatch("loadJS");
    }

    public function setWaktu($waktu)
    {
        $this->waktu2 = Carbon::parse($waktu);
        // $this->waktu2 = $waktu;
    }
    public function setPage($page)
    {
        $this->page = $page;
    }


    public function render()
    {
        return view('livewire.manager.manager');
    }
}
