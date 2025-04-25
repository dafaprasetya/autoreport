<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportHarianIt extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'agenda',
        'kategori_harian_id',
        'user_id',
        'status',
        'detail_kerja',
        'poin',
        'dibuatOleh',
    ];
    public function kategoriHarian()
    {
        return $this->belongsTo(KategoriHarian::class, 'kategori_harian_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function dibuat_oleh() {
        return $this->belongsTo(User::class, 'dibuatOleh');
    }
}
