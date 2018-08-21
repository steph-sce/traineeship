<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $typeValues = ['formation', 'stage'];
    $statusValues = ['draft', 'published'];
    $startDay = rand(1, 28);
    return [
        'post_type' => $typeValues[rand(0,1)],
        'title' => $faker->sentence(3),
        'description' => $faker->sentence(25),
        'start_date' => null,
        'end_date' => null,
        'price' => $faker->numberBetween(99, 9999),
        'max_students' => $faker->numberBetween(10, 100),
        'status' => $statusValues[rand(0,1)]
    ];
});
