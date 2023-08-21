<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('user.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
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
            'name' => 'required',
            'username' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'nomor_identitas' => 'required',
            'role' => 'required|integer'
        ]);

        $role  = ['', 'ADMIN', 'DOSEN', 'MAHASISWA'];

        $register = Http::withHeaders([
            'Authorization' => "AIS {$token}"
        ])->post('http://127.0.0.1:8000/api/v1/user/registration', [
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'password' => $validatedData['password'],
            'no_identity' => $validatedData['nomor_identitas'],
            'role' => $role[$validatedData['role']],
        ]);

        $ais = $register['token'];

        if ($register->successful()) {
            $updateProfile = Http::withHeaders([
                'Authorization' => "AIS {$ais}"
            ])->patch('http://127.0.0.1:8000/api/v1/user/', [
                'fullname' => $validatedData['name'],
                'no_identity' => $validatedData['nomor_identitas'],
                'role' => $role[$validatedData['role']],
                'password' => $validatedData['password'],
            ]);
            $validatedData['password'] = Hash::make($validatedData['password']);
            $validatedData['backup_pass'] = $validatedData['password'];
            $validatedData['token'] = 's';

            $show = User::create($validatedData);
            return redirect('/user')->with('success', 'User is successfully created');
        } else {
            return redirect('/user/create')->with('error', 'Something went wrong');
        }
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
        $user = User::findOrFail($id);

        return view('user.edit', compact('user'));
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
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'username' => 'required',
            'password' => 'required',
            'nomor_identitas' => 'required',
            'role' => 'required|integer'
        ]);
        User::whereId($id)->update($validatedData);

        return redirect('/user')->with('success', 'Data User is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/user')->with('success', 'User Data is successfully deleted');
    }

    public function login(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ]);

        $response = Http::post('http://127.0.0.1:8000/api/v1/user/login', [
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ]);

        $token = $response->json()['token'];
    }
}
