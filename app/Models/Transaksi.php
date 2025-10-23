<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'user_id',
        'customer_name',
        'payment_method',
        'subtotal',
        'tax',
        'total_amount',
        'cash_amount',
        'change_amount',
        'status',
        'notes'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'tax' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'cash_amount' => 'decimal:2',
        'change_amount' => 'decimal:2',
    ];

    /**
     * Relasi ke User (kasir yang melakukan transaksi)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke TransaksiDetail
     */
    public function details()
    {
        return $this->hasMany(TransaksiDetail::class);
    }

    /**
     * Generate kode transaksi unik
     */
    public static function generateKodeTransaksi()
    {
        $date = date('ymd');
        $lastTransaction = self::whereDate('created_at', today())
                              ->orderBy('created_at', 'desc')
                              ->first();

        if ($lastTransaction) {
            $lastNumber = (int) substr($lastTransaction->kode_transaksi, -4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        return 'TRX' . $date . sprintf('%04d', $newNumber);
    }
}
