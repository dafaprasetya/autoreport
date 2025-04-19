<?php

namespace App\Livewire;

use App\Models\Divisi;
use App\Models\JenisPekerjaan;
use App\Models\Lokasi;
use App\Models\ReportService;
use App\Models\User;
use Livewire\Component;

class MasterGaServicePage extends Component
{
    public function render()
    {
        $report = ReportService::orderBy('created_at', 'desc')->get();
        $divisi = Divisi::all();
        $jenispekerjaan = JenisPekerjaan::all();
        $lokasi = Lokasi::all();
        $user = User::where('bagian', 'Service')->get();
        $data = [
            'title' => 'Admin Master GA Service',
            'report'=>$report,
            'divisi'=>$divisi,
            'jenispekerjaan'=>$jenispekerjaan,
            'lokasi'=>$lokasi,
            'user'=>$user,
        ];
        return view('admin.service.index', $data);
    }
}
