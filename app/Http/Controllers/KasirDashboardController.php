<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\TransaksiDetail;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class KasirDashboardController extends Controller
{
    public function index()
    {
        // Hanya kasir yang bisa mengakses
        if (Auth::user()->role !== 'kasir') {
            abort(403, 'Unauthorized');
        }

        // Statistik untuk kasir yang sedang login
        $totalTransaksiHariIni = Transaksi::whereDate('created_at', Carbon::today())
            ->where('status', 'completed')
            ->where('user_id', Auth::id())
            ->count();

        $totalPenjualanHariIni = Transaksi::whereDate('created_at', Carbon::today())
            ->where('status', 'completed')
            ->where('user_id', Auth::id())
            ->sum('total_amount');

        $totalItemTerjualHariIni = TransaksiDetail::join('transaksis', 'transaksi_details.transaksi_id', '=', 'transaksis.id')
            ->whereDate('transaksis.created_at', Carbon::today())
            ->where('transaksis.status', 'completed')
            ->where('transaksis.user_id', Auth::id())
            ->sum('transaksi_details.quantity');

        // Transaksi pengguna yang menunggu konfirmasi
        $transaksiMenungguKonfirmasi = Transaksi::whereHas('member', function($query) {
                $query->where('role', 'pengguna');
            })
            ->whereIn('status', ['pending', 'waiting_confirmation'])
            ->count();

        return view('kasir.dashboard', compact(
            'totalTransaksiHariIni',
            'totalPenjualanHariIni',
            'totalItemTerjualHariIni',
            'transaksiMenungguKonfirmasi'
        ));
    }

    /**
     * Menampilkan daftar transaksi yang dibuat oleh pengguna
     */
    public function transaksiPengguna()
    {
        // Hanya kasir dan admin yang bisa mengakses
        if (!in_array(Auth::user()->role, ['kasir', 'admin'])) {
            abort(403, 'Unauthorized');
        }

        // Ambil transaksi yang dibuat oleh pengguna (role = pengguna)
        // dan status masih pending atau waiting untuk dikonfirmasi kasir
        $transaksiPengguna = Transaksi::with(['member', 'details.produk'])
            ->whereHas('member', function($query) {
                $query->where('role', 'pengguna');
            })
            ->whereIn('status', ['pending', 'waiting_confirmation'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('kasir.transaksi-pengguna', compact('transaksiPengguna'));
    }

    /**
     * Menampilkan detail transaksi pengguna
     */
    public function detailTransaksiPengguna($id)
    {
        // Hanya kasir dan admin yang bisa mengakses
        if (!in_array(Auth::user()->role, ['kasir', 'admin'])) {
            abort(403, 'Unauthorized');
        }

        $transaksi = Transaksi::with(['member', 'details.produk'])
            ->whereHas('member', function($query) {
                $query->where('role', 'pengguna');
            })
            ->findOrFail($id);

        return view('kasir.transaksi-pengguna-detail', compact('transaksi'));
    }

    /**
     * Konfirmasi transaksi pengguna oleh kasir
     */
    public function konfirmasiTransaksi($id)
    {
        try {
            $transaksi = Transaksi::with('details.produk')->findOrFail($id);

            // Cek stok sebelum konfirmasi
            foreach ($transaksi->details as $detail) {
                if ($detail->produk->stok < $detail->quantity) {
                    return response()->json([
                        'success' => false,
                        'message' => "Stok produk {$detail->produk->nama_produk} tidak mencukupi. Sisa stok: {$detail->produk->stok}"
                    ], 400);
                }
            }

            // Update stok produk
            foreach ($transaksi->details as $detail) {
                $detail->produk->decrement('stok', $detail->quantity);
            }

            // Update status menjadi completed dan set kasir yang mengonfirmasi
            $transaksi->update([
                'status' => 'completed',
                'user_id' => Auth::id(), // kasir yang mengonfirmasi
                'confirmed_at' => now()
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil dikonfirmasi'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengonfirmasi transaksi: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Tolak transaksi pengguna oleh kasir
     */
    public function tolakTransaksi(Request $request, $id)
    {
        try {
            $transaksi = Transaksi::findOrFail($id);

            // Update status menjadi cancelled
            $transaksi->update([
                'status' => 'cancelled',
                'user_id' => Auth::id(), // kasir yang menolak
                'notes' => $request->alasan_tolak ?? 'Ditolak oleh kasir',
                'cancelled_at' => now()
            ]);

            // Stok tidak perlu dikembalikan karena belum dikurangi saat checkout

            return response()->json([
                'success' => true,
                'message' => 'Transaksi berhasil ditolak'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menolak transaksi: ' . $e->getMessage()
            ], 500);
        }
    }
}
