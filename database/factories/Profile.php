<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use App\User;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'bio' => $faker->unique()->safeEmail,
        'image' => "images/default.png"
    ];
});
