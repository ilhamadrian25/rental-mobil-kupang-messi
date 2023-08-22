<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetaSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('meta')->insert([
            'title' => 'Rental Mobil Kupang Messi',
            'description' => 'Deskripsias',
            'keywords' => 'kata kunci pertama, kata kunci kedua, kata kunci ketiga',
        ]);
    }
}
