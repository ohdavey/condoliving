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
        'beds' => $faker->randomNumber(1, 1),
        'baths' => $faker->randomNumber(1, 1),
        'sqft' => $faker->numberBetween(400, 2000),
        'price' => $faker->randomFloat(2, 400, 12000),
        'year_built' => $faker->year('now'),
        'parking' => $faker->numberBetween(0,3),
        'body' => $faker->text(),
        'type' => $faker->company,
        'status' => $faker->numberBetween(0, 3),
    ];
});
