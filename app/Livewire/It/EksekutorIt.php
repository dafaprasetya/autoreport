<?php

namespace App\Livewire\It;

use App\Models\Divisi;
use App\Models\JenisPekerjaan;
use App\Models\KategoriHarian;
use App\Models\KategoriHarianNew;
use App\Models\Lokasi;
use App\Models\ReportEksekutor;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EksekutorIt extends Component
{
    use WithFileUploads;

    public $tanggal;
    public $search;
    public $reports;
    public $fotoBefore = [];
    public $fotoAfter = [];
    public $modalTambah = false;
    public $modalId = null;
    public $selectedReport = null;
    public $selectedDivisi; // Properti untuk menyimpan divisi yang dipilih

public function mount()
{
    // Inisialisasi nilai divisi saat komponen dimuat
    $this->selectedDivisi = $this->reports->divisi_id ?? 0;
}

    function closeModalTambah() {
        $this->modalTambah = false;
        $this->selectedReport = null;
    }
    function tambahreport($data) {
        $report = ReportEksekutor::find($data);
        $requiredFields = [
            $report->deskripsi_pekerjaan,
            $report->kategori_harian_id,
            $report->tanggal,
            $report->user_id,
            $report->divisi_id,
            $report->jenis_pekerjaan_id,
            $report->lokasi_id,
        ];
        if(collect($requiredFields)->every(fn($field) => !is_null($field) && $field !== '')){
            $this->modalTambah = true;
            $this->selectedReport = $report;
            // $this->dispatchBrowserEvent('show-tambah-report-modal');
        }else {
            session()->flash('success', 'gagal coeg');
        }
    }
    public function deleteReport($id)
    {
        $report = ReportEksekutor::find($id);
        $report->delete();
        $this->loadReports();
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
            // $this->dispatch('jsload');

        }else {
            # code...
            $report = ReportEksekutor::find($id);
            $report->$field = $value;
            $report->save();
            $this->loadReports();
            session()->flash('message', 'Data berhasil diupdate.');
            $this->dispatch('notifikasi', ['message' => 'Data berhasil diupdate!']);
            $this->selectedDivisi = $value;
            // $this->dispatch('jsload');

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
        $report = $query->where('tanggal',  $this->tanggal)->where('kategori', 'IT')->orderBy('id', 'desc')->get();
        $divisi = Divisi::all();
        $jenispekerjaan = JenisPekerjaan::all();
        $lokasi = Lokasi::all();
        $user = User::where('bagian', 'IT')->get();
        $kategori_harian = KategoriHarianNew::all();

        $data = [
            'title'=> 'Admin Report Harian IT tanggal '.$this->tanggal,
            'report' => $report,
            'user'=>$user,
            'divisi'=>$divisi,
            'jenispekerjaan'=>$jenispekerjaan,
            'kategori'=>$kategori_harian,
            'lokasi'=>$lokasi,
        ];
        return view('livewire.it.eksekutor-it', $data);
    }
}
