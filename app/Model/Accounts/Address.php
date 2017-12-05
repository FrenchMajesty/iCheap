<?php

namespace App\Model\Accounts;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{	
	/**
	 * The attributes that are mass assignable
	 * @var array
	 */
	protected $fillable = [
		'user_id',
		'address',
		'address_2',
		'city',
		'state',
		'zip',
		'country',
	];

	/**
	 * Get the user associated with this address model
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}

	/**
	 * Return the complete address fully assembled
	 * @return string Address
	 */
	public function getFormattedAttribute()
	{
		return implode(' ', [
			$this->address, 
			$this->address_2, 
			',',
			$this->city, 
			$this->zip,
			$this->state,
			$this->country,
		]);
	}
}
