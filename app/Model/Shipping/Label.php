<?php

namespace App\Model\Shipping;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Label extends Model
{	
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable
	 * @var array
	 */
    protected $fillable = [
    	'order_id',
    	'shippo_object_id',
    	'label_url',
    	'tracking_url',
    	'tracking_number',
        'arrived_at',
    ];

    /**
     * The attributes that should be mutated to dates
     * @var array
     */
    protected $dates = ['arrived_at','created_at','updated_at','deleted_at'];

    /**
     * Get the order that belongs to this shipping label
     */
    public function order()
    {
    	return $this->belongsTo('App\Model\Sell\Order');
    }
}
