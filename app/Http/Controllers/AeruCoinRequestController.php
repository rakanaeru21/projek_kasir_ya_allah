<?php

namespace App\Http\Controllers;

use App\Models\AeruCoinRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AeruCoinRequestController extends Controller
{
    /**
     * Halaman untuk user melihat request mereka
     */
    public function index()
    {
        $requests = AeruCoinRequest::forUser(Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pengguna.aerucoin-requests', compact('requests'));
    }

    /**
     * Submit request baru dari user
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000|max:1000000',
            'cash_amount' => 'required|numeric|min:1000|max:1000000',
            'description' => 'nullable|string|max:500',
        ], [
            'amount.required' => 'Jumlah AeruCoin harus diisi',
            'amount.numeric' => 'Jumlah AeruCoin harus berupa angka',
            'amount.min' => 'Jumlah AeruCoin minimal 1.000',
            'amount.max' => 'Jumlah AeruCoin maksimal 1.000.000',
            'cash_amount.required' => 'Jumlah uang tunai harus diisi',
            'cash_amount.numeric' => 'Jumlah uang tunai harus berupa angka',
            'cash_amount.min' => 'Jumlah uang tunai minimal 1.000',
            'cash_amount.max' => 'Jumlah uang tunai maksimal 1.000.000',
            'description.max' => 'Keterangan maksimal 500 karakter',
        ]);

        try {
            AeruCoinRequest::create([
                'user_id' => Auth::id(),
                'amount' => $request->amount,
                'cash_amount' => $request->cash_amount,
                'description' => $request->description,
                'status' => 'pending',
            ]);

            return back()->with('success', 'Request penambahan AeruCoin berhasil dikirim. Silakan tunggu persetujuan dari kasir.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Halaman untuk kasir melihat semua request
     */
    public function kasirIndex()
    {
        $requests = AeruCoinRequest::with(['user', 'approvedBy'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $pendingCount = AeruCoinRequest::pending()->count();

        return view('kasir.aerucoin-requests', compact('requests', 'pendingCount'));
    }

    /**
     * Approve request oleh kasir
     */
    public function approve(Request $request, AeruCoinRequest $aerucoinRequest)
    {
        $request->validate([
            'approval_notes' => 'nullable|string|max:500',
        ]);

        if ($aerucoinRequest->status !== 'pending') {
            return back()->with('error', 'Request ini sudah diproses sebelumnya.');
        }

        try {
            DB::beginTransaction();

            $aerucoinRequest->approve(Auth::id(), $request->approval_notes);

            DB::commit();

            return back()->with('success', 'Request berhasil disetujui dan AeruCoin telah ditambahkan ke akun user.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Reject request oleh kasir
     */
    public function reject(Request $request, AeruCoinRequest $aerucoinRequest)
    {
        $request->validate([
            'approval_notes' => 'required|string|max:500',
        ], [
            'approval_notes.required' => 'Alasan penolakan harus diisi',
            'approval_notes.max' => 'Alasan penolakan maksimal 500 karakter',
        ]);

        if ($aerucoinRequest->status !== 'pending') {
            return back()->with('error', 'Request ini sudah diproses sebelumnya.');
        }

        try {
            $aerucoinRequest->reject(Auth::id(), $request->approval_notes);

            return back()->with('success', 'Request berhasil ditolak.');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show detail request
     */
    public function show(AeruCoinRequest $aerucoinRequest)
    {
        // Untuk user, hanya bisa lihat request milik sendiri
        if (Auth::user()->role !== 'kasir' && $aerucoinRequest->user_id !== Auth::id()) {
            abort(403, 'Unauthorized access');
        }

        $aerucoinRequest->load(['user', 'approvedBy']);

        return view('shared.aerucoin-request-detail', compact('aerucoinRequest'));
    }
}
