<?php

use App\Model\Shipping\Label;
use App\Model\Sell\Order;
use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(Label::class, function (Faker $faker) {
    return [
        'order_id' => factory(Order::class)->create()->id,
        'shippo_object_id' => $faker->md5,
        'label_url' => $faker->url,
        'tracking_url' => $faker->url,
        'tracking_number' => $faker->randomNumber(9),
    ];
});
