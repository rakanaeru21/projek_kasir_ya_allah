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
}
