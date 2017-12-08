<?php

namespace App\Model\Shipping;

use App\User;
use App\Book;
use App\Traits\Shipping\Shippable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Label extends Model
{	
	use SoftDeletes, Shippable;

    /**
     * The table associated with this model
     * @var string
     */
    protected $table = 'sell_shipping_labels';

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

    /**
     * Generate the cheapest shipping label for a book
     * @param  Book   $book        Book to be shipped
     * @param  array  $fromAddress The address the book is coming from
     * @param  array  $toAddress   The address the book is going to
     * @return array              Transaction and shipment informations
     */
    static public function generateLabel(Book $book, array $fromAddress, array $toAddress)
    {
        $package = [
            'height' => $book->dimensions->height,
            'width' => $book->dimensions->width,
            'length' => $book->dimensions->thickness,
            'distance_unit' => 'cm',
            'weight' => '3.5',
            'mass_unit' => 'lb',
        ];

        return self::ship($package, $fromAddress, $toAddress);
    }
}
