<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'jabatan',
        'picture',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function reportservice() {
        return $this->hasMany(ReportService::class, 'user_id');
    }
    public function reportit() {
        return $this->hasMany(ReportIt::class, 'user_id');
    }
    public function reportharianservice() {
        return $this->hasMany(ReportHarianService::class, 'user_id');
    }
    public function kategoriHarian()
    {
        return $this->hasMany(KategoriHarian::class, 'kategori_harian_id');
    }
}
