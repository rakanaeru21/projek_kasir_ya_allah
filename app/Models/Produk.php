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
        'harga_diskon',
        'stok',
        'satuan',
        'gambar',
        'status'
    ];

    protected $casts = [
        'harga_normal' => 'decimal:2',
        'harga_untung' => 'decimal:2',
        'harga_diskon' => 'decimal:2',
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
            $discountedPrice = $this->harga_untung - $discount;

            // Update harga_diskon di database
            $this->update(['harga_diskon' => $discountedPrice]);

            return $discountedPrice;
        }

        // Jika tidak ada promo aktif, set harga_diskon ke null
        $this->update(['harga_diskon' => null]);
        return $this->harga_untung;
    }

    /**
     * Get harga final untuk transaksi (prioritas: harga_diskon > harga_untung)
     */
    public function getFinalPrice()
    {
        return $this->harga_diskon ?? $this->harga_untung;
    }

    /**
     * Update harga diskon untuk produk ini berdasarkan promo aktif
     */
    public function updateDiscountPrice()
    {
        $activePromo = $this->promos()->active()->first();

        if ($activePromo) {
            $discount = $this->harga_untung * ($activePromo->diskon / 100);
            $discountedPrice = $this->harga_untung - $discount;
            $this->update(['harga_diskon' => $discountedPrice]);
        } else {
            $this->update(['harga_diskon' => null]);
        }
    }

    /**
     * Mendapatkan informasi promo aktif
     */
    public function getActivePromoInfo()
    {
        $activePromo = $this->promos()->active()->first();

        if ($activePromo) {
            return [
                'has_promo' => true,
                'promo_name' => $activePromo->nama,
                'discount_percent' => $activePromo->diskon,
                'original_price' => $this->harga_untung,
                'discounted_price' => $this->getDiscountedPrice(),
                'savings' => $this->harga_untung - $this->getDiscountedPrice()
            ];
        }

        return [
            'has_promo' => false,
            'promo_name' => null,
            'discount_percent' => 0,
            'original_price' => $this->harga_untung,
            'discounted_price' => $this->harga_untung,
            'savings' => 0
        ];
    }
}
