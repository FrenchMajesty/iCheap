<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{	
	/**
	 * Search for a book for a user to sell
	 * @param  \Illuminate\Http\Request $request Request
	 * @return \Illuminate\Http\Response           Page
	 */
    public function searchForBookToSell(Request $request)
    {
    	$this->validate($request, [
    		'isbn' => 'required|exists:books',
    	]);

    	$book = Book::where('isbn', $request->isbn)->first();

    	return view('platform.search-results', compact('book'));
    }
}
