<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukController extends Controller
{
    /**
     * Generate kode produk otomatis
     */
    private function generateKodeProduk()
    {
        $lastProduk = Produk::orderBy('id', 'desc')->first();

        if (!$lastProduk) {
            return 'PRD001';
        }

        // Ambil angka dari kode terakhir
        $lastNumber = (int) substr($lastProduk->kode_produk, 3);
        $newNumber = $lastNumber + 1;

        // Format dengan 3 digit
        return 'PRD' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10); // Default 10 items per page
        $produks = Produk::latest()->paginate($perPage);

        // Jika request AJAX, return JSON
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'data' => $produks->items(),
                'current_page' => $produks->currentPage(),
                'last_page' => $produks->lastPage(),
                'per_page' => $produks->perPage(),
                'total' => $produks->total(),
                'from' => $produks->firstItem(),
                'to' => $produks->lastItem(),
            ]);
        }

        return view('admin.produk', compact('produks'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:255',
            'harga_normal' => 'required|numeric|min:0',
            'harga_untung' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'status' => 'required|in:aktif,nonaktif',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $data = $request->except('gambar');

            // Generate kode produk otomatis
            $data['kode_produk'] = $this->generateKodeProduk();

            // Handle upload gambar
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/produk'), $filename);
                $data['gambar'] = 'uploads/produk/' . $filename;
            }

            $produk = Produk::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil ditambahkan dengan kode: ' . $data['kode_produk'],
                'data' => $produk
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan produk: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $produk = Produk::findOrFail($id);
            return response()->json([
                'success' => true,
                'data' => $produk
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'kategori' => 'required|string|max:255',
            'harga_normal' => 'required|numeric|min:0',
            'harga_untung' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'satuan' => 'required|string|max:50',
            'status' => 'required|in:aktif,nonaktif',
            'gambar' => 'nullable|image|mimes:jpeg,jpg,png,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $produk = Produk::findOrFail($id);
            $data = $request->except('gambar');

            // Handle upload gambar baru
            if ($request->hasFile('gambar')) {
                // Hapus gambar lama jika ada
                if ($produk->gambar && file_exists(public_path($produk->gambar))) {
                    unlink(public_path($produk->gambar));
                }

                $file = $request->file('gambar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/produk'), $filename);
                $data['gambar'] = 'uploads/produk/' . $filename;
            }

            $produk->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil diupdate',
                'data' => $produk
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate produk: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $produk = Produk::findOrFail($id);

            // Hapus gambar jika ada
            if ($produk->gambar && file_exists(public_path($produk->gambar))) {
                unlink(public_path($produk->gambar));
            }

            $produk->delete();

            return response()->json([
                'success' => true,
                'message' => 'Produk berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus produk: ' . $e->getMessage()
            ], 500);
        }
    }
}
