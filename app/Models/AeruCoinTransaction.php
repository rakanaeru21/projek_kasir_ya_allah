<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AeruCoinTransaction extends Model
{
    protected $table = 'aerucoin_transactions';

    protected $fillable = [
        'user_id',
        'kasir_id',
        'amount',
        'cash_received',
        'type',
        'description',
        'reference_id',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'cash_received' => 'decimal:2',
        ];
    }

    /**
     * Relasi ke user yang menerima AeruCoin
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke kasir yang melakukan transaksi
     */
    public function kasir(): BelongsTo
    {
        return $this->belongsTo(User::class, 'kasir_id');
    }

    /**
     * Scope untuk transaksi topup
     */
    public function scopeTopup($query)
    {
        return $query->where('type', 'topup');
    }

    /**
     * Scope untuk transaksi usage (penggunaan)
     */
    public function scopeUsage($query)
    {
        return $query->where('type', 'usage');
    }

    /**
     * Scope untuk transaksi refund
     */
    public function scopeRefund($query)
    {
        return $query->where('type', 'refund');
    }

    /**
     * Method untuk format amount
     */
    public function getFormattedAmountAttribute()
    {
        return number_format((float) $this->amount, 0, ',', '.');
    }

    /**
     * Method untuk format cash received
     */
    public function getFormattedCashReceivedAttribute()
    {
        return number_format((float) $this->cash_received, 0, ',', '.');
    }

    /**
     * Scope untuk filter berdasarkan user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Scope untuk filter berdasarkan kasir
     */
    public function scopeByKasir($query, $kasirId)
    {
        return $query->where('kasir_id', $kasirId);
    }
}
