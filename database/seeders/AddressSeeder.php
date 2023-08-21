<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('address')->insert([
            'address' => 'Jl. Kelapa Airnona, Kota Kupang',
            'maps' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3926.9755599605583!2d123.584749!3d-10.18264!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2c569b631bd76741%3A0x94f6093584d434b3!2sJl.%20Klp.%2C%20Air%20Nona%2C%20Kec.%20Kota%20Raja%2C%20Kota%20Kupang%2C%20Nusa%20Tenggara%20Tim.!5e0!3m2!1sid!2sid!4v1692333497787!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'telp' => '081353094765',
            'whatsapp' => '081353094765',
            'email' => '081353094765',
        ]);
    }
}
