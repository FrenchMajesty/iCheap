<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show the application index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.index');
    }

    /**
     * Show the management page for books
     * @param  \Illuminate\Http\Request $request Request
     * @return \Illuminate\Http\Response           
     */
   	public function booksManager(Request $request)
   	{	
   		$books = Book::all();
   		return view('admin.books', compact('books'));
   	}
}
