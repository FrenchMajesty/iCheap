<?php

namespace App\Book;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookDimensions extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that are mass assignables
	 * @var array
	 */
    protected $fillable = ['book_id','height','width','thickness','weight'];

    /**
     * The attributes that should be mutated to dates
     * @var array
     */
    protected $dates = ['created_at','updated_at','deleted_at'];

    /**
     * Get the book associated with this dimensions model
     */
    public function book()
    {
        return $this->belongsTo('App\Book');
    }
}
