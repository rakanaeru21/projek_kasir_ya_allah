<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'deskripsi',
        'kategori',
        'harga_normal',
        'harga_untung',
        'stok',
        'satuan',
        'gambar',
        'status'
    ];

    protected $casts = [
        'harga_normal' => 'decimal:2',
        'harga_untung' => 'decimal:2',
        'stok' => 'integer',
    ];

    /**
     * Relasi many-to-many dengan promo
     */
    public function promos()
    {
        return $this->belongsToMany(Promo::class, 'promo_produk');
    }

    /**
     * Cek apakah produk memiliki promo aktif
     */
    public function hasActivePromo()
    {
        return $this->promos()->active()->exists();
    }

    /**
     * Mendapatkan harga setelah diskon jika ada promo aktif
     */
    public function getDiscountedPrice()
    {
        $activePromo = $this->promos()->active()->first();

        if ($activePromo) {
            // Asumsi diskon dalam persen
            $discount = $this->harga_untung * ($activePromo->diskon / 100);
            return $this->harga_untung - $discount;
        }

        return $this->harga_untung;
    }
}
