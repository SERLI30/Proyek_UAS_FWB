<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produk;

class produkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::insert([
            [
                'name' => 'Kemeja Pria Vintage Casual Abstrak Lengan Pendek Retro Pantai Hawai Unisex',
                'deskripsi' => 'Kemeja dengan motif abstrak khas era 70-an, cocok untuk tampilan santai namun tetap stylish.',
                'price' => 50000,
                'stok' => 30,
                'kategori_id' => 1, // Pakaian
                'seller_id' => 1,   // Seller A
            ],
            [
                'name' => 'Jaket Kulit Bronx oleh Lewis Leathers',
                'deskripsi' => 'Jaket kulit klasik yang populer di kalangan pengendara motor pada era 50-an hingga 60-an.',
                'price' => 150000,
                'stok' => 50,
                'kategori_id' => 1, 
                'seller_id' => 1,
            ],
             [
                'name' => 'Gaun Gunne Sax oleh Jessica McClintock',
                'deskripsi' => 'Gaun dengan detail renda dan siluet romantis, populer di kalangan remaja pada era 70-an hingga 80-an.',
                'price' => 150000,
                'stok' => 50,
                'kategori_id' => 1, 
                'seller_id' => 1,
            ],
             [
                'name' => 'Dress Vintage Floral',
                'deskripsi' => 'Gaun dengan motif bunga yang lembut, mencerminkan gaya feminin era 70-an.',
                'price' => 150000,
                'stok' => 60,
                'kategori_id' => 1, 
                'seller_id' => 1,
            ],
             [
                'name' => 'Jam Tangan Analog Klasik',
                'deskripsi' => 'Jam tangan dengan desain sederhana dan elegan, mencerminkan keanggunan masa lalu.',
                'price' => 150000,
                'stok' => 50,
                'kategori_id' => 1, 
                'seller_id' => 1,
            ],
            [
                'name' => 'Mangkuk Pencampur Pyrex 2.4L',
                'deskripsi' => 'Mangkuk kaca tahan panas, populer pada era 50-an hingga 70-an, ideal untuk koleksi dapur vintage.',
                'price' => 150000,
                'stok' => 50,
                'kategori_id' => 1, 
                'seller_id' => 1,
            ],
        ]);
    }
}
