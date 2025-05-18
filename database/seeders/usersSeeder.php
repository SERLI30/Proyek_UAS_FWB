<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin Utama',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Seller A',
                'email' => 'seller@gmail.com',
                'password' => bcrypt('112'),
                'role' => 'seller',
            ],
            [
                'name' => 'customer1',
                'email' => "customer@gmail.com",
                'password' => bcrypt('111'),
                'role' => 'customer'
            ],
        ]);
        
    }
}
