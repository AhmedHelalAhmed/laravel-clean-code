<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->word,

        'body' => $faker->sentence,
    ];
});

$factory->state(Post::class, 'approved', function (Faker $faker) {
    return [
        'approved_at' => now(),
    ];
});
