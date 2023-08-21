<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatkulSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('matkuls')->insert([
            'nama' => 'Pemrograman Lanjut',
            'deskripsi' => 'Ini adalah mata kuliah Pemrograman Lanjut',
        ]);

        DB::table('matkuls')->insert([
            'nama' => 'Aljabar Linear',
            'deskripsi' => 'Ini adalah mata kuliah Aljabar Linear',
        ]);

        DB::table('matkuls')->insert([
            'nama' => 'Praktek Qiroah',
            'deskripsi' => 'Ini adalah mata kuliah Praktek Qiroah',
        ]);
    }
}
