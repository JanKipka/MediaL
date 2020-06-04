<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(App\Book::class, function (Faker $faker) {
   return [
       'title' => $faker->text,
       'format' => \App\Format::PAPERBACK
   ];
});
