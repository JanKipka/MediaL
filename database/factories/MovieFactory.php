<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Movie::class, function (Faker $faker) {
    return [
        'title' => $faker->realText(20, 2),
        'genre_id' => $faker->randomElement([1, 2, 3, 4, 5, 6])
    ];
});
