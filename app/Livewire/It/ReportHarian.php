<?php

namespace App\Livewire\It;

use App\Models\KategoriHarian;
use Livewire\Component;
use App\Models\ReportHarianIt as HarianModel;
use App\Models\User;
use Carbon\Carbon;

class ReportHarian extends Component
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
        if ($field == 'status') {
            $report->status = $value;
            // PROYEK
            if($report->kategoriHarian->nama == 'Proyek'){
                if($report->user->jabatan == 'Manager' or $report->user->jabatan == 'PIC' or $report->user->jabatan == 'Staff' or $report->user->jabatan == 'Eksekutor' or $report->user->jabatan == 'SPV'){
                    if($value == 'Belum Selesai'){
                        $report->poin = 2;
                        $report->save();
                    }
                    else if($value == 'Selesai'){
                        $report->poin = 3;
                        $report->save();
                    }
                }else{
                    if($value == 'Belum Selesai'){
                        $report->poin = 0;
                        $report->save();
                    }
                    else if($value == 'Selesai'){
                        $report->poin = 0;
                        $report->save();
                    }
                }
            }
            // AUDIT
            else if($report->kategoriHarian->nama == 'Audit'){
                if($report->user->jabatan == 'Manager' or $report->user->jabatan == 'SPV'){
                    if($value == 'Belum Selesai'){
                        $report->poin = 0;
                        $report->save();
                    }
                    else if($value == 'Selesai'){
                        $report->poin = 3;
                        $report->save();
                    }
                }
                else{
                    if($value == 'Belum Selesai'){
                        $report->poin = 0;
                        $report->save();
                    }
                    else if($value == 'Selesai'){
                        $report->poin = 0;
                        $report->save();
                    }
                }
            }
            // QC
            else if($report->kategoriHarian->nama == 'QC'){
                if($report->user->jabatan == 'Manager'){
                    if($value == 'Belum Selesai'){
                        $report->poin = 0;
                        $report->save();
                    }
                    else if($value == 'Selesai'){
                        $report->poin = 1;
                        $report->save();
                    }
                }else if($report->user->jabatan == 'SPV' or $report->user->jabatan == 'Staff' or $report->user->jabatan == 'PIC'){
                    if($value == 'Belum Selesai'){
                        $report->poin = 0;
                        $report->save();
                    }
                    else if($value == 'Selesai'){
                        $report->poin = 2;
                        $report->save();
                    }
                }
                else{
                    if($value == 'Belum Selesai'){
                        $report->poin = 0;
                        $report->save();
                    }
                    else if($value == 'Selesai'){
                        $report->poin = 0;
                        $report->save();
                    }
                }
            }
            // RUTINAN
            else if($report->kategoriHarian->nama == 'Rutinan'){
                if($report->user->jabatan == 'Manager' or $report->user->jabatan == 'SPV' or $report->user->jabatan == 'PIC'){
                    if($value == 'Belum Selesai'){
                        $report->poin = 0;
                        $report->save();
                    }
                    else if($value == 'Selesai'){
                        $report->poin = 1;
                        $report->save();
                    }
                }
                else{
                    if($value == 'Belum Selesai'){
                        $report->poin = 0;
                        $report->save();
                    }
                    else if($value == 'Selesai'){
                        $report->poin = 2;
                        $report->save();
                    }
                }
            }
            else{
                if($value == 'Belum Selesai'){
                    $report->poin = 0;
                    $report->save();
                }
                else if($value == 'Selesai'){
                    $report->poin = 2;
                    $report->save();
                }
            }

        }
        $report->$field = $value;

        $report->save();

        $this->loadReports();
        session()->flash('message', 'Data berhasil diupdate.');
        // $this->dispatch('notifikasi', ['message' => 'Data berhasil diupdate!']);
    }

    public function render()
    {
        $query = HarianModel::query()
            ->leftJoin('kategori_harians', 'report_harian_its.kategori_harian_id', '=', 'kategori_harians.id')
            ->leftJoin('users', 'report_harian_its.user_id', '=', 'users.id')
            ->select('report_harian_its.*');

        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('agenda', 'LIKE', "%{$this->search}%")
                ->orWhere('kategori_harians.nama', 'LIKE', "%{$this->search}%")
                ->orWhere('users.name', 'LIKE', "%{$this->search}%")
                ->orWhere('status', 'LIKE', "%{$this->search}%")
                ->orWhere('detail_kerja', 'LIKE', "%{$this->search}%");
            });
        }
        // $report = HarianModel::where('date',  $this->tanggal)->get();
        $report = $query->where('date',  $this->tanggal)->orderBy('id', 'desc')->get();
        $user = User::all();
        $kategori = KategoriHarian::all();

        $data = [
            'title'=> 'Admin Report Harian IT tanggal '.$this->tanggal,
            'report' => $report,
            'user'=>$user,
            'kategori'=>$kategori,
        ];
        return view('livewire.it.report-harian', $data);
    }
}
