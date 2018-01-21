<?php

use Faker\Generator as Faker;

$factory->define(App\Community::class, function (Faker $faker) {
    return [
        'owner_id' => function () {
            return factory('App\User')->create()->id;
        },
//        'category_id' => function () {
//            return factory('App\Category')->create()->id;
//        },
        'category_id' => $faker->numberBetween(1, 4),
        'name' => $faker->company,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'postcode' => $faker->postcode,
        'country' => $faker->countryCode,
        'description' => $faker->text(200),
    ];

});
