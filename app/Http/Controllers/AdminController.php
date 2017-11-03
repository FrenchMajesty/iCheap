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
     * Show the page to add a new desired book
     *
     * @return \Illuminate\Http\Response 
     */
    public function addDesiredBook()
    {
      return view('admin.add.desired-book');
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

    /**
     * Handle request to create a new desired book
     * @param  \Illuminate\Http\Request $request Request
     * @return \App\Book           
     */
    public function createDesiredBook(Request $request) 
    {
      $this->validate($request, [
        'isbn' => 'required|string|min:8|max:15|unique:books',
        'price' => 'required|numeric|min:5|max:10000',
      ]);

      return Book::create([
        'isbn' => $request->isbn,
        'price' => $request->price,
      ]);
    }

}
