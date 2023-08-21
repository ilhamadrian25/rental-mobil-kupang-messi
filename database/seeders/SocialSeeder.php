<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('social_media')->insert([
            'name' => 'Facebook',
            'url' => 'https://facebook.com/facebook',
        ]);
        DB::table('social_media')->insert([
            'name' => 'YouTube',
            'url' => 'https://youtube.com/youtube',
        ]);
        DB::table('social_media')->insert([
            'name' => 'Instagram',
            'url' => 'https://instagram.com/instagram',
        ]);
    }
}
