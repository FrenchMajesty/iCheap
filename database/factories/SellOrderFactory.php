<?php

use Faker\Generator as Faker;
use App\Model\Sell\Order;
use App\Model\Sell\OrderStatus;
use App\User;
use App\Book;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Order::class, function (Faker $faker) {
    return [
    	'user_id' => factory(User::class)->create()->id,
    	'book_id' => factory(Book::class)->create()->id,
    	'book_tracking' => $faker->text(12),
    	'status_id' => factory(OrderStatus::class)->create()->id,
    ];
});

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(OrderStatus::class, function (Faker $faker) {
    return [
    	'code' => $faker->word,
    	'name' => $faker->sentence,
    ];
});
