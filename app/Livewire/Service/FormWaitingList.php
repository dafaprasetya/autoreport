<?php

namespace App\Livewire\Service;

use App\Models\Divisi;
use App\Models\WaitingList;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class FormWaitingList extends Component
{
    use WithFileUploads;
    #[Validate('required')]
    public $tanggal, $keluhan, $status, $divisi_id;



    public $foto_keluhans;

    function save() {
        $this->validate();
        $wait = new WaitingList();
        $wait->tanggal = $this->tanggal;
        $wait->keluhan = $this->keluhan;
        $wait->divisi_id = $this->divisi_id;
        $wait->status = $this->status;
        $wait->kategori = 'Service';
        $wait->dibuatOleh = Auth::user()->id;
        $wait->save();
        if ($this->foto_keluhans) {
            $wait->foto_keluhan = $this->foto_keluhans->store('images');
            $foto_keluhans = $this->foto_keluhans;
            $nama_file = 'before_'.$wait->id.'.'.$foto_keluhans->extension();
            $foto_keluhans->storeAs('public/service/waitinglist/', $nama_file);
            $wait->foto_keluhan = $nama_file;
            $wait->save();
        }
        $this->dispatch('notip');
        $this->reset(['tanggal', 'keluhan', 'status', 'divisi_id', 'foto_keluhans']);
    }


    public function render()
    {
        $divisi = Divisi::all();
        $data = [
            'divisi' => $divisi
        ];
        return view('livewire.service.form-waiting-list', $data);
    }
}
