<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            'title' => 'Rental Mobil Kupang Messi',
            'about' => 'Rental Mobil Kupang Messi merupakan salah satu penyedia layanan rental dan sewa mobil di Kupang. Menggunakan armada mobil keluaran baru, dengan kondisi terawat untuk disewakan kepada Anda.',
            'logo' => 'logo.png',
            'favicon' =>'favicon.ico',
            'logo_admin' => 'logo.png',
        ]);
    }
}
