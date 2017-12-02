<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Book;
use App\Book\BookDimensions;
use App\Model\Sell\Order;
use App\Model\Sell\OrderStatus;
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
            'title' => 'required|max:200',
            'image' => 'required|url',
            'authors' => 'required|string|max:140',
            'publisher' => 'required|string|max:140',
            'description' => 'required|string|max:3000',
            'height' => 'required|numeric',
            'width' => 'required|numeric',
            'thickness' => 'required|numeric',
        ]);

        $book = Book::create([
            'isbn' => $request->isbn,
            'price' => $request->price,
            'title' => $request->title,
            'image' => $request->image,
            'authors' => $request->authors,
            'publisher' => $request->publisher,
            'description' => $request->description,
        ]);

        BookDimensions::create([
            'book_id' => $book->id,
            'height' => $request->height,
            'width' => $request->width,
            'thickness' => $request->thickness,
        ]);

        return $book;
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
            'amount' => 'required_if:status,PAYMENT_SENT|max:10000',
        ]);

        $status = OrderStatus::where('code', $request->status)->first();
        $order = Order::find($request->id);
        $order->status_id = $status->id;
        $order->payment_tracking = $request->tracking;

        if($status->code == 'SHIPMENT_RECEIVED') {
            $order->received_at = Carbon::now();
        }else if($status->code == 'PAYMENT_SENT') {
            $order->payment_amount = $request->amount;
            $order->delete();
        }

        $order->save();
    }

}
