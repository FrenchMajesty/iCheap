<?php

namespace App;

use App\Model\Accounts\Address;
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
        return $this->hasMany('App\Model\Sell\Order');
    }

    /**
     * Get the completed orders associated with this user
     */
    public function ordersDone()
    {
        return $this->hasMany('App\Model\Sell\Order')->onlyTrashed();
    }

    /**
     * Create an address instance for this user
     * @param array $value Address components
     */
    public function setAddressAttribute(array $value)
    {
        if($this->id) {
            Address::create([
                'user_id' => $this->id,
                'address' => $value['address_1'],
                'address_2' => $value['address_2'],
                'city' => $value['city'],
                'state' => $value['state'],
                'zip' => $value['zip'],
                'country' => $value['country'],
            ]);
        }
    }
}
