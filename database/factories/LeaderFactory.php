<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Leader;
use Faker\Generator as Faker;

$factory->define(Leader::class, function (Faker $faker) {
    return [
        'username'  => $faker->userName,
        'password'  => $faker->password,
        'id_apps'   => factory(App\Apps::class),
        'status'    => 'ON'
    ];
});
