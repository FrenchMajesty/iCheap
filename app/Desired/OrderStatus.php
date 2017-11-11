<?php

namespace App\Desired;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{	
	/**
	 * The name of the table for this model
	 * @var string
	 */
	protected $table = 'desired_books_order_status';

	/**
	 * The attributes that are mass assignable
	 * @var array
	 */
    protected $fillable = ['code','name'];

    /**
     * The attributes that should be mutated to dates
     * @var array
     */
    protected $dates = ['created_at','updated_at'];

    /**
     * Get all the orders who are at this current stage
     */
    public function currentOrders()
    {
    	return $this->hasMany('App\Desired\Order','status_id');
    }
}
