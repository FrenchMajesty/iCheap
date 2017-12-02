<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;

    return [
        'firstname' => $faker->firstname,
        'lastname' => $faker->lastname,
        'email' => $faker->unique()->safeEmail,
        'email_verified' => true,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'account' => 'student',
        'rank' => 1,
        'photo' => $faker->imageUrl(),
        'address' => [
            'address_1' => $faker->streetAddress,
            'address_2' => $faker->secondaryAddress,
            'city' => $faker->city,
            'zip' => $faker->postcode,
            'state' => $faker->stateAbbr,
            'country' => $faker->country,
        ],
    ];
});
