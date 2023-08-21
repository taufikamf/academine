<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Nilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Matkul;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $auth = Auth::user();
        $token = $auth->token;
        $data = json_decode($token, true);
        $token = $data['token'];

        $search = $request->input('search');

        $nilai = Nilai::query();

        // $nilai = DB::table('nilais')
        // ->join('matkuls', 'nilais.id_matkul', '=', 'matkuls.id')
        // ->join('kriterias', 'nilais.id_kriteria', '=', 'kriterias.id')
        // ->join('users','nilais.id_user','=','users.id')
        // ->select('nilais.*','users.name as nama_user' ,'matkuls.nama as nama_matkul','kriterias.nama as nama_kriteria')
        // ->get();

        if ($search) {
            $user = User::query();
            $user->where('name', 'ilike', '%' . $search . '%');
            $id_user = $user->pluck('id');
            //dd($id_user);
            $nilai = $nilai->whereIn('id_user', $id_user)->get();
            return view('nilai.index', compact('nilai'));
        } else {
            $nilai = Nilai::all();
        }

        $nilai_data =  Http::withHeaders([
            'Authorization' => "AIS {$token}"
        ])->get('http://127.0.0.1:8000/api/v1/course/grade');
        $nilai_data = $nilai_data->json();

        return view('nilai.index', compact('nilai', 'nilai_data'));
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

        $matkul = Matkul::pluck('nama', 'id');
        $user = User::pluck('name', 'id');
        $mahasiswa =  Http::withHeaders([
            'Authorization' => "AIS {$token}"
        ])->get('http://127.0.0.1:8000/api/v1/user/list?role=MAHASISWA');

        $mahasiswa = $mahasiswa->json();
        return view('nilai.create', compact('matkul', 'user', 'mahasiswa'));
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
            'id_matkul' => 'required',
            'nilai' => 'required',
            'id_user' => 'required'
        ]);

        $create_nilai = Http::withHeaders([
            'Authorization' => "AIS {$token}"
        ])->post('http://127.0.0.1:8000/api/v1/course/grade', [
            'course' => $validatedData['id_matkul'],
            'student' => $validatedData['id_user'],
            'value' => $validatedData['nilai'],
        ]);
        $result = $create_nilai->json();
        $validatedData['grade'] = $result['grade'];
        $show = Nilai::create($validatedData);

        return redirect('/nilai')->with('success', 'Nilai is successfully created');
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
        $nilai = Nilai::findOrFail($id);
        $matkul = Matkul::pluck('nama', 'id');
        $user = User::pluck('name', 'id');
        $kriteria = Kriteria::where('id_matkul', $nilai->id_matkul)->pluck('nama', 'id');
        return view('nilai.edit', compact('matkul', 'nilai', 'user', 'kriteria'));
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
            'id_matkul' => 'required',
            'nilai' => 'required',
            'id_user' => 'required',
        ]);
        Nilai::whereId($id)->update($validatedData);

        return redirect('/nilai')->with('success', 'Data Nilai is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $nilai = Nilai::findOrFail($id);
        $nilai->delete();

        return redirect('/nilai')->with('success', 'Nilai Data is successfully deleted');
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $nilai = DB::table('nilais')
            ->join('matkuls', 'nilais.id_matkul', '=', 'matkuls.id')
            ->join('kriterias', 'nilais.id_kriteria', '=', 'kriterias.id')
            ->select('nilais.*', 'matkuls.nama as nama_matkul', 'kriterias.nama as nama_kriteria')
            ->get();
        $search = "Fariz";

        $users = $nilai->where('country', 'LIKE', '%' . $keyword . '%');
        dd($users);
    }
}
