<?php

use App\User;
use App\Model\Accounts\Address;
use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Address::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'address' => '20 Main Street',
        'address_2' => 'Suite 569',
        'city' => 'San Francisco',
        'zip' => 94105,
        'state' => 'CA',
        'country' => 'United States',
    ];
});
