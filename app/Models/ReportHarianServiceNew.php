<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportHarianServiceNew extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'agenda',
        'kategori_harian_id',
        'tanggal_penugasan',
        'target_selesai',
        'user_id',
        'detail_kerja',
        'status',
        'note_progres',
        'report_eksekutor_id',
        'overtime',
        'dibuatOleh',
    ];

    public function kategoriHarian()
    {
        return $this->belongsTo(KategoriHarianNew::class, 'kategori_harian_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function dibuat_oleh() {
        return $this->belongsTo(User::class, 'dibuatOleh');
    }
}
