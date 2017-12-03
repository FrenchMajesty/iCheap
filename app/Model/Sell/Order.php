<?php

namespace App\Model\Sell;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
	use SoftDeletes;

    /**
     * The attributes that are mass assignables
     * @var array
     */
    protected $fillable = [
        'user_id',
        'book_id',
        'book_tracking',
        'book_shipping_tracking_url',
        'payment_tracking',
        'payment_shipping_tracking_url',
        'payment_amount',
        'status_id',
        'received_at',
    ];

    /**
     * The attributes that should be mutated to dates
     * @var array
     */
    protected $dates = ['received_at','created_at','updated_at','deleted_at'];

    /**
     * Get the user associated with this order
     */
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    /**
     * Get the book associated with this order
     */
    public function book()
    {
    	return $this->belongsTo('App\Book');
    }

    /**
     * Get the shipping label associated with this order
     */
    public function shippingLabel()
    {
        return $this->hasOne('App\Model\Shipping\Label');
    }

    /**
     * Get the current status of the order
     */
    public function status()
    {
        return $this->belongsTo('App\Model\Sell\OrderStatus','status_id');
    }
}
