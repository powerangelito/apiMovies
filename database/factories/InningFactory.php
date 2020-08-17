<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Inning;
use Faker\Generator as Faker;

$factory->define(Inning::class, function (Faker $faker) {
    return [
        'Turno'      => $faker->time('H:i'),
        'Estado'     => $faker->numberBetween(0,1)
    ];
});
