<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
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

        $assignment = Http::withHeaders([
            'Authorization' => "AIS {$token}"
        ])->get('http://127.0.0.1:8000/api/v1/course/assignment');

        $assignment = $assignment->json();

        return view('assignment.index', compact('assignment'));
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

        $course = Http::withHeaders([
            'Authorization' => "AIS {$token}"
        ])->get('http://127.0.0.1:8000/api/v1/course');

        $course = $course->json();
        return view('assignment.create', compact('course'));
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
            'deskripsi' => 'required',
            'deadline' => 'required',
            'id_matkul' => 'required',
        ]);

        $create_matkul = Http::withHeaders([
            'Authorization' => "AIS {$token}"
        ])->post('http://127.0.0.1:8000/api/v1/course/assignment', [
            'name' => $validatedData['nama'],
            'description' => $validatedData['deskripsi'],
            'deadline' => $validatedData['deadline'],
            'course' => $validatedData['id_matkul'],
        ]);

        return redirect('/assignment')->with('success', 'Tugas is successfully created');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
