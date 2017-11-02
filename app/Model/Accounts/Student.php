<?php

namespace App\Model\Accounts;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'street1', 'street2', 'city', 'zip',
    ];
}
