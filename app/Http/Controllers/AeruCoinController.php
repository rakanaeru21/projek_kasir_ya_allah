<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AeruCoinTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class AeruCoinController extends Controller
{
    /**
     * Menampilkan halaman topup AeruCoin untuk kasir
     */
    public function index()
    {
        // Pastikan hanya kasir dan admin yang bisa akses
        if (!in_array(Auth::user()->role, ['kasir', 'admin'])) {
            abort(403, 'Unauthorized access');
        }

        $recentTransactions = AeruCoinTransaction::with(['user', 'kasir'])
                                                ->latest()
                                                ->limit(10)
                                                ->get();

        return view('kasir.aerucoin-topup', compact('recentTransactions'));
    }

    /**
     * Proses topup AeruCoin
     */
    public function topup(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_number' => 'required|string',
            'cash_received' => 'required|numeric|min:1000',
            'amount' => 'required|numeric|min:1000',
            'description' => 'nullable|string|max:255',
        ], [
            'member_number.required' => 'Nomor member harus diisi',
            'cash_received.required' => 'Jumlah uang tunai harus diisi',
            'cash_received.numeric' => 'Jumlah uang tunai harus berupa angka',
            'cash_received.min' => 'Minimal topup Rp 1.000',
            'amount.required' => 'Jumlah AeruCoin harus diisi',
            'amount.numeric' => 'Jumlah AeruCoin harus berupa angka',
            'amount.min' => 'Minimal topup 1.000 AeruCoin',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            DB::beginTransaction();

            $user = User::where('nomor_telepon', $request->member_number)
                       ->where('role', 'pengguna')
                       ->where('is_active', true)
                       ->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Member tidak ditemukan'
                ], 404);
            }

            // Tambah saldo AeruCoin ke user
            $user->addAeruCoin($request->amount);

            // Simpan transaksi
            $transaction = AeruCoinTransaction::create([
                'user_id' => $user->id,
                'kasir_id' => Auth::id(),
                'amount' => $request->amount,
                'cash_received' => $request->cash_received,
                'type' => 'topup',
                'description' => $request->description ?? 'Topup AeruCoin melalui kasir',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Topup AeruCoin berhasil!',
                'data' => [
                    'user_name' => $user->nama,
                    'amount' => number_format($request->amount, 0, ',', '.'),
                    'new_balance' => number_format((float) $user->fresh()->aerucoin_balance, 0, ',', '.'),
                    'transaction_id' => $transaction->id,
                ]
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mendapatkan detail user berdasarkan nomor member (nomor telepon)
     */
    public function getUserByMember($memberNumber)
    {
        try {
            $user = User::where('nomor_telepon', $memberNumber)
                       ->where('role', 'pengguna')
                       ->where('is_active', true)
                       ->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Member tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $user->id,
                    'nama' => $user->nama,
                    'nomor_telepon' => $user->nomor_telepon,
                    'current_balance' => number_format((float) $user->aerucoin_balance, 0, ',', '.'),
                    'current_balance_raw' => $user->aerucoin_balance,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mendapatkan detail user untuk topup
     */
    public function getUserDetail($id)
    {
        try {
            $user = User::where('id', $id)
                       ->where('role', 'pengguna')
                       ->where('is_active', true)
                       ->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $user->id,
                    'nama' => $user->nama,
                    'nomor_telepon' => $user->nomor_telepon,
                    'current_balance' => number_format((float) $user->aerucoin_balance, 0, ',', '.'),
                    'current_balance_raw' => $user->aerucoin_balance,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Menampilkan history transaksi AeruCoin
     */
    public function history(Request $request)
    {
        $query = AeruCoinTransaction::with(['user', 'kasir'])->latest();

        // Filter berdasarkan user jika ada
        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // Filter berdasarkan tanggal jika ada
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter berdasarkan tipe transaksi
        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        $transactions = $query->paginate(20);
        $users = User::where('role', 'pengguna')->where('is_active', true)->orderBy('nama')->get();

        return view('kasir.aerucoin-history', compact('transactions', 'users'));
    }

    /**
     * Mendapatkan saldo AeruCoin user untuk ditampilkan di kasir
     */
    public function checkBalance($phoneNumber)
    {
        try {
            $user = User::where('nomor_telepon', $phoneNumber)
                       ->where('role', 'pengguna')
                       ->where('is_active', true)
                       ->first();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak ditemukan'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'user_id' => $user->id,
                    'nama' => $user->nama,
                    'balance' => number_format((float) $user->aerucoin_balance, 0, ',', '.'),
                    'balance_raw' => $user->aerucoin_balance,
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
