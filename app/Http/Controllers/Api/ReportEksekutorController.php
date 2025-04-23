<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReportEksekutor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReportEksekutorController extends Controller
{
    public function buatReport(Request $request) {
        if ($request->foto_after) {
            $report = ReportEksekutor::find($request->id);
            $fotoAf = $request->foto_after;
            $nama_file = 'after_'.$report->id.'.'.$fotoAf->extension();
            $fotoAf->storeAs('public/reporteksekutor/foto_after/', $nama_file);
            $report->foto_after = $nama_file;
            $report->save();
            return response()->json([
                'success' => true,
                'message' => 'report berhasil diedit',
            ]);
        }
        if (Validator::make($request->all(), [
            'tanggal' => 'required',
            'deskripsi' => 'required',
        ])->fails()) {
            return response()->json([
                'success'=>'false',
                'message' => 'Data Tidak Lengkap'
            ], 422);
        }
        $report = new ReportEksekutor();
        $report->user_id = $request->user()->id;
        $report->tanggal = Carbon::parse($request->tanggal);
        $report->deskripsi_pekerjaan = $request->deskripsi;
        $report->kategori = $request->user()->bagian;
        $report->save();
        $fotoB = $request->file('foto_before');
        $nama_file = 'before_'.$report->id.'.'.$fotoB->extension();
        $fotoB->storeAs('public/reporteksekutor/foto_before/', $nama_file);
        $report->foto_before = $nama_file;
        $report->save();
        return response()->json([
            'success' => true,
            'message' => 'report berhasil dibuat',
        ]);
    }
    public function buatTimeOff() {
        return response()->json([
            'message' => 'under develop',
        ]);
    }
}
