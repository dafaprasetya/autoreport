<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPekerjaan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama', 'deskripsi'
    ];
    public function reportservice() {
        return $this->hasMany(ReportService::class, 'jenis_pekerjaan_id');
    }
    public function reportit() {
        return $this->hasMany(ReportIt::class, 'jenis_pekerjaan_id');
    }
}
