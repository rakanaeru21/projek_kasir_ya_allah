<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AeruCoinRequest extends Model
{
    protected $table = 'aerucoin_requests';

    protected $fillable = [
        'user_id',
        'amount',
        'cash_amount',
        'description',
        'status',
        'approved_by',
        'approval_notes',
        'approved_at',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'cash_amount' => 'decimal:2',
            'approved_at' => 'datetime',
        ];
    }

    /**
     * Relasi ke user yang mengajukan request
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke kasir yang menyetujui request
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Scope untuk request yang pending
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Scope untuk request yang approved
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope untuk request yang rejected
     */
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    /**
     * Scope untuk filter berdasarkan user
     */
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    /**
     * Method untuk format amount
     */
    public function getFormattedAmountAttribute()
    {
        return number_format((float) $this->amount, 0, ',', '.');
    }

    /**
     * Method untuk format cash amount
     */
    public function getFormattedCashAmountAttribute()
    {
        return number_format((float) $this->cash_amount, 0, ',', '.');
    }

    /**
     * Method untuk mendapatkan status badge
     */
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => '<span class="badge bg-warning">Menunggu Persetujuan</span>',
            'approved' => '<span class="badge bg-success">Disetujui</span>',
            'rejected' => '<span class="badge bg-danger">Ditolak</span>',
            default => '<span class="badge bg-secondary">Unknown</span>',
        };
    }

    /**
     * Method untuk approve request
     */
    public function approve($kasirId, $notes = null)
    {
        $this->update([
            'status' => 'approved',
            'approved_by' => $kasirId,
            'approval_notes' => $notes,
            'approved_at' => now(),
        ]);

        // Tambahkan AeruCoin ke user
        $this->user->addAeruCoin($this->amount);

        // Buat record di AeruCoinTransaction
        AeruCoinTransaction::create([
            'user_id' => $this->user_id,
            'kasir_id' => $kasirId,
            'amount' => $this->amount,
            'cash_received' => $this->cash_amount,
            'type' => 'topup',
            'description' => 'Topup dari request user: ' . ($this->description ?? 'Tidak ada keterangan'),
            'reference_id' => 'request_' . $this->id,
        ]);

        return $this;
    }

    /**
     * Method untuk reject request
     */
    public function reject($kasirId, $notes = null)
    {
        $this->update([
            'status' => 'rejected',
            'approved_by' => $kasirId,
            'approval_notes' => $notes,
            'approved_at' => now(),
        ]);

        return $this;
    }
}
