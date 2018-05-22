<?php

use Faker\Generator as Faker;

$factory->define(App\Tenant::class, function (Faker $faker) {
    return [
        'property_id' => function () {
            return factory('App\Property')->create()->id;
        },
        'personal_id' => substr($faker->uuid, 4 , 12),
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'dob' => $faker->date('Y-m-d', 'now'),
        'salary' => $faker->randomFloat(2, 25000, 350000),
    ];
});
