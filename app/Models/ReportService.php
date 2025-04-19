<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportService extends Model
{
    use HasFactory;
    protected $fillable =[
        'tanggal',
        'keterangan',
        'user_id',
        'deskripsi_pekerjaan',
        'divisi_id',
        'jenis_pekerjaan_id',
        'lokasi_id',
        'foto_before',
        'foto_after',
        'tanggal_selesai',
        'lead_time',
    ];
    public function lokasi() {
        return $this->belongsTo(Lokasi::class, 'lokasi_id');
    }
    public function divisi() {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
    public function jenis_pekerjaan() {
        return $this->belongsTo(JenisPekerjaan::class, 'jenis_pekerjaan_id');
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
