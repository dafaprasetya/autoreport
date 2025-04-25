<?php

namespace App\Livewire\It;

use App\Models\KategoriHarian;
use Livewire\Component;
use App\Models\ReportHarianIt as HarianModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;

class FormReportHarian extends Component
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
    public $status;


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
        $report->date = $this->tanggal;
        $report->agenda = $this->agenda;
        // dd($this->kategori_harian_id, $this->user_id, $this->status);
        $report->user_id = $this->user_id;
        $report->kategori_harian_id = $this->kategori_harian_id;
        $report->detail_kerja = $this->detail_kerja;
        // dd($this->status);
        $report->save();
        if($this->status == 'Selesai'){
            $this->dispatch('updateStatusPoin', id: $report->id,field:'status', value: $this->status);
        }
        $this->loadReports();
        $this->reset(['tanggal', 'agenda', 'user_id', 'detail_kerja', 'kategori_harian_id']);
    }

    public function render()
    {
        $kategori = KategoriHarian::all();
        $user = User::where('bagian', 'IT')->get();
        $data = [
            'kategori' => $kategori,
            'userlist' => $user,
        ];
        return view('livewire.it.form-report-harian', $data);
    }
}
