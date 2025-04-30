<?php

namespace App\Livewire\It;

use App\Models\Divisi;
use App\Models\WaitingList as WaitModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class WaitingList extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $reports;
    public $foto_keluhan = [];
    public $listeners = [
        'notip' => 'notip'
    ];

    public function notip() {
        session()->flash('message', 'Data berhasil ditambahkan.');
    }

    public function updateCell($id, $field, $value){
        $report = WaitModel::find($id);
        $report->$field = $value;
        $report->save();
        $this->loadReports();
        session()->flash('message', 'Data berhasil diupdate.');
        $this->dispatch('notifikasi', ['message' => 'Data berhasil diupdate!']);
    }
    public function updatedFotoKeluhan($valuue, $key){
        $this->uploadFoto($key);
    }
    public function uploadFoto($id)
    {
        $report = WaitModel::find($id);
        $this->validate([
            "foto_keluhan.$id" => 'required|image|max:5120',
        ]);
        $file = $this->foto_keluhan[$id];
        $nama_file = 'waiting_'.$id.'.'.$file->extension();
        Storage::delete('public/it/waitinglist/'.$report->foto_after);
        $file->storeAs('public/it/waitinglist/', $nama_file);
        $this->updateCell($id, 'foto_keluhan', $nama_file);

        $report->save();
    }
    public function mount()
    {
        $reports = WaitModel::all();
        foreach ($reports as $report) {
            $this->foto_keluhan[$report->id] = null;
        }
    }
    public function loadReports()
    {
        $this->reports = WaitModel::with(['dibuat_oleh'])
            ->orderBy('id', 'desc')
            ->get();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $total = WaitModel::where('kategori', 'IT')->count();

        $query = WaitModel::query()
            ->leftJoin('users', 'waiting_lists.dibuatOleh', '=', 'users.id')
            ->leftJoin('divisis', 'waiting_lists.divisi_id', '=', 'divisis.id')
            ->select('waiting_lists.*');

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('waiting_lists.keluhan', 'LIKE', "%{$this->search}%")
                ->orWhere('divisis.nama', 'LIKE', "%{$this->search}%")
                ->orWhere('waiting_lists.status', 'LIKE', "%{$this->search}%")
                ->orWhere('waiting_lists.tanggal', 'LIKE', "%{$this->search}%");
            });
        }

        $waiting = $query->orderBy('waiting_lists.id', 'desc')->where('kategori', 'IT')->paginate(10);
        $divisi = Divisi::all();
        $data = [
            'total' => $total,
            'waiting' => $waiting,
            'divisi' => $divisi,
        ];
        return view('livewire.it.waiting-list', $data);
    }
    public function deleteReport($id)
    {
        $report = WaitModel::find($id);

        if (!$report) {
            session()->flash('error', 'Data tidak ditemukan.');
            return;
        }

        if ($report->foto_before && Storage::exists('public/it/foto_before/' . $report->foto_before)) {
            Storage::delete('public/it/foto_before/' . $report->foto_before);
        }
        if ($report->foto_after && Storage::exists('public/it/foto_after/' . $report->foto_after)) {
            Storage::delete('public/it/foto_after/' . $report->foto_after);
        }

        $report->delete();

        session()->flash('success', 'Data berhasil dihapus.');
    }
}
