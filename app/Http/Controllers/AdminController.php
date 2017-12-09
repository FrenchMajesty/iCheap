<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Book;
use App\User;
use App\Book\BookDimensions;
use App\Model\Sell\Order;
use App\Model\Shipping;
use App\Model\Sell\OrderStatus;
use App\Events\Sell\Order\PaymentSent;
use App\Events\Sell\Order\BookReceived;
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
        $orders = Order::with('book')->get();
        $completed = Order::onlyTrashed()->get();
        return view('admin.orders', compact('orders', 'completed'));
    }

    /**
     * Show the management page for users
     * 
     * @return \Illuminate\Http\Response           
     */
    public function usersManager()
    {   
        $users = User::all();
        return view('admin.users', compact('users'));
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
     * Handle request to update an order for a desired book and mark it as received
     * @param  \Illuminate\Http\Request $request Request
     * @return void           
     */
    public function markOrderAsReceived(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric|exists:orders|reject_soft_deleted:orders',
            'tracking' => 'nullable|string|max:50',
        ]);

        $status = OrderStatus::where('code', 'SHIPMENT_RECEIVED')->first();
        $order = Order::find($request->id);
        $order->status_id = $status->id;
        $order->payment_tracking = $request->tracking;
        $order->received_at = Carbon::now();
        $order->save();

        event(new BookReceived($order));
    }

    /**
     * Handle request to update an order for a desired book and mark it as paid off
     * @param  \Illuminate\Http\Request $request Request
     * @return mixed           
     */
    public function markOrderAsPaid(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|numeric|exists:orders|reject_soft_deleted:orders',
            'amount' => 'required|max:10000',
        ]);

        $status = OrderStatus::where('code', 'PAYMENT_SENT')->first();
        $order = Order::find($request->id);
        $toAddress = $order->user->address->shippoFormat;

        try {
            $data = Shipping\Payment::generateLabel(null, $toAddress); // fromAddress's default is the company address
        }catch(\Exception $e) {
            $errors = collect($e->jsonBody)->flatten()->implode(',');

            return response()
                    ->json(['errors' => ['api' => [$errors]]], 422);
        }

        if($data['status'] == 'SUCCESS') {
            event(new PaymentSent($order, $data));

            $order->status_id = $status->id;
            $order->payment_amount = $request->amount;
            $order->paid_at = Carbon::now();
            $order->save();

            return $data;
        }
    }

}
