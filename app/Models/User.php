<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Menu;
use App\Models\HakAkses;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'nomor_identitas',
        'role',
        'password',
        'backup_pass',
        'token'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAccess()
    {
        $role = \Auth::user()->role;
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
