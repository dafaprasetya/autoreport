<?php

namespace App\Livewire\It;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Livewire\Component;

class ManageUser extends Component
{
    public $reports;
    public $search = '';

    public function updateCell($id, $field, $value){
        $report = User::find($id);
        if($field == 'password'){
            $report->$field = Hash::make($value);
            $report->save();
            // $field->reset;
            session()->flash('message', 'Data berhasil diupdate.');
            $this->dispatch('notifikasi', ['message' => 'Data berhasil diupdate!']);
        }else{
            $report->$field = $value;
            $report->save();
            session()->flash('message', 'Data berhasil diupdate.');
            $this->dispatch('notifikasi', ['message' => 'Data berhasil diupdate!']);
        }
    }
    public function render()
    {
        $query = User::query()->select('users.*');
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('users.name', 'LIKE', "%{$this->search}%")
                ->orWhere('users.jabatan', 'LIKE', "%{$this->search}%")
                ->orWhere('users.bagian', 'LIKE', "%{$this->search}%")
                ->orWhere('users.email', 'LIKE', "%{$this->search}%");
            });
        }
        $user = $query->get();
        $data=[
            'user' => $user,
        ];
        return view('livewire.it.manage-user', $data);
    }
}
