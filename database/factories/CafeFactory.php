<?php

use App\Models\Cafe;
use Faker\Generator as Faker;

$factory->define(Cafe::class, function (Faker $faker) {
    return [
        'name'      => $faker->company,
        'address'   => $faker->streetAddress,
        'city'      => $faker->city,
        'state'     => $faker->country,
        'zip'       => $faker->postcode,
        'latitude'  => $faker->latitude,
        'longitude' => $faker->longitude,
    ];
});