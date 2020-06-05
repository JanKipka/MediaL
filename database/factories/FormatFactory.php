<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Format::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Paperback', 'Hardcover']),
        'mediaFormat' => \App\MediaFormat::BOOK
    ];
});
