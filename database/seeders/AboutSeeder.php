<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('about')->insert([
            'image' => '1692332965.jpeg',
            'image2' => '1692332965.jpeg',
            'description' =>
                '<h2 style="margin-right: 0px; margin-bottom: 0.5em; margin-left: 0px; padding: 0px; line-height: 1.3em; overflow-wrap: normal; font-weight: 800; color: rgb(0, 0, 0); font-size: 2em; letter-spacing: -0.02em; font-family: &quot;Public Sans&quot;, Arial, sans-serif;">Rental Mobil Kupang Messi</h2><p style="margin-right: 0px; margin-bottom: 1.3em; margin-left: 0px; padding: 0px; font-family: &quot;Public Sans&quot;, Arial, sans-serif; font-size: 16px; text-align: justify;">Kami adalah rental mobil kupang yang profesional dengan driver berpengalaman dan armada mobil terbaru. Anda dapat menyewa mobil kami perjam, harian, mingguan, bulanan dan tahunan. Perjalanan seputar kupang dengan aman dan nyaman sangatlah mudah dengan Rental Mobil Kupang Messi, perusahaan sewa mobil kupang ini berdedikasi untuk menyediakan jasa transportasi berkualitas.</p><p style="margin-right: 0px; margin-bottom: 1.3em; margin-left: 0px; padding: 0px; font-family: &quot;Public Sans&quot;, Arial, sans-serif; font-size: 16px;">Kami menyediakan mobil sesuai dengan keperluan Anda seperti kepentingan kantor, bisnis, jalan jalan atau wisata dan keperluan lainnya.</p><p style="margin-right: 0px; margin-bottom: 1.3em; margin-left: 0px; padding: 0px; font-family: &quot;Public Sans&quot;, Arial, sans-serif; font-size: 16px;"><br></p><p style="margin-right: 0px; margin-bottom: 1.3em; margin-left: 0px; padding: 0px; font-family: &quot;Public Sans&quot;, Arial, sans-serif; font-size: 16px; text-align: justify;"><strong style="margin: 0px; padding: 0px;">MOBIL + BBM + DRIVER RATE AGENT</strong><br style="margin: 0px; padding: 0px;"><br style="margin: 0px; padding: 0px;">✅&nbsp;<strong style="margin: 0px; padding: 0px;">ALL NEW / GRAND AVANZA</strong><br style="margin: 0px; padding: 0px;">✅&nbsp;<strong style="margin: 0px; padding: 0px;">GRAND NEW INNOVA</strong><br style="margin: 0px; padding: 0px;">✅&nbsp;<strong style="margin: 0px; padding: 0px;">INNOVA REBORN</strong><br style="margin: 0px; padding: 0px;">✅&nbsp;<strong style="margin: 0px; padding: 0px;">FORTUNER TRD</strong><br style="margin: 0px; padding: 0px;">✅&nbsp;<strong style="margin: 0px; padding: 0px;">FORTUNER VRZ</strong><br style="margin: 0px; padding: 0px;">✅&nbsp;<strong style="margin: 0px; padding: 0px;">TOYOTA ALPHARD</strong><br style="margin: 0px; padding: 0px;">✅&nbsp;<strong style="margin: 0px; padding: 0px;">TOYOTA HIACE 15 set</strong><br style="margin: 0px; padding: 0px;"><br style="margin: 0px; padding: 0px;"></p><p style="margin-right: 0px; margin-bottom: 1.3em; margin-left: 0px; padding: 0px; font-family: &quot;Public Sans&quot;, Arial, sans-serif; font-size: 16px;">Jika Anda sedang mencari tempat rental mobil di kota kupang dan sekitarnya dengan harga dan pelayanan terbaik silahkan menghubungi kontak kami di bawah ini :</p><p style="margin-right: 0px; margin-bottom: 1.3em; margin-left: 0px; padding: 0px; font-family: &quot;Public Sans&quot;, Arial, sans-serif; font-size: 16px;">Rental Mobil Kupang Messi</p><p style="margin-right: 0px; margin-bottom: 1.3em; margin-left: 0px; padding: 0px; font-family: &quot;Public Sans&quot;, Arial, sans-serif; font-size: 16px;">Alamat : airnona jalan kelapa kecamatan kota raja kelurahan airnona</p><p style="margin-right: 0px; margin-bottom: 1.3em; margin-left: 0px; padding: 0px; font-family: &quot;Public Sans&quot;, Arial, sans-serif; font-size: 16px;">Email : renokadafuk10@gmail.com</p>',
        ]);
    }
}
