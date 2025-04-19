<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use App\Models\JenisPekerjaan;
use App\Models\Lokasi;
use App\Models\ReportHarianService;
use App\Models\ReportService;
use App\Models\User;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct()
    {
        // echo 'hai';
    }
    public function masterGa(Request $request){
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
    public function reportHarian(Request $request) {
        $leaderboard = ReportHarianService::select('user_id')
                        ->selectRaw('SUM(poin) as total_poin')
                        // ->whereMonth('date', now()->month)
                        ->whereYear('date', now()->year)
                        ->groupBy('user_id')
                        ->orderByDesc('total_poin')
                        ->get();

        $data = [
            'title'=> 'Admin Report Harian Service',
            'leaderboard' => $leaderboard,
        ];
        return view('admin.service.harian.index', $data);
    }
    public function reportHarianDetail(Request $request, $tanggal) {
        $report = ReportHarianService::whereDate('date', $tanggal)->get();
        $poin = ReportHarianService::select('user_id')
                        ->selectRaw('SUM(poin) as total_poin')
                        // ->whereMonth('date', now()->month)
                        ->whereDate('date', $tanggal)
                        ->groupBy('user_id')
                        ->orderByDesc('total_poin')
                        ->get();
        $data = [
            'title'=> 'Admin Report Harian Service tanggal '.$tanggal,
            'report' => $report,
            'tanggal' => $tanggal,
            'poin' => $poin,
        ];
        return view('admin.service.harian.detail', $data);
    }
    public function tambahReport(Request $requestl) {

        $data = [
            'title'=> 'Admin Tambah Report Harian',
        ];
        return view('admin.service.report.tambah', $data);
    }
}
