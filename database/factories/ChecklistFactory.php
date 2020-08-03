<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Checklist;
use App\User;
use Faker\Generator as Faker;

$factory->define(Checklist::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
        'is_template' => rand(0,1),
        'is_completed'=> 0, 
        'user_id' => User::first()->id
    ];
});
