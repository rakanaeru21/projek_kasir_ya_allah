<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $promos = Promo::with('produks')->orderBy('created_at', 'desc')->get();
        $produks = Produk::where('status', 'aktif')->orderBy('nama_produk')->get();

        return view('admin.promo', compact('promos', 'produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'diskon' => 'required|numeric|min:0|max:100',
            'mulai' => 'required|date',
            'berakhir' => 'required|date|after_or_equal:mulai',
            'produk_ids' => 'required|array|min:1',
            'produk_ids.*' => 'exists:produks,id'
        ], [
            'nama.required' => 'Nama promo harus diisi',
            'diskon.required' => 'Diskon harus diisi',
            'diskon.numeric' => 'Diskon harus berupa angka',
            'diskon.max' => 'Diskon maksimal 100%',
            'mulai.required' => 'Tanggal mulai harus diisi',
            'berakhir.required' => 'Tanggal berakhir harus diisi',
            'berakhir.after_or_equal' => 'Tanggal berakhir harus setelah atau sama dengan tanggal mulai',
            'produk_ids.required' => 'Pilih minimal 1 produk',
            'produk_ids.min' => 'Pilih minimal 1 produk'
        ]);

        try {
            DB::beginTransaction();

            $promo = Promo::create([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'diskon' => $request->diskon,
                'mulai' => $request->mulai,
                'berakhir' => $request->berakhir,
            ]);

            // Attach produk ke promo
            $promo->produks()->attach($request->produk_ids);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Promo berhasil ditambahkan!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan promo: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the specified resource for editing.
     */
    public function show(Promo $promo)
    {
        $promo->load('produks');
        return response()->json([
            'success' => true,
            'data' => $promo
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promo $promo)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'diskon' => 'required|numeric|min:0|max:100',
            'mulai' => 'required|date',
            'berakhir' => 'required|date|after_or_equal:mulai',
            'produk_ids' => 'required|array|min:1',
            'produk_ids.*' => 'exists:produks,id'
        ], [
            'nama.required' => 'Nama promo harus diisi',
            'diskon.required' => 'Diskon harus diisi',
            'diskon.numeric' => 'Diskon harus berupa angka',
            'diskon.max' => 'Diskon maksimal 100%',
            'mulai.required' => 'Tanggal mulai harus diisi',
            'berakhir.required' => 'Tanggal berakhir harus diisi',
            'berakhir.after_or_equal' => 'Tanggal berakhir harus setelah atau sama dengan tanggal mulai',
            'produk_ids.required' => 'Pilih minimal 1 produk',
            'produk_ids.min' => 'Pilih minimal 1 produk'
        ]);

        try {
            DB::beginTransaction();

            $promo->update([
                'nama' => $request->nama,
                'deskripsi' => $request->deskripsi,
                'diskon' => $request->diskon,
                'mulai' => $request->mulai,
                'berakhir' => $request->berakhir,
            ]);

            // Sync produk (hapus yang lama, tambah yang baru)
            $promo->produks()->sync($request->produk_ids);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Promo berhasil diperbarui!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui promo: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promo $promo)
    {
        try {
            DB::beginTransaction();

            // Hapus relasi dengan produk
            $promo->produks()->detach();

            // Hapus promo
            $promo->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Promo berhasil dihapus!'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus promo: ' . $e->getMessage()
            ], 500);
        }
    }
}
