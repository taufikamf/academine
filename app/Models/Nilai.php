<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = ['id_matkul', 'nilai', 'id_user', 'grade'];

    public function matkul()
    {
        return $this->hasOne(Matkul::class, 'id', 'id_matkul');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'id_user');
    }
}
