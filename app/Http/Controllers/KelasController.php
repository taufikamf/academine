<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Members;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KelasController extends Controller
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

        $kelas =  Kelas::join('users', 'users.id', '=', 'kelas.owner')->select('kelas.*', 'users.name')->get();
        $users = User::all();

        $class = Http::withHeaders([
            'Authorization' => "AIS {$token}"
        ])->get('http://127.0.0.1:8000/api/v1/class');
        $course = $class->json();

        return view('kelas.index', compact('kelas', 'users', 'course'));
    }

    public function store(Request $request)
    {
        $auth = Auth::user();
        $token = $auth->token;
        $data = json_decode($token, true);
        $token = $data['token'];

        $class = new Kelas;
        $class->nama_kelas = $request->nama_kelas;
        $class->deskripsi = $request->deskripsi;
        $class->kode = Str::random(rand(6, 10));
        $class->owner = Auth::user()->id;
        $class->save();
        $member = new Members;
        $member->classroom_id = $class->id;
        $member->user_id = Auth::user()->id;
        $member->save();

        $create_kelas = Http::withHeaders([
            'Authorization' => "AIS {$token}"
        ])->post('http://127.0.0.1:8000/api/v1/class/', [
            'class_type' => $request->nama_kelas,
        ]);

        return redirect('/kelas')->with('success', 'Kelas is successfully created');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('kelas.create');
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

    public function join(Request $request)
    {
        if ($request->kode) {
            $class = Kelas::where('kode', $request->kode)->first();
            if ($class != null) {
                if ($class->owner != Auth::user()->id) {
                    if (Members::where('classroom_id', $class->id)->where('user_id', Auth::user()->id)->first() == null) {
                        $member = new Members;
                        $member->classroom_id = Kelas::where('kode', $request->kode)->value('id');
                        $member->user_id = Auth::user()->id;

                        $member->save();
                        return redirect()->back()->with('sucess', 'Berhasil Bergabung !');
                    } else {
                        return redirect()->back()->with('failed', 'Anda Sudah Bergabung Ke Kelas Ini !');
                    }
                } else {
                    return redirect()->back()->with('failed', 'Pemilik Kelas Tidak Boleh Bergabung Ke Kelasnya Sendiri !');
                }
            } else {
                return redirect()->back()->with('failed', 'Kode Kelas Tidak Ditemukan !');
            }
        } else {
            return redirect()->back()->with('failed', 'Berhasil Bergabung !');
        }
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
