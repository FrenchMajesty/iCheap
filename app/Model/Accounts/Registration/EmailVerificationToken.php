<?php

namespace App\Model\Accounts\Registration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailVerificationToken extends Model
{	
	use SoftDeletes;

	/**
	 * The attributes that are mass assignable
	 * @var array
	 */
	protected $fillable = ['user_id','token'];

	/**
	 * The attributes to cast type to dates
	 * @var array
	 */
	protected $dates = ['created_at','updated_at','deleted_at'];

	/**
	 * Get the user to whom this registration token belongs to
	 */
	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
