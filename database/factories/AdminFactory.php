<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use App\User;
use Faker\Generator as Faker;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'user_id' => User::first()->id
    ];
});
