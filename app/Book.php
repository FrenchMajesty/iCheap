<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable
	 * @var array
	 */
    protected $fillable = ['isbn','price'];

    /**
     * The attributes that should be mutated to dates
     * @var array
     */
    protected $dates = ['created_at','updated_at','deleted_at'];

    /**
     * Get the orders associated with this user
     */
    public function orders()
    {
        return $this->hasMany('App\Desired\Order');
    }
}
