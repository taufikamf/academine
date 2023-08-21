<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\HakAkses;

class HakAksesController extends Controller
{
    public function index()
    {
        $roles = collect([
            (object) [
                'id' => 1,
                'name' => 'Administrator'
            ],
            (object) [
                'id' => 2,
                'name' => 'Dosen'
            ],
            (object) [
                'id' => 3,
                'name' => 'Mahasiswa'
            ]
        ]);
        return view('hak-akses.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|unique:users,email',
        //     'password' => 'required',
        //     'nomor_identitas' => 'required',
        //     'role' => 'required|integer'
        // ]);
        // $validatedData['password'] = Hash::make($validatedData['password']);
        // $show = User::create($validatedData);
   
        // return redirect('/user')->with('success', 'User is successfully created');
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
        $role = $id;
        $menus = Menu::getAccessByRole($role);

        return view('hak-akses.edit', compact('role', 'menus'));
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
        $menu = $request->menu;
        // dd((boolean)$menu[0]["'all_data'"]["'value'"]);
        // dd($menu);
        for ($i=0; $i < count($menu); $i++) { 
            $akses = HakAkses::find($menu[$i]["'id_akses'"]);
            if ($akses == null) {
                $akses = new HakAkses;
                $akses->id_role = $id;
                $akses->id_menu = $menu[$i]["'id'"];
            }
            $akses->read = !empty($menu[$i]["'read'"]["'value'"]) ? (boolean)$menu[$i]["'read'"]["'value'"] : false;
            $akses->create = !empty($menu[$i]["'create'"]["'value'"]) ? (boolean)$menu[$i]["'create'"]["'value'"] : false;
            $akses->update = !empty($menu[$i]["'update'"]["'value'"]) ? (boolean)$menu[$i]["'update'"]["'value'"] : false;
            $akses->delete = !empty($menu[$i]["'delete'"]["'value'"]) ? (boolean)$menu[$i]["'delete'"]["'value'"] : false;
            $akses->all_data = !empty($menu[$i]["'all_data'"]["'value'"]) ? (boolean)$menu[$i]["'all_data'"]["'value'"] : false;
            $akses->save();
        }
        // $validatedData = $request->validate([
        //     'name' => 'required',
        //     'email' => 'required|unique:users,email,'.$id,
        //     'password' => 'required',
        //     'nomor_identitas' => 'required',
        //     'role' => 'required|integer'
        // ]);
        // User::whereId($id)->update($validatedData);

        return redirect('/hak-akses')->with('success', 'Access role is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $user = User::findOrFail($id);
        // $user->delete();

        // return redirect('/user')->with('success', 'User Data is successfully deleted');
    }
}
