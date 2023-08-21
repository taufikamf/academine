<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MahasiswaController extends Controller
{
    public function index()
    {
    }

    public function fill($token)
    {
        $token = $token;
        $matkul = Matkul::all();
        $course = Http::withHeaders([
            'Authorization' => "AIS {$token}"
        ])->get('http://127.0.0.1:8000/api/v1/course');

        $course = $course->json();
        return view('krs.create', compact('token', 'course'));
    }

    public function post(Request $request)
    {
    }
}
