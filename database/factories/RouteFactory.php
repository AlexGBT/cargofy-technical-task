<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Route;
use Faker\Generator as Faker;

$factory->define(Route::class, function (Faker $faker)  {
    return [
        'address' => $faker->randomElement([
            'Kyiv', 'Kharkiv', 'Odessa', 'Dnipro','Kramatorsk','Lviv','Mykolaiv','Luhansk','Vinnytsia','Makiivka','Simferopol','Kherson','Poltava','Chernihiv','Cherkasy','Chernivtsi'
        ]),
        'date' => $faker->date($format = 'Y-m-d'),
    ];
});
