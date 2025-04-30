<?php

namespace App\Livewire\Service;

use App\Models\Divisi;
use App\Models\JenisPekerjaan;
use App\Models\KategoriHarianNew;
use App\Models\Lokasi;
use App\Models\ReportEksekutor;
use App\Models\ReportService;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use App\Models\ReportHarianServiceNew as HarianModel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

class FormTambahReportNew extends Component
{
    use WithFileUploads;
    #[Validate('required')]
    public $agenda, $kategori_harian_id, $user_id, $detail_kerja, $tanggal, $keterangan, $divisi_id, $lokasi_id, $jenis_pekerjaan_id, $note_progres, $target_selesai;

    public $eksekutors;
    public $report_eksekutor_id;

    public $foto_before, $foto_after, $status, $tanggal_selesai;
    public $listMasterGa = [];
    public $listReportHarian = [];

    public $reportHBaru = [];
    public $reportMBaru = [];
    public $reportsharian;

    public function loadReportsHarian()
    {
        $this->reportsharian = HarianModel::with(['user', 'kategoriHarian'])->get();
    }
    public $reportsmaster;

    public function loadReportsMaster()
    {
        $this->reportsmaster = ReportService::with(['user', 'divisi', 'jenis_pekerjaan', 'lokasi'])
            ->orderBy('id', 'desc')
            ->get();
    }

    public function resetAll() {
        $this->reset([
            'agenda', 'kategori_harian_id', 'user_id', 'status', 'detail_kerja', 'tanggal', 'keterangan', 'divisi_id', 'lokasi_id', 'jenis_pekerjaan_id', 'tanggal_selesai',
            'foto_before', 'foto_after', 'note_progres', 'target_selesai'
        ]);
    }

    public function tambahMasternHarian() {
        $this->validate();
        $this->listMasterGa[] = [
            'tanggal' => $this->tanggal,
            'keterangan' => $this->keterangan,
            'user_id' => $this->user_id,
            'deskripsi_pekerjaan' => $this->detail_kerja,
            'divisi_id' => $this->divisi_id,
            'jenis_pekerjaan_id' => $this->jenis_pekerjaan_id,
            'lokasi_id' => $this->lokasi_id,
            'tanggal_selesai' => $this->tanggal_selesai ? $this->tanggal_selesai : null,
            'foto_before_url' => $this->foto_before ? $this->foto_before : null,
            'foto_after_url' => $this->foto_after ? $this->foto_after : null,
        ];

        $this->listReportHarian [] =[
            'date' => $this->tanggal,
            'agenda' => $this->agenda,
            'kategori_harian_id' => $this->kategori_harian_id,
            'user_id' => $this->user_id,
            'status' => $this->status,
            'detail_kerja' => $this->detail_kerja,
            'note_progres' => $this->note_progres,
            'tanggal_penugasan' => $this->tanggal,
            'target_selesai' => $this->target_selesai,
        ];
        $this->saves();
        if($this->eksekutors){
            $eksekutor = ReportEksekutor::find($this->report_eksekutor_id);
            $eksekutor->status = 'Sudah Ditambahkan';
            $eksekutor->save();
        }
        session()->flash('message', 'Data berhasil ditambahkan.');

    }

    public function saves() {
        foreach ($this->listMasterGa as $data) {
            $master = new ReportService();
            $master->dibuatOleh = Auth::user()->id;
            $master->tanggal = $data['tanggal'];
            $master->keterangan = $data['keterangan'];
            $master->user_id = $data['user_id'];
            $master->deskripsi_pekerjaan = $data['deskripsi_pekerjaan'];
            $master->divisi_id = $data['divisi_id'];
            $master->jenis_pekerjaan_id = $data['jenis_pekerjaan_id'];
            $master->lokasi_id = $data['lokasi_id'];
            if ($data['tanggal_selesai']) {
                $master->tanggal_selesai = $data['tanggal_selesai'];
                $tanggal_keluhan =Carbon::parse($data['tanggal']);
                $master->lead_time = $tanggal_keluhan->diffInDays($data['tanggal_selesai']);
                $master->save();
            }
            $master->save();
            if ($data['foto_before_url']) {
                // $master->foto_before = $this->foto_before->store('images');
                $foto_before = $data['foto_before_url'];
                if (is_string($data['foto_before_url'])) {
                    $ext = pathinfo($data['foto_before_url'], PATHINFO_EXTENSION);
                    Storage::copy('public/reporteksekutor/foto_before/'.$data['foto_before_url'],'public/service/foto_before/'.'before_'.$master->id.'.'.$ext);
                    Storage::copy('public/reporteksekutor/foto_before/'.$data['foto_before_url'],'public/service/foto_after/'.'after_'.$master->id.'.'.$ext);
                    $master->foto_before = 'before_'.$master->id.'.'.$ext;
                    $master->foto_after = 'after_'.$master->id.'.'.$ext;
                    $master->save();
                }else{
                    $nama_file = 'before_'.$master->id.'.'.$foto_before->extension();
                    $foto_before->storeAs('public/service/foto_before/', $nama_file);
                    $master->foto_before = $nama_file;
                    $master->save();
                }
            }
            if ($data['foto_after_url']) {
                // $master->foto_after = $this->foto_after->store('images');
                $foto_after = $data['foto_after_url'];
                if (is_string($data['foto_after_url'])) {
                    $ext = pathinfo($data['foto_after_url'], PATHINFO_EXTENSION);
                    Storage::copy('public/reporteksekutor/foto_after/'.$data['foto_after_url'],'public/service/foto_after/'.'after_'.$master->id.'.'.$ext);
                    $master->foto_after = 'after_'.$master->id.'.'.$ext;
                    $master->save();
                }else{
                    $nama_file = 'after_'.$master->id.'.'.$foto_after->extension();
                    $foto_after->storeAs('public/service/foto_after/', $nama_file);
                    $master->foto_after = $nama_file;
                    $master->save();
                }
            }

            $this->listMasterGa = [];
            $this->reportMBaru[] = $master;
            // dd($this->reportMBaru);

        }
        foreach ($this->listReportHarian as $harians) {
            $report = new HarianModel();
            $report->dibuatOleh = Auth::user()->id;
            $report->date = $harians['date'];
            $report->tanggal_penugasan = $harians['tanggal_penugasan'];
            $report->agenda = $harians['agenda'];
            // dd($this->kategori_harian_id, $this->user_id, $this->status);
            $report->user_id = $harians['user_id'];
            $report->kategori_harian_id = $harians['kategori_harian_id'];
            $report->detail_kerja = $harians['detail_kerja'];
            $report->note_progres = $harians['note_progres'];
            $report->target_selesai = $harians['target_selesai'];
            $report->status = $harians['status'];
            // dd($this->status);
            $report->save();

            $this->listReportHarian = [];
            $this->reportHBaru[] = $report;


        }

        $this->resetAll();

    }
    public function updateCell($id, $field, $value)
    {
        $report = HarianModel::find($id);
        $report->$field = $value;

        $report->save();

        $this->loadReportsHarian();
        session()->flash('message', 'Data berhasil diupdate.');
    }
    public function updateCellMaster($id, $field, $value)
    {
        $report = ReportService::find($id);
        if ($field == 'tanggal_selesai') {
            $tanggal_keluhan =Carbon::parse($report->tanggal);
            $report->tanggal_selesai = $value;
            $report->lead_time = $tanggal_keluhan->diffInDays($report->tanggal_selesai);
            $report->save();
        }
        $report->$field = $value;
        $report->save();

        $this->loadReportsMaster();
        session()->flash('message', 'Data berhasil diupdate.');
        $this->dispatch('notifikasi', ['message' => 'Data berhasil diupdate!']);
    }

    public $fotoBefore = [];
    public $fotoAfter = [];
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

            $this->updateCellMaster($id, 'foto_before', $nama_file);
            $this->fotoBefore = [];
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

            $this->updateCellMaster($id, 'foto_after', $nama_file);
            $this->fotoAfter = [];
        }

        $report->save();
    }
    public function deleteReportHarian($id, $index)
    {
        $report = HarianModel::find($id);

        $report->delete();
        unset($this->reportHBaru[$index]);
        $this->reportHBaru = array_values($this->reportHBaru);
        $this->loadReportsHarian();
        session()->flash('success', 'Data berhasil dihapus.');
    }
    public function deleteReportMaster($id, $index)
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
        unset($this->reportMBaru[$index]);
        $this->reportMBaru = array_values($this->reportMBaru);
        $this->loadReportsMaster();
        session()->flash('success', 'Data berhasil dihapus.');
    }

    public function render()
    {
        $total = ReportService::count();
        $divisi = Divisi::all();
        $jenispekerjaan = JenisPekerjaan::all();
        $lokasi = Lokasi::all();
        $user = User::where('bagian', 'Service')->get();
        $kategori_harian = KategoriHarianNew::all();


        $data = [
            'total' => $total,
            'divisi'=>$divisi,
            'jenispekerjaan'=>$jenispekerjaan,
            'lokasi'=>$lokasi,
            'user'=>$user,
            'kategori'=>$kategori_harian,
            'reportMBaru' => $this->reportMBaru,
            'reportHBaru' => $this->reportHBaru,
        ];
        return view('livewire.service.form-tambah-report-new', $data);
    }
    #[On('updateModel')]
    public function updateModel($model, $value)
    {
        $this->$model = $value;
    }

    public $search = '';
    public $results = [];

    public function updatedSearch()
    {
        $this->results = KategoriHarianNew::where('nama', 'like', "%{$this->search}%")->limit(10)->get();
    }

    public function select($id)
    {
        // Simpan pilihan user, dll.
    }
}
