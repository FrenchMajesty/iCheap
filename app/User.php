<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'email_verified',
        'password',
        'account',
        'photo',
        'address',
        'rank',
        'remember_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

     /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at','updated_at','deleted_at'];

    /**
     * The attributes that should be casted to native types.
     * @var array
     */
    protected $casts = [
        'email_verified' => 'boolean',
    ];

    /**
     * Get the orders associated with this user
     */
    public function orders()
    {
        return $this->hasMany('App\Desired\Order');
    }

    /**
     * Get the completed orders associated with this user
     */
    public function ordersDone()
    {
        return $this->hasMany('App\Desired\Order')->onlyTrashed();
    }
}
