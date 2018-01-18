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
        'category_id' => $faker->buildingNumber,
        'name' => $faker->company,
        'address' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->locale,
        'postal_code' => $faker->postcode,
        'country' => $faker->countryCode,
        'description' => $faker->paragraphs,
    ];

});
