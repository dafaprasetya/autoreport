<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportEksekutor extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'tanggal',
        'deskripsi_pekerjaan',
        'kategori',
        'foto_before',
        'foto_after',
        'kategori_harian_id',
        'divisi_id',
        'jenis_pekerjaan_id',
        'lokasi_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function lokasi() {
        return $this->belongsTo(Lokasi::class);
    }
    public function divisi() {
        return $this->belongsTo(Divisi::class);
    }
    public function jenis_pekerjaan() {
        return $this->belongsTo(JenisPekerjaan::class);
    }
    public function kategoriHarian()
    {
        return $this->belongsTo(KategoriHarian::class);
    }
}
