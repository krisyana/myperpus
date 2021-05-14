<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * listiong of middleware this controller use.
     *
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        User::create([
            'name' => $request->name,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'email' => $request->email,
            'password' => 'password',
        ]);
        return redirect(route('users.index'))->with('status', 'User created!');
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
        return view('users.create')->with('user', User::findorFail($id));
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
        //update user by id
        $user = User::findorFail($id);

        $user->update([
            'name' => $request->name,
            'kelas' => $request->kelas,
            'jurusan' => $request->jurusan,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return redirect(route('users.index'))->with('status', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete user with id
        $user = User::findorFail($id);
        $user->delete();
        return redirect(route('users.index'))->with('status', 'User deleted!');
    }
}
