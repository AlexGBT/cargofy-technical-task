<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Route;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/
function getCity() {
    $cities = [
        'Kyiv', 'Kharkiv', 'Odessa', 'Dnipro','Kramatorsk','Lviv','Mykolaiv','Luhansk','Vinnytsia','Makiivka','Simferopol','Kherson','Poltava','Chernihiv','Cherkasy','Chernivtsi'
    ];
    $city = $cities[array_rand($cities)];
    return $city;
}

$factory->define(Route::class, function (Faker $faker)  {
    return [
        'from' => getCity(),
        'to' => getCity(),
        'date' => $faker->date($format = 'Y-m-d'),
    ];
});
