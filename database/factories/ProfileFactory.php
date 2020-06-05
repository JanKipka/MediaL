<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Profile::class, function (Faker $faker) {
    return [
        'twitter' => $faker->userName,
        'city' => $faker->city,
        'website' => $faker->url,
        'biography' => $faker->realText(50, 2),
        'birthday' => $faker->date()
    ];
});
