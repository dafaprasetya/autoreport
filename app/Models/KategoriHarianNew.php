<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriHarianNew extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama', 'deskripsi', 'poin',
    ];
    public function reportHarian(){
        return $this->hasMany(ReportHarianService::class, 'kategori_harian_id');
    }
}
