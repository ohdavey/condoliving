<?php

use Faker\Generator as Faker;


$factory->define(App\Property::class, function (Faker $faker) {
    return [
        'owner_id' => function () {
            return factory('App\User')->create()->id;
        },
//        'community_id' => function () {
//            return factory('App\Category')->create()->id;
//        },
        'community_id' => $faker->numberBetween(1, 4),
        'address' => $faker->streetAddress,
        'unit' => $faker->buildingNumber,
        'beds' => $faker->numberBetween(1, 5),
        'baths' => $faker->numberBetween(1, 4),
        'sqft' => $faker->numberBetween(400, 2000),
        'price' => $faker->randomFloat(2, 400, 12000),
        'year_built' => $faker->year('now'),
        'parking' => $faker->numberBetween(0,3),
        'body' => $faker->paragraphs(3, true),
        'type' => $faker->randomElement(array('Condo', 'Townhome', 'House', 'Apartment', 'Manufactured')),
        'status' => $faker->numberBetween(0, 3),
    ];
});

// $communities = factory('App\Community', 12)->create();
// $communities->each(function ($community) { factory('App\Property', rand(3, 15))->create(['community_id' => $community->id]); });