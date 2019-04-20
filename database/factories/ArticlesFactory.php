<?php

use Faker\Generator as Faker;

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

$factory->define(App\Models\BlogArticle::class, function (Faker $faker) {
//    dd(base64_encode(file_get_contents($faker->imageUrl(640, 480))));
//    dd($faker->realText(100));
    return [
//        'description_short' => $faker->realText(100),
//        'description_long' => $faker->realText(400),
//        'image' => 'data:image/jpeg;base64,'.base64_encode(file_get_contents($faker->imageUrl())),
    ];
});
