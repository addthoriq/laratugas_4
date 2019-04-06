<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinsisTableSeeder extends Seeder
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
                'name'          => 'Daerah Istimewa Yogyakarta',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Jawa Tengah',
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'          => 'Kalimantan Timur',
                'created_at'    => now(),
                'updated_at'    => now(),
            ]
        ];
        DB::table('provinsis')->truncate();
        DB::table('provinsis')->insert($data);
    }
}
