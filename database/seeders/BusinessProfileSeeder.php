<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class BusinessProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('business_profiles')->insert([
            'nama_usaha' => 'Toast.district',
            'deskripsi_usaha' => 'Spesialis roti toast kekinian dengan pilihan varian manis dan asin yang dibuat fresh setiap hari.',
            'alamat' => 'Kota Kediri, Jawa Timur',
            'jam_operasional' => 'Senin - Minggu, 10.00 - 22.00 WIB',
            'no_whatsapp' => '+62 852-3204-9199',
            'no_wa_sponsorship' => '+62 852-3204-9199',
            'pesan_default_sponsorship' => 'Halo Toast.district, kami tertarik untuk mengajukan kerja sama sponsorship acara.',
            'link_maps' => 'https://share.google/4CLo2bwQs0Di09MrX',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
