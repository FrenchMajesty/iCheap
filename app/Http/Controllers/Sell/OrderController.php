<?php

namespace App\Http\Controllers\Sell;

use App\Book;
use App\User;
use App\Model\Sell\Order;
use App\Model\Shipping;
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
        $fromAddress = [
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

        $user = User::find($request->user()->id);
        $toAddress = [
            'name' => $user->firstname.' '.$user->lastname,
            'email' => $user->email,
            'street1' => $user->address->address,
            'street2' => $user->address->address_2,
            'city' => $user->address->city,
            'state' => $user->address->state,
            'zip' => $user->address->zip,
            'country' => $user->address->country,
        ];

        $package = [
            'height' => $book->dimensions->height,
            'width' => $book->dimensions->width,
            'length' => $book->dimensions->thickness,
            'distance_unit' => 'cm',
            'weight' => '3.5',
            'mass_unit' => 'lb',
        ];

        try {
            $shipment = \Shippo_Shipment::create([
                'address_from' => $fromAddress,
                'address_to' => $toAddress,
                'parcels' => [$package],
                'async' => false,
            ]);

            $rate = collect($shipment['rates'])->sortBy('amount')->first();

            $transaction = \Shippo_Transaction::create([
                'rate' => $rate['object_id'],
                'async' => false,
            ]);
        }catch (\Exception $e) {
            $errors = collect($e->jsonBody)->flatten()->implode(',');
            return back()->with('status', 'An error occured while generating your shipping label. ['.$errors.']');
        }

        if($transaction['status'] == 'SUCCESS') {

            $order = Order::create([
                'user_id' => $request->user()->id,
                'book_id' => $book->id,
                'book_tracking' => $transaction['tracking_number'],
                'status_id' => 1,
            ]);

            Shipping\Label::create([
                'order_id' => $order->id,
                'shippo_object_id' => $shipment['object_id'],
                'label_url' => $transaction['label_url'],
                'tracking_url' => $transaction['tracking_url_provider'],
                'tracking_number' => $transaction['tracking_number'],
            ]);

            return redirect($transaction['label_url']);
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
