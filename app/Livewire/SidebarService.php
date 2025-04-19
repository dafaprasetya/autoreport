<?php

namespace App\Livewire;

use Livewire\Component;

class SidebarService extends Component
{
    public function pindahUrl($url)
    {
        // Kirim browser event ke frontend
        $this->dispatch('ubah-url', url: $url);
    }
    public function render()
    {
        return view('livewire.sidebar-service');
    }
}
