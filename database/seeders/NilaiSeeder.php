<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('nilais')->insert([
            'id_matkul' => 1,
            'nilai' => 90.00,
            'id_user' => 3,
            'id_kriteria' => 1,
        ]);

        DB::table('nilais')->insert([
            'id_matkul' => 1,
            'nilai' => 82.00,
            'id_user' => 3,
            'id_kriteria' => 2,
        ]);

        DB::table('nilais')->insert([
            'id_matkul' => 3,
            'nilai' => 85.00,
            'id_user' => 3,
            'id_kriteria' => 4,
        ]);

        DB::table('nilais')->insert([
            'id_matkul' => 3,
            'nilai' => 90.00,
            'id_user' => 3,
            'id_kriteria' => 3,
        ]);
    }
}
