<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Book\BookDimensions::class, function (Faker $faker) {
    return [
    	'book_id' => factory(App\Book::class)->create()->id,
    	'height' => $faker->randomFloat(),
		'width' => $faker->randomFloat(),
		'thickness' => $faker->randomFloat(),
		'weight' => null,
    ];
});
