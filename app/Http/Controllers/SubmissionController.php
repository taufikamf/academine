<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
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

        $submission = Http::withHeaders([
            'Authorization' => "AIS {$token}"
        ])->get('http://127.0.0.1:8000/api/v1/course/submission');

        $submission = $submission->json();

        return view('submission.index', compact('submission'));
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

        $assignment = Http::withHeaders([
            'Authorization' => "AIS {$token}"
        ])->get('http://127.0.0.1:8000/api/v1/course/assignment');

        $assignment = $assignment->json();

        $user = Http::withHeaders([
            'Authorization' => "AIS {$token}"
        ])->get('http://127.0.0.1:8000/api/v1/user/list?role=MAHASISWA');

        $user = $user->json();

        return view('submission.create', compact('submission', 'assignment', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $response = Http::asForm()->post('http://example.com/users', [
            'name' => 'Sara',
            'role' => 'Privacy Consultant',
        ]);
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
