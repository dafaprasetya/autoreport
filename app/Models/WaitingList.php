<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaitingList extends Model
{
    use HasFactory;
    protected $fillable=[
        'tanggal',
        'keluhan',
        'divisi',
        'foto_keluhan',
        'kategori',
        'status',
    ];
    function dibuat_oleh() {
        return $this->belongsTo(User::class, 'dibuatOleh');
    }
    function divisi() {
        return $this->belongsTo(Divisi::class, 'divisi_id');
    }
}
