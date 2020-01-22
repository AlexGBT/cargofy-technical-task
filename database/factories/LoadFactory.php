<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Load;
use App\Route;
use Faker\Generator as Faker;

$factory->define(Load::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'weight' => $faker->randomDigit,
    ];
});

$factory->afterCreating(Load::class, function ($load) {
    $load->routeWays()->saveMany(factory(Route::class,3)->make());
});
