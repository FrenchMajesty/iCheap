<?php

namespace App\Http\Controllers;

use App\Book;
use App\Desired\Order;
use App\Desired\OrderStatus;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        $this->middleware('isAdmin');
    }

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
     * 
     * @return \Illuminate\Http\Response           
     */
   	public function booksManager()
   	{	
   		$books = Book::all();
   		return view('admin.books', compact('books'));
   	}

    /**
     * Show the management page for orders
     * 
     * @return \Illuminate\Http\Response           
     */
    public function ordersManager()
    {
        $orders = Order::all();
        $completed = Order::onlyTrashed()->get();
        return view('admin.orders', compact('orders', 'completed'));
    }

    /**
     * Handle request to delete a desired book
     * @param int $id The book's ID
     * @return void           
     */
    public function deleteDesiredBook(int $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
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

    /**
     * Handle request to update a desired book
     * @param  \Illuminate\Http\Request $request Request
     * @return void           
     */
    public function updateDesiredBook(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric|exists:books|reject_soft_deleted:books',
            'price' => 'required|numeric|min:5|max:10000',
        ]);

        $book = Book::find($request->id);
        $book->price = $request->price;
        $book->save();
    }

    /**
     * Handle request to update an order for a desired book
     * @param  \Illuminate\Http\Request $request Request
     * @return void           
     */
    public function updateOrder(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric|exists:orders|reject_soft_deleted:orders',
            'status' => 'required|string|exists:desired_books_order_status,code',
            'tracking' => 'nullable|string|max:50',
        ]);

        $status = OrderStatus::where('code', $request->status)->first();
        $order = Order::find($request->id);
        $order->status_id = $status->id;
        $order->payment_tracking = $request->tracking;
        $order->save();
    }

}
