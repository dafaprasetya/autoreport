<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ReportEksekutor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

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
        // if ($fotoB && $fotoB->isValid()) {

        //     // Kirim foto ke server Node.js (venom-bot)
        //     // Menginisialisasi Guzzle HTTP Client
        //     $client = new Client();

        //     // Mengirim gambar dengan data multipart
        //     $response = $client->post('http://localhost:3000/send-image', [
        //         'multipart' => [
        //             [
        //                 'name'     => 'to',
        //                 'contents' => '120363418444786688@g.us',  // Group ID tujuan
        //             ],
        //             [
        //                 'name'     => 'caption',
        //                 'contents' => $report->deskripsi_pekerjaan,
        //             ],
        //             [
        //                 'name'     => 'image',
        //                 'contents' => fopen($fotoB->getRealPath(), 'r'),
        //                 'filename' => $fotoB->getClientOriginalName(),
        //             ]
        //         ]
        //     ]);

        //     // Mengecek status response
        //     if ($response->getStatusCode() == 200) {
        //         return response()->json([
        //             'success' => true,
        //             'message' => 'Report berhasil dibuat dan gambar berhasil dikirim',
        //         ]);
        //     } else {
        //         return response()->json([
        //             'success' => false,
        //             'message' => 'Gagal mengirim gambar ke WhatsApp',
        //         ], 500);
        //     }
        // }
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
