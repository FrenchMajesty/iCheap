<?php

namespace App\Http\Controllers\Sell;

use App\Book;
use App\User;
use App\Model\Sell\Order;
use App\Model\Shipping;
use App\Events\Sell\Shipping\GenerateOrderLabel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Book $book Instance of the book to sell
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Book $book)
    {
        $user = User::find($request->user()->id);
        $toAddress = [
            'name' => env('SHIPPING_FROM_NAME'),
            'company' => env('SHIPPING_FROM_COMPANY'),
            'street1' => env('SHIPPING_FROM_STREET'),
            'city' => env('SHIPPING_FROM_CITY'),
            'zip' => env('SHIPPING_FROM_ZIP'),
            'state' => env('SHIPPING_FROM_STATE'),
            'country' => env('SHIPPING_FROM_COUNTRY'),
            'email' => env('SHIPPING_FROM_EMAIL'),
            'phone' => env('SHIPPING_FROM_PHONE'),
        ];

        $fromAddress = $user->address->shippoFormat;

        try {
            $data = Shipping\Label::generateLabel($book, $fromAddress, $toAddress);
        }catch (\Exception $e) {
            $errors = collect($e->jsonBody)->flatten()->implode(',');
            return back()->with('status', 'An error occured while generating your shipping label. ['.$errors.']');
        }

        if($data['status'] == 'SUCCESS') {

            $order = Order::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'book_tracking' => $data['tracking_number'],
                'status_id' => 1,
            ]);

            Shipping\Label::create([
                'order_id' => $order->id,
                'shippo_object_id' => $data['shipment_object_id'],
                'label_url' => $data['label_url'],
                'tracking_url' => $data['tracking_url_provider'],
                'tracking_number' => $data['tracking_number'],
            ]);

            event(new GenerateOrderLabel($order));
            return redirect($data['label_url']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Sell\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Sell\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Sell\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Sell\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
