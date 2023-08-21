<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Menu;

class HakAksesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = Menu::all();
        foreach ($menus as $key => $value) {
            DB::table('hak_akses')->insert([
                'id_role' => 1,
                'id_menu' => $value->id,
                'read' => true,
                'create' => true,
                'update' => true,
                'delete' => true,
                'all_data' => true,
            ]);
            DB::table('hak_akses')->insert([
                'id_role' => 2,
                'id_menu' => $value->id,
                'read' => false,
                'create' => false,
                'update' => false,
                'delete' => false,
                'all_data' => false,
            ]);
            DB::table('hak_akses')->insert([
                'id_role' => 1,
                'id_menu' => $value->id,
                'read' => false,
                'create' => false,
                'update' => false,
                'delete' => false,
                'all_data' => false,
            ]);
        }
    }
}
