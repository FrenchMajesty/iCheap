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
    ];
}
