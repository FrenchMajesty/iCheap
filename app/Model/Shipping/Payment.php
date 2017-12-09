<?php

namespace App\Model\Shipping;

use Shippo_Address;
use Shippo_Object;
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
        'arrived_at',
    ];

    /**
     * The attributes that should be mutated to dates
     * @var array
     */
    protected $dates = ['arrived_at','created_at','updated_at','deleted_at'];

    /**
     * Get the order for which this payment was sent out for
     */
    public function order()
    {
    	return $this->belongsTo('App\Model\Sell\Order');
    }

    /**
     * Generate the cheapest shipping label for the check to be sent
     * @param  Shippo_Object|null  $fromAddress The address the book is coming from or null
     * @param  Shippo_Object  $toAddress   The address the book is going to
     * @return array              Transaction and shipment informations
     */
    static public function generateLabel($fromAddress, Shippo_Object $toAddress)
    {
        $from = $fromAddress ?: Shippo_Address::create([
            'name' => env('SHIPPING_FROM_NAME'),
            'company' => env('SHIPPING_FROM_COMPANY'),
            'street1' => env('SHIPPING_FROM_STREET'),
            'city' => env('SHIPPING_FROM_CITY'),
            'zip' => env('SHIPPING_FROM_ZIP'),
            'state' => env('SHIPPING_FROM_STATE'),
            'country' => env('SHIPPING_FROM_COUNTRY'),
            'email' => env('SHIPPING_FROM_EMAIL'),
            'phone' => env('SHIPPING_FROM_PHONE'),
            'validate' => true,
        ]);
        
        $package = [
            'height' => 22,
            'width' => 11,
            'length' => 0.3,
            'distance_unit' => 'cm',
            'weight' => 0.7,
            'mass_unit' => 'oz',
        ];
        
        return self::ship($package, $from, $toAddress);
    }
}
