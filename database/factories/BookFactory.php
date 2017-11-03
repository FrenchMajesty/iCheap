<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Book::class, function(Faker $faker) {

	return [
		'isbn' => $faker->randomNumber(10),
		'price' => $faker->randomFloat(2, 5, 10000),
	];
});

