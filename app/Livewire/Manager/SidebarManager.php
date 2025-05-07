<?php

namespace App\Livewire\Manager;

use Livewire\Component;

class SidebarManager extends Component
{
    public $page;
    protected $listeners = ['setPage'];

    public function setPage($page)
    {
        $this->page = $page;
    }

    public function render()
    {
        return view('livewire.manager.sidebar-manager');
    }
}
