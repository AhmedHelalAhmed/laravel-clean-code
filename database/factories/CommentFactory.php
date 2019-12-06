<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence,
    ];
});

$factory->state(Comment::class, 'approved', function (Faker $faker) {
    return [
        'approved_at' => now(),
    ];
});
