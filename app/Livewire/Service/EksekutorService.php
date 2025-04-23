<?php

namespace App\Livewire\Service;

use App\Models\Divisi;
use App\Models\JenisPekerjaan;
use App\Models\KategoriHarian;
use App\Models\Lokasi;
use App\Models\ReportEksekutor;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EksekutorService extends Component
{
    use WithFileUploads;

    public $tanggal;
    public $search;
    public $reports;
    public $fotoBefore = [];
    public $fotoAfter = [];

    public function deleteReport($id)
    {
        $report = ReportEksekutor::find($id);
        $report->delete();

        session()->flash('success', 'Data berhasil dihapus.');
    }

    public function updatedFotoBefore($value, $key)
    {
        $this->uploadFoto($key, 'before');
    }
    public function updatedFotoAfter($valuue, $key){
        $this->uploadFoto($key, 'after');
    }
    public function uploadFoto($id, $tipe)
    {
        $report = ReportEksekutor::find($id);

        if ($tipe === 'before') {
            $this->validate([
                "fotoBefore.$id" => 'required|image|max:5120',
            ]);

            $file = $this->fotoBefore[$id];
            $nama_file = 'before_'.$id.'.'.$file->extension();
            Storage::delete('public/reporteksekutor/foto_before/'.$report->foto_before);
            $file->storeAs('public/reporteksekutor/foto_before/', $nama_file);

            $this->updateCell($id, 'foto_before', $nama_file);
            // unset($this->fotoBefore[$id]);
        }

        if ($tipe === 'after') {
            $this->validate([
                "fotoAfter.$id" => 'required|image|max:5120',
            ]);

            $file = $this->fotoAfter[$id];
            $nama_file = 'after_'.$id.'.'.$file->extension();
            Storage::delete('public/reporteksekutor/foto_after/'.$report->foto_after);
            $file->storeAs('public/reporteksekutor/foto_after/', $nama_file);

            $this->updateCell($id, 'foto_after', $nama_file);
        }

        $report->save();
    }

    public function updateCell($id, $field, $value){
        if ($value == 0) {
            session()->flash('message', 'Data Gagal diupdate.');
        }else {
            # code...
            $report = ReportEksekutor::find($id);
            $report->$field = $value;
            $report->save();
            $this->loadReports();
            session()->flash('message', 'Data berhasil diupdate.');
            $this->dispatch('notifikasi', ['message' => 'Data berhasil diupdate!']);
        }
    }

    public function loadReports()
    {
        $this->reports = ReportEksekutor::with(['user'])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function render()
    {
        $query = ReportEksekutor::query()
            ->leftJoin('users', 'report_eksekutors.user_id', '=', 'users.id')
            ->select('report_eksekutors.*');

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('users.name', 'LIKE', "%{$this->search}%")
                ->orWhere('status', 'LIKE', "%{$this->search}%")
                ->orWhere('deskripsi_pekerjaan', 'LIKE', "%{$this->search}%");
            });
        }
        // $report = HarianModel::where('date',  $this->tanggal)->get();
        $report = $query->where('tanggal',  $this->tanggal)->where('kategori', 'Service')->orderBy('id', 'desc')->get();
        $divisi = Divisi::all();
        $jenispekerjaan = JenisPekerjaan::all();
        $lokasi = Lokasi::all();
        $user = User::where('bagian', 'Service')->get();
        $kategori_harian = KategoriHarian::all();

        $data = [
            'title'=> 'Admin Report Harian Service tanggal '.$this->tanggal,
            'report' => $report,
            'user'=>$user,
            'divisi'=>$divisi,
            'jenispekerjaan'=>$jenispekerjaan,
            'kategori'=>$kategori_harian,
            'lokasi'=>$lokasi,
        ];
        return view('livewire.service.eksekutor-service', $data);
    }
}
