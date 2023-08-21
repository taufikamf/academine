<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Matkul;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kriteria = Kriteria::all();
        return view('kriteria.index',compact('kriteria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $matkul = Matkul::pluck('nama', 'id');
        return view('kriteria.create', compact('matkul'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_matkul' => 'required',
            'nama' => 'required',
        ]);
        $show = Kriteria::create($validatedData);
   
        return redirect('/kriteria')->with('success', 'Kriteria is successfully created');
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
        $kriteria = Kriteria::findOrFail($id);
        $matkul = Matkul::pluck('nama', 'id');
        return view('kriteria.edit', compact('kriteria','matkul'));
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
            'id_matkul' => 'required'
        ]);
        Kriteria::whereId($id)->update($validatedData);

        return redirect('/kriteria')->with('success', 'Data kriteria is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();

        return redirect('/kriteria')->with('success', 'Kriteria Data is successfully deleted');
    }
}
