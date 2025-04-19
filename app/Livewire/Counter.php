<?php

namespace App\Livewire;

use App\Models\Divisi;
use App\Models\JenisPekerjaan;
use App\Models\Lokasi;
use App\Models\ReportService;
use App\Models\User;
use Livewire\Component;


class Counter extends Component
{
    public $count = 1;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }
    public function render()
    {
        $report = ReportService::orderBy('created_at', 'desc')->paginate(10);
        $divisi = Divisi::all();
        $jenispekerjaan = JenisPekerjaan::all();
        $lokasi = Lokasi::all();
        $user = User::where('bagian', 'Service')->get();
        // $report = ReportService::all();
        $data = [
            'title' => 'Admin Dashboard',
            'report'=>$report,
            'divisi'=>$divisi,
            'jenispekerjaan'=>$jenispekerjaan,
            'lokasi'=>$lokasi,
            'user'=>$user,
        ];
        return view('livewire.counter', $data);
    }
}
