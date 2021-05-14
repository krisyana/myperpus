<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Rent;
use App\Models\User;
use Illuminate\Http\Request;

class RentController extends Controller
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
        //index page
        return view('rents.index', ['rents' => Rent::with('user', 'book')->get()]);
    }

    /**
     * Display a listing of the resource to dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        //dashboard page
        return view('dashboard', ['rents' => Rent::with('user', 'book')->get()]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('rents.create', ['books' => Book::all(), 'users' => User::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //make new rent with book and user
        Rent::create([
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'rent_at' => $request->rent_at,
            'return_at' => $request->return_at,
            'status' => 'pending',
        ]);
        Book::where('id', $request->book_id)->decrement('sum', 1);

        return redirect(route('rents.index'))->with('status', 'Rent created!');
    }

    /**
     * Update the rent resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function rent($id)
    {
        $rent = Rent::findOrFail($id);
        Book::where('id', $rent->book_id)->decrement('sum', 1);
    }
    /**
     * Return book logic.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function return($id)
    {
        $rent = Rent::findOrFail($id);
        $rent->update('status', 'done');
        Book::where('id', $rent->book_id)->increment('sum', 1);
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
        return view('rents.create')->with(['rent' => Rent::findorFail($id), 'books' => Book::all(), 'users' => User::all()]);
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
        $rent = Rent::findorFail($id);
        $rent->update([
            'book_id' => $request->book_id,
            'user_id' => $request->user_id,
            'rent_at' => $request->rent_at,
            'rerurn_at' => $request->return_at,
            'status' => $request->status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //delete rent by id
        $rent = Rent::findorFail($id);
        $rent->delete();
        return redirect(route('rents.index'))->with('status', 'Rent deleted!');
    }
}
