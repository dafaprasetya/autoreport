<?php

namespace App\Livewire;

use App\Models\Divisi;
use App\Models\JenisPekerjaan;
use App\Models\Lokasi;
use App\Models\ReportService;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ReportServiceTable extends Component
{
    use WithPagination, WithFileUploads;
    public $search = '';
    public $reports;
    public $fotoBefore = [];
    public $fotoAfter = [];

    public function updateCell($id, $field, $value){
        $report = ReportService::find($id);
        if ($field == 'tanggal_selesai') {
            $tanggal_keluhan =Carbon::parse($report->tanggal);
            $report->tanggal_selesai = $value;
            $report->lead_time = $tanggal_keluhan->diffInDays($report->tanggal_selesai);
            $report->save();
        }
        $report->$field = $value;
        $report->save();

        $this->loadReports();
        session()->flash('message', 'Data berhasil diupdate.');
        $this->dispatch('notifikasi', ['message' => 'Data berhasil diupdate!']);
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
        $report = ReportService::find($id);

        if ($tipe === 'before') {
            $this->validate([
                "fotoBefore.$id" => 'required|image|max:5120',
            ]);

            $file = $this->fotoBefore[$id];
            $nama_file = 'before_'.$id.'.'.$file->extension();
            Storage::delete('public/service/foto_before/'.$report->foto_before);
            $file->storeAs('public/service/foto_before/', $nama_file);

            $this->updateCell($id, 'foto_before', $nama_file);
            // unset($this->fotoBefore[$id]);
        }

        if ($tipe === 'after') {
            $this->validate([
                "fotoAfter.$id" => 'required|image|max:5120',
            ]);

            $file = $this->fotoAfter[$id];
            $nama_file = 'after_'.$id.'.'.$file->extension();
            Storage::delete('public/service/foto_after/'.$report->foto_after);
            $file->storeAs('public/service/foto_after/', $nama_file);

            $this->updateCell($id, 'foto_after', $nama_file);
        }

        $report->save();
    }
    public function mount()
    {
        $reports = ReportService::all();
        foreach ($reports as $report) {
            $this->fotoBefore[$report->id] = null;
        }
    }
    public function loadReports()
    {
        $this->reports = ReportService::with(['user', 'divisi', 'jenis_pekerjaan', 'lokasi'])
            ->orderBy('id', 'desc')
            ->get();
    }
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $total = ReportService::count();

        $query = ReportService::query()
            ->leftJoin('divisis', 'report_services.divisi_id', '=', 'divisis.id')
            ->leftJoin('lokasis', 'report_services.lokasi_id', '=', 'lokasis.id')
            ->leftJoin('jenis_pekerjaans', 'report_services.jenis_pekerjaan_id', '=', 'jenis_pekerjaans.id')
            ->leftJoin('users', 'report_services.user_id', '=', 'users.id')
            ->select('report_services.*');

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('report_services.keterangan', 'LIKE', "%{$this->search}%")
                ->orWhere('divisis.nama', 'LIKE', "%{$this->search}%")
                ->orWhere('lokasis.nama', 'LIKE', "%{$this->search}%")
                ->orWhere('jenis_pekerjaans.nama', 'LIKE', "%{$this->search}%")
                ->orWhere('users.name', 'LIKE', "%{$this->search}%")
                ->orWhere('report_services.deskripsi_pekerjaan', 'LIKE', "%{$this->search}%")
                ->orWhere('report_services.tanggal', 'LIKE', "%{$this->search}%");
            });
        }

        $report = $query->orderBy('report_services.id', 'desc')->paginate(20);

        $divisi = Divisi::all();
        $jenispekerjaan = JenisPekerjaan::all();
        $lokasi = Lokasi::all();
        $user = User::where('bagian', 'Service')->get();

        return view('livewire.report-service-table', [
            'title' => 'Admin Dashboard',
            'report' => $report,
            'total' => $total,
            'divisi' => $divisi,
            'jenispekerjaan' => $jenispekerjaan,
            'lokasi' => $lokasi,
            'user' => $user,
        ]);
    }

    public function deleteReport($id)
    {
        $report = ReportService::find($id);

        if (!$report) {
            session()->flash('error', 'Data tidak ditemukan.');
            return;
        }

        if ($report->foto_before && Storage::exists('public/service/foto_before/' . $report->foto_before)) {
            Storage::delete('public/service/foto_before/' . $report->foto_before);
        }
        if ($report->foto_after && Storage::exists('public/service/foto_after/' . $report->foto_after)) {
            Storage::delete('public/service/foto_after/' . $report->foto_after);
        }

        $report->delete();

        session()->flash('success', 'Data berhasil dihapus.');
    }

}
