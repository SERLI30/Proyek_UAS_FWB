<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class kategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {
        Kategori::insert([
            ['name' => 'Pakaian'],
            ['name' => 'Aksesori'],
            ['name' => 'Perabot Vintage'],
        ]);
    }
}
