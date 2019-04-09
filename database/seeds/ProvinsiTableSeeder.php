<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsiTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data   = [
            [
                'nama'      => 'Daerah Istimewa Yogyakarta',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'nama'      => 'Jawa Tengah',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
            [
                'nama'      => 'Kalimantan Timur',
                'created_at'      => now(),
                'updated_at'      => now(),
            ],
        ];
        DB::table('provinsi')->truncate();
        DB::table('provinsi')->insert($data);
    }
}
