<?php

use Faker\Generator as Faker;

$factory->define(App\property::class, function (Faker $faker) {
    return [
        'owner_id' => function () {
            return factory('App\User')->create()->id;
        },
        'community_id' => function () {
            return factory('App\Category')->create()->id;
        },
        'address' => $faker->address,
        'unit' => $faker->buildingNumber,
        'beds' => $faker->randomNumber(),
        'baths' => $faker->randomNumber(),
        'sqft' => $faker->randomNumber(),
        'price' => $faker->randomFloat(),
        'body' => $faker->text(),
        'type' => $faker->company,
        'status' => $faker->boolean,
    ];
});
