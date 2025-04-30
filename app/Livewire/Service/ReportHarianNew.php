<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\KategoriHarianNew;
use App\Models\ReportHarianServiceNew as HarianModel;
use App\Models\User;

class ReportHarianNew extends Component
{
    protected $listeners = [
        'updateStatusPoin' => 'updateCell'
    ];
    public $tanggal;
    public $search;
    public $reports;
    public function loadReports()
    {
        $this->reports = HarianModel::where('date',  $this->tanggal)->with(['user', 'kategoriHarian'])->get();
    }

    public function deleteReport($id)
    {
        $report = HarianModel::find($id);

        $report->delete();

        session()->flash('success', 'Data berhasil dihapus.');
    }

    public function updateCell($id, $field, $value){
        $report = HarianModel::find($id);
        $report->$field = $value;

        $report->save();

        $this->loadReports();
        session()->flash('message', 'Data berhasil diupdate.');
        // $this->dispatch('notifikasi', ['message' => 'Data berhasil diupdate!']);
    }
    public function render()
    {
        $query = HarianModel::query()
            ->leftJoin('kategori_harian_news', 'report_harian_service_news.kategori_harian_id', '=', 'kategori_harian_news.id')
            ->leftJoin('users', 'report_harian_service_news.user_id', '=', 'users.id')
            ->select('report_harian_service_news.*');

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('agenda', 'LIKE', "%{$this->search}%")
                ->orWhere('kategori_harian_news.nama', 'LIKE', "%{$this->search}%")
                ->orWhere('users.name', 'LIKE', "%{$this->search}%")
                ->orWhere('status', 'LIKE', "%{$this->search}%")
                ->orWhere('tanggal_penugasan', 'LIKE', "%{$this->search}%")
                ->orWhere('target_selesai', 'LIKE', "%{$this->search}%")
                ->orWhere('detail_kerja', 'LIKE', "%{$this->search}%");
            });
        }
        // $report = HarianModel::where('date',  $this->tanggal)->get();
        $report = $query->where('date',  $this->tanggal)->orderBy('id', 'desc')->get();
        $user = User::where('bagian', 'Service')->get();
        $kategori = KategoriHarianNew::all();

        $data = [
            'title'=> 'Admin Report Harian Service tanggal '.$this->tanggal,
            'report' => $report,
            'user'=>$user,
            'kategori'=>$kategori,
        ];
        return view('livewire.service.report-harian-new', $data);
    }
}
