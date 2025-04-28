<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportTeknisiResource;
use App\Models\ReportEksekutor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

class ReportEksekutorController extends Controller
{

    private function kirimkeVenom($file, $report, $status){
        $client = new Client();
        // Mengirim gambar dengan data multipart
        if ($status == 'Foto Before') {
            $response = $client->post('http://localhost:3000/api/kirim-report', [
                'multipart' => [
                    [
                        'name'     => 'nomor',
                        'contents' => '120363418444786688@g.us',  // Group ID tujuan
                    ],
                    [
                        'name'     => 'pesan',
                        'contents' => $report->deskripsi_pekerjaan,
                    ],
                    [
                        'name'     => 'user',
                        'contents' => $report->user->name,
                    ],
                    [
                        'name'     => 'note',
                        'contents' => $status,
                    ],
                    [
                        'name'     => 'gambar',
                        'contents' => fopen($file->getRealPath(), 'r'),
                        'filename' => $file->getClientOriginalName(),
                    ]
                ]
            ]);
        }else if ($status == 'Foto After') {
            $formatted = "pada tanggal " . Carbon::parse($report->created_at)->locale('id')->translatedFormat('d F') . ", jam " . Carbon::parse($report->created_at)->format('H:i');

            $response = $client->post('http://localhost:3000/api/kirim-report', [
                'multipart' => [
                    [
                        'name'     => 'nomor',
                        'contents' => '120363418444786688@g.us',  // Group ID tujuan
                    ],
                    [
                        'name'     => 'pesan',
                        'contents' => "Foto After dari pekerjaan yang dikerjakan {$formatted} \ndengan deskripsi pekerjaan:\n{$report->deskripsi_pekerjaan}",
                    ],
                    [
                        'name'     => 'user',
                        'contents' => $report->user->name,
                    ],
                    [
                        'name'     => 'note',
                        'contents' => $status,
                    ],
                    [
                        'name'     => 'gambar',
                        'contents' => fopen($file->getRealPath(), 'r'),
                        'filename' => $file->getClientOriginalName(),
                    ]
                ]
            ]);
        }

        // Mengecek status response
        if ($response->getStatusCode() == 200) {
            return response()->json([
                'success' => true,
                'message' => 'Report berhasil dibuat dan gambar berhasil dikirim',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim gambar ke WhatsApp',
            ], 500);
        }
    }

    public function buatReport(Request $request) {
        if ($request->foto_after) {
            $report = ReportEksekutor::find($request->id);
            $fotoAf = $request->foto_after;
            $nama_file = 'after_'.$report->id.'.'.$fotoAf->extension();
            $fotoAf->storeAs('public/reporteksekutor/foto_after/', $nama_file);
            $report->foto_after = $nama_file;
            $report->save();
            if ($fotoAf && $fotoAf->isValid()) {
                try {
                    $this->kirimkeVenom($fotoAf, $report, 'Foto After');
                } catch (\Throwable $th) {
                    return response()->json([
                        'success' => True,
                        'message' => 'data berhasil dibuat tetapi tidak dikirim ke wangsaf',
                    ]);
                }
            }
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
        if ($fotoB && $fotoB->isValid()) {
            try {
                //code...
                $this->kirimkeVenom($fotoB, $report, 'Foto Before');
            } catch (\Throwable $th) {
                //throw $th;
                return response()->json([
                    'success' => True,
                    'message' => 'data berhasil dibuat tetapi tidak dikirim ke wangsaf',
                ]);
            }
        }
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
    public function tesLogin(){
        return response()->json([
            'success' => true,
        ]);
    }
    public function getReport(Request $request) {
        return new ReportTeknisiResource($request->user());
    }
}
