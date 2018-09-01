<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $typeValues = ['formation', 'stage'];
    $statusValues = ['draft', 'published'];
    $startDay = rand(1, 28);
    return [
        'post_type' => $faker->randomElement($typeValues),
        'title' => $faker->sentence(3),
        'description' => $faker->paragraph(25),
        'start_date' =>$faker->dateTimeInInterval("+" .$startDay . " days"),
        'end_date' => $faker->dateTimeInInterval("+" .$startDay + 7 . " days"),
        'price' => $faker->randomFloat(2,99.99, 9999.99),
        'max_students' => $faker->numberBetween(10, 100),
        'status' => $faker->randomElement($statusValues)
    ];
});
