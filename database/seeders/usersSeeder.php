<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class usersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Users::insert([
            [
                'name' => 'Seller A',
                'email' => 'seller@example.com',
                'password' => bcrypt('112'),
                'role' => 'seller',
            ],
            [
                'name' => 'customer1',
                'email' => "customer@example.com",
                'password' => bcrypt('111'),
                'role' => 'customer'
            ],
        ]);
        
    }
}
