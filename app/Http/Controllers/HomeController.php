<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //controller for home and logic behind it
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request()->query('search');
        if ($search) {
            $books = Book::where('title', 'like', "%{$search}%")->orWhere('author', 'LIKE', "%{$search}%")->paginate(15);
        } else {
            $books = Book::paginate(15);
        }

        return view('welcome', ['books' => $books]);
    }

    public function show($id)
    {
        return view('books.show')->with('book', Book::findOrFail($id));
    }

    public function category($id)
    {
        $category = Category::findorFail($id);
        return view('library.category')
            ->with('category', $category)
            ->with('book', $category->book()->searched()->simplePaginate(3))
            ->with('categories', Category::all());
    }
}