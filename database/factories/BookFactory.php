<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Book::class, function (Faker $faker) {
   return [
       'title' => $faker->realText(35, 2),
       'genre_id' => $faker->randomElement([1, 2, 3, 4, 5, 6]),
       'format_id' => factory(\App\Format::class)
   ];
});
