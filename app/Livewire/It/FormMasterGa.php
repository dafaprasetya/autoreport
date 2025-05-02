<?php

namespace App\Livewire\It;

use Livewire\Component;
use App\Models\Divisi;
use App\Models\JenisPekerjaan;
use App\Models\Lokasi;
use App\Models\ReportIt;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;

class FormMasterGa extends Component
{
    use WithFileUploads;

    #[Validate('required')]
    public $tanggal;
    #[Validate('required')]
    public $keterangan;

    #[Validate('required')]
    public $user_id;

    #[Validate('required')]
    public $deskripsi_pekerjaan;

    #[Validate('required')]
    public $divisi_id;

    #[Validate('required')]
    public $jenis_pekerjaan_id;

    #[Validate('required')]
    public $lokasi_id;

    #[Validate('nullable|image|max:5120')]
    public $foto_before;

    #[Validate('nullable|image|max:5120')]
    public $foto_after;

    public $tanggal_selesai;
    public $reports;

    public function save() {
        $this->validate();

        $report = new ReportIt();
        $report->dibuatOleh = Auth::user()->id;
        $report->tanggal = $this->tanggal;
        $report->keterangan = $this->keterangan;
        $report->user_id = $this->user_id;
        $report->deskripsi_pekerjaan = $this->deskripsi_pekerjaan;
        $report->divisi_id = $this->divisi_id;
        $report->jenis_pekerjaan_id = $this->jenis_pekerjaan_id;
        $report->lokasi_id = $this->lokasi_id;
        if ($this->tanggal_selesai) {
            $report->tanggal_selesai = $this->tanggal_selesai;
            $tanggal_keluhan =Carbon::parse($this->tanggal);
            $report->lead_time = $tanggal_keluhan->diffInDays($report->tanggal_selesai);
            $report->save();
        }
        $report->save();
        if ($this->foto_before) {
            $report->foto_before = $this->foto_before->store('images');
            $foto_before = $this->foto_before;
            $nama_file = 'before_'.$report->id.'.'.$foto_before->extension();
            $foto_before->storeAs('public/it/foto_before/', $nama_file);
            $report->foto_before = $nama_file;
            $report->save();
        }
        if ($this->foto_after) {
            $report->foto_after = $this->foto_after->store('images');
            $foto_after = $this->foto_after;
            $nama_file = 'after_'.$report->id.'.'.$foto_after->extension();
            $foto_after->storeAs('public/it/foto_after/', $nama_file);
            $report->foto_after = $nama_file;
            $report->save();
        }
        // $this->loadReports();
        $this->reset([
            'tanggal',
            'keterangan',
            'user_id',
            'deskripsi_pekerjaan',
            'divisi_id',
            'jenis_pekerjaan_id',
            'lokasi_id',
            'foto_before',
            'foto_after',
        ]);
        $this->dispatch("badak");
        session()->flash('message', 'Data berhasil ditambahkan.');

    }
    public function render()
    {
        $total = ReportIt::count();
        $divisi = Divisi::all();
        $jenispekerjaan = JenisPekerjaan::all();
        $lokasi = Lokasi::all();
        $user = User::where('bagian', 'IT')->get();

        $data = [
            'title' => 'Admin Dashboard',
            'total' => $total,
            'divisi' => $divisi,
            'jenispekerjaan' => $jenispekerjaan,
            'lokasi' => $lokasi,
            'user' => $user,
        ];
        return view('livewire.it.form-master-ga', $data);
    }
}
