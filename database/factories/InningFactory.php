<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Inning;
use Faker\Generator as Faker;

$factory->define(Inning::class, function (Faker $faker) {
    return [
        'turno'      => $faker->time('H:i'),
        'estado'     => $faker->numberBetween(0,1)
    ];
});
