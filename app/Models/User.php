<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'nama',
        'nomor_telepon',
        'email',
        'password',
        'role',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    /**
     * Relasi ke transaksi dimana user ini sebagai kasir
     */
    public function transaksiSebagaiKasir()
    {
        return $this->hasMany(Transaksi::class, 'user_id');
    }

    /**
     * Relasi ke transaksi dimana user ini sebagai pengguna
     */
    public function transaksiSebagaiPengguna()
    {
        return $this->hasMany(Transaksi::class, 'pengguna_id');
    }

    /**
     * Scope untuk hanya mengambil kasir
     */
    public function scopeKasir($query)
    {
        return $query->where('role', 'kasir');
    }

    /**
     * Scope untuk user aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
