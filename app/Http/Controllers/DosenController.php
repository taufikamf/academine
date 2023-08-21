<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function show_class($id)
    {
        $class_id = $id;

        return view('kelas.detail');
    }
}
