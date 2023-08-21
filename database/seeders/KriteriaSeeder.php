<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kriterias')->insert([
            'id_matkul' => 1,
            'nama' => 'Membuat Register',
        ]);

        DB::table('kriterias')->insert([
            'id_matkul' => 1,
            'nama' => 'Membuat Login',
        ]);

        DB::table('kriterias')->insert([
            'id_matkul' => 2,
            'nama' => 'Matriks',
        ]);

        DB::table('kriterias')->insert([
            'id_matkul' => 2,
            'nama' => 'Vector',
        ]);

        DB::table('kriterias')->insert([
            'id_matkul' => 3,
            'nama' => 'Membaca Al-Fatihah',
        ]);

        DB::table('kriterias')->insert([
            'id_matkul' => 3,
            'nama' => 'Membaca Yasin',
        ]);
    }
}
