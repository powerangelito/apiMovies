<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movie;
use Faker\Generator as Faker;

$factory->define(Movie::class, function (Faker $faker) {
    return [
        'nombre'                => $faker->sentence,
        'fecha_publicacion'     => $faker->date('d/m/Y'),
        'estado'                => $faker->numberBetween(0,1)
    ];
});
