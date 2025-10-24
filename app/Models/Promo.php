<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'deskripsi',
        'diskon',
        'mulai',
        'berakhir'
    ];

    protected $casts = [
        'diskon' => 'decimal:2'
    ];

    /**
     * Relasi many-to-many dengan produk
     */
    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'promo_produk');
    }

    /**
     * Cek apakah promo masih aktif
     */
    public function isActive()
    {
        $today = now()->toDateString();
        return $this->mulai <= $today && $this->berakhir >= $today;
    }

    /**
     * Scope untuk promo yang aktif
     */
    public function scopeActive($query)
    {
        $today = now()->format('Y-m-d');
        return $query->whereDate('mulai', '<=', $today)
                    ->whereDate('berakhir', '>=', $today);
    }
}
