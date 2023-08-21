<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = ['id_matkul','nama'];

    public function matkul() {
        return $this->hasOne(Matkul::class, 'id', 'id_matkul');
    }
}
