<?php

namespace App\Model\Shipping;

use App\Traits\Shipping\Shippable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{	
	use SoftDeletes, Shippable;

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

    /**
     * Generate the cheapest shipping label for the check to be sent
     * @param  array  $fromAddress The address the book is coming from
     * @param  array  $toAddress   The address the book is going to
     * @return array              Transaction and shipment informations
     */
    static public function generateLabel(array $fromAddress, array $toAddress)
    {
        $package = [
            'height' => 22,
            'width' => 11,
            'length' => 0.3,
            'distance_unit' => 'cm',
            'weight' => 0.7,
            'mass_unit' => 'oz',
        ];

        return self::ship($package, $fromAddress, $toAddress);
    }
}
