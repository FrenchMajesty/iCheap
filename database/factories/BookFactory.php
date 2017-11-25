<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Book::class, function(Faker $faker) {

	return [
		'isbn' => $faker->isbn10,
		'price' => $faker->randomFloat(2, 5, 10000),
		'title' => $faker->sentence,
		'authors' => $faker->name,
		'publisher' => $faker->sentence,
		'image' => $faker->imageUrl(),
	];
});

