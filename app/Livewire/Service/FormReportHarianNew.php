<?php

namespace App\Livewire\Service;

use App\Models\KategoriHarianNew;
use App\Models\User;
use Livewire\Attributes\Validate;
use App\Models\ReportHarianServiceNew as HarianModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class FormReportHarianNew extends Component
{
    public $tanggal;
    #[Validate('required')]
    public $agenda;

    #[Validate('required')]
    public $user_id;

    #[Validate('required')]
    public $detail_kerja;

    #[Validate('required')]
    public $kategori_harian_id;

    #[Validate('required')]
    public $status, $note_progres, $tanggal_penugasan, $target_selesai;


    public $poin;
    public $reports;


    public function loadReports()
    {
        $this->reports = HarianModel::where('date',  $this->tanggal)->with(['user', 'kategoriHarian'])->get();
    }

    public function postForm() {
        $this->validate();
        $report = new HarianModel();
        $report->dibuatOleh = Auth::user()->id;
        $report->date = Carbon::parse(now());
        $report->agenda = $this->agenda;
        // dd($this->kategori_harian_id, $this->user_id, $this->status);
        $report->user_id = $this->user_id;
        $report->kategori_harian_id = $this->kategori_harian_id;
        $report->detail_kerja = $this->detail_kerja;
        $report->tanggal_penugasan = $this->tanggal_penugasan;
        $report->target_selesai = $this->target_selesai;
        $report->note_progres = $this->note_progres;
        $report->status = $this->status;
        // dd($this->status);
        $report->save();
        $this->loadReports();
        $this->reset(['tanggal', 'agenda', 'user_id', 'detail_kerja', 'kategori_harian_id', 'note_progres', 'tanggal_penugasan', 'target_selesai']);
    }

    public function render()
    {
        $kategori = KategoriHarianNew::all();
        $user = User::where('bagian', 'Service')->get();
        $data = [
            'kategori' => $kategori,
            'userlist' => $user,
        ];
        return view('livewire.service.form-report-harian-new',$data);
    }
}
