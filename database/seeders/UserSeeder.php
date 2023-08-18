<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => '2023-08-09 09:42:22',
            'password' => '$2y$10$uyu3w0GP034iClDHmmpLGe/anefQpjDcyX9J2FWpiENTafBOP.KsS',
        ]);
    }
}
