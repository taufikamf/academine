<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user();
        $token = $auth->token;
        $data = json_decode($token, true);
        $token = $data['token'];

        $matkul = Matkul::all();
        $course = Http::withHeaders([
            'Authorization' => "AIS {$token}"
        ])->get('http://127.0.0.1:8000/api/v1/course');

        $course = $course->json();
        return view('matkul.index', compact('matkul', 'course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $auth = Auth::user();
        $token = $auth->token;
        $data = json_decode($token, true);
        $token = $data['token'];

        $kelas =  Http::withHeaders([
            'Authorization' => "AIS {$token}"
        ])->get('http://127.0.0.1:8000/api/v1/class');

        $user =  Http::withHeaders([
            'Authorization' => "AIS {$token}"
        ])->get('http://127.0.0.1:8000/api/v1/user/list?role=DOSEN');


        $user = $user->json();
        $kelas = $kelas->json();
        return view('matkul.create', compact('kelas', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $auth = Auth::user();
        $token = $auth->token;
        $data = json_decode($token, true);
        $token = $data['token'];

        $validatedData = $request->validate([
            'nama' => 'required',
            'id_dosen' => 'required',
            'id_kelas' => 'required',
            'sks' => 'required',
            'begin_time' => 'required',
            'deskripsi' => 'required'
        ]);

        $create_matkul = Http::withHeaders([
            'Authorization' => "AIS {$token}"
        ])->post('http://127.0.0.1:8000/api/v1/course/', [
            'name' => $validatedData['nama'],
            'teacher' => $validatedData['id_dosen'],
            '_class' => $validatedData['id_kelas'],
            'sks' => $validatedData['sks'],
            'begin_time' => $validatedData['begin_time'],
        ]);

        $show = Matkul::create($validatedData);

        return redirect('/matkul')->with('success', 'Matkul is successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $matkul = Matkul::findOrFail($id);
        return view('matkul.edit', compact('matkul'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'deskripsi' => 'required',
        ]);
        Matkul::whereId($id)->update($validatedData);

        return redirect('/matkul')->with('success', 'Data matkul is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $matkul = Matkul::findOrFail($id);
        $matkul->delete();

        return redirect('/matkul')->with('success', 'Matkul Data is successfully deleted');
    }
}
