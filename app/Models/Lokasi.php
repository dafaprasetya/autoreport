<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lokasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama', 'deskripsi'
    ];
    public function reportservice() {
        return $this->hasMany(ReportService::class, 'lokasi_id');
    }
    public function reportit() {
        return $this->hasMany(ReportIt::class, 'lokasi_id');
    }
}
