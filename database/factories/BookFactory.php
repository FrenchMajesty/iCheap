<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Book::class, function(Faker $faker) {

	return [
		'isbn' => $faker->random()->number,
		'price' => $faker->commerce()->price,
	];
});

