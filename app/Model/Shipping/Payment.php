<?php

namespace App\Model\Shipping;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{	
	use SoftDeletes;

	/**
	 * The table associated with this model
	 * @var string
	 */
    protected $table = 'outgoing_payments_shippings';

    /**
     * The attributes that are mass assignable
     * @var array
     */
    protected $fillable = [
    	'order_id',
    	'shippo_object_id',
    	'tracking_url',
    	'tracking_number',
    	'label_url',
    ];

    /**
     * The attributes that should be mutated to dates
     * @var array
     */
    protected $dates = ['created_at','updated_at','deleted_at'];

    /**
     * Get the order for which this payment was sent out for
     */
    public function order()
    {
    	return $this->belongsTo('App\Model\Sell\Order');
    }
}
