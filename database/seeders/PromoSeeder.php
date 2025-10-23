<?php

namespace Database\Seeders;

use App\Models\Promo;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class PromoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil beberapa produk untuk dijadikan contoh
        $produks = Produk::limit(5)->get();

        if ($produks->count() > 0) {
            // Promo Flash Sale
            $promo1 = Promo::create([
                'nama' => 'Flash Sale Weekend',
                'deskripsi' => 'Diskon spesial weekend untuk produk pilihan',
                'diskon' => 25,
                'mulai' => now()->toDateString(),
                'berakhir' => now()->addDays(7)->toDateString(),
            ]);

            // Attach 3 produk pertama
            $promo1->produks()->attach($produks->take(3)->pluck('id'));

            // Promo Ramadhan
            $promo2 = Promo::create([
                'nama' => 'Promo Bulan Suci',
                'deskripsi' => 'Berkah diskon untuk bulan yang penuh berkah',
                'diskon' => 15,
                'mulai' => now()->addDays(10)->toDateString(),
                'berakhir' => now()->addDays(40)->toDateString(),
            ]);

            // Attach 2 produk terakhir
            $promo2->produks()->attach($produks->skip(3)->take(2)->pluck('id'));

            // Promo Clearance
            $promo3 = Promo::create([
                'nama' => 'Clearance Sale',
                'deskripsi' => 'Diskon besar-besaran untuk produk terpilih',
                'diskon' => 40,
                'mulai' => now()->subDays(5)->toDateString(),
                'berakhir' => now()->subDays(1)->toDateString(), // Sudah berakhir
            ]);

            // Attach semua produk
            $promo3->produks()->attach($produks->pluck('id'));
        }
    }
}
