<?php

namespace App;

use App\Book\BookDimensions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable
	 * @var array
	 */
    protected $fillable = [
        'isbn',
        'price',
        'title',
        'image',
        'authors',
        'publisher',
        'description',
    ];

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

    /**
     * Set the book dimensions and create an entry
     * @param array $value Book's dimensions
     */
    public function setDimensionsAttribute(array $value)
    {
        if($this->id) {
            $params = collect($value)->put('book_id' => $this->id);
            BookDimensions::create($params->toArray());
        }
    }
}
