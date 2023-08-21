<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public static function getAccessByRole($id)
    {
        $role = $id;
        $menus = Menu::all();
        foreach ($menus as $key => $menu) {
            $default = new HakAkses;
            $default->id_role = $role;
            $default->id_menu = $menu->id;
            $default->read = false;
            $default->create = false;
            $default->update = false;
            $default->delete = false;
            $default->all_data = false;
            $access = HakAkses::where('id_menu', $menu->id)->where('id_role', $role)->first();
            if ($access == null) {
                $menu->access = $default;
            } else {
                $menu->access = $access;
            }
        }
        return $menus;
    }
}
