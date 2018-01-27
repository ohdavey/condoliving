<?php

use Faker\Generator as Faker;

$factory->define(App\RentLog::class, function (Faker $faker) {
    return [
        'tenant_id' => function () {
            return factory('App\Tenant')->create()->id;
        },
        'property_id' => function () {
            return factory('App\Property')->create()->id;
        },
        'lease_id' => function () {
            return factory('App\Lease')->create()->id;
        },
        'month' => $faker->date('Y-m-d', 'now'),
        'rent' => $faker->randomFloat(2, 800, 15000),
        'fee' => $faker->randomFloat(2, 800, 15000),
        'balance' => $faker->randomFloat(2, 800, 15000),
    ];
});
