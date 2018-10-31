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

$factory->define(App\Models\Activity::class, function (Faker $faker) {
    return [
        'image' => 'data:image/jpeg;base64,'.base64_encode(file_get_contents($faker->imageUrl())),
    ];
});
