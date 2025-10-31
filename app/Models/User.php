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
        'aerucoin_balance',
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
            'aerucoin_balance' => 'decimal:2',
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
     * Relasi ke transaksi AeruCoin dimana user ini menerima topup
     */
    public function aerucoinTransactions()
    {
        return $this->hasMany(AeruCoinTransaction::class, 'user_id');
    }

    /**
     * Relasi ke transaksi AeruCoin dimana user ini sebagai kasir yang melakukan topup
     */
    public function aerucoinTransactionsAsKasir()
    {
        return $this->hasMany(AeruCoinTransaction::class, 'kasir_id');
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

    /**
     * Method untuk menambah saldo AeruCoin
     */
    public function addAeruCoin($amount)
    {
        $this->increment('aerucoin_balance', $amount);
        return $this;
    }

    /**
     * Method untuk mengurangi saldo AeruCoin
     */
    public function subtractAeruCoin($amount)
    {
        if ($this->aerucoin_balance >= $amount) {
            $this->decrement('aerucoin_balance', $amount);
            return true;
        }
        return false;
    }

    /**
     * Method untuk format saldo AeruCoin
     */
    public function getFormattedAeruCoinBalanceAttribute()
    {
        return number_format((float) $this->aerucoin_balance, 0, ',', '.');
    }

    /**
     * Method untuk cek apakah saldo mencukupi
     */
    public function hasEnoughAeruCoin($amount)
    {
        return $this->aerucoin_balance >= $amount;
    }
}
