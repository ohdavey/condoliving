<?php

use Faker\Generator as Faker;

$factory->define(App\Lease::class, function (Faker $faker) {
    return [
        'tenant_id' => function () {
            return factory('App\User')->create()->id;
        },
        'property_id' => function () {
            return factory('App\Community')->create()->id;
        },
        'deposit' => $faker->randomFloat(0, 400, 12000),
        'monthly_rate' => $faker->randomFloat(0, 400, 12000),
        'late_fee' => $faker->randomFloat(2, 0.00, 0.50),
        'maintenance_fee' => $faker->randomFloat(0, 400, 2000),
        'amenities' => $faker->randomElement(array('Condo', 'Townhouse', 'House', 'Apartment', 'Manufactured')),
        'start_date' => $faker->dateTimeBetween('-1 year', 'now'),
        'end_date' => $faker->dateTimeBetween('now', '+2 year'),
        'status' => $faker->numberBetween(0,3),
        'notes' => $faker->paragraph(5),
    ];
});
