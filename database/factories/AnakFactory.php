<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Anak;
use Faker\Generator as Faker;

$factory->define(Anak::class, function (Faker $faker) {
    return [
        'username'  => $faker->userName,
        'password'  => $faker->password,
        'id_apps'   => factory(App\Apps::class),
        'id_divisi' => factory(App\Divisi::class),
        'id_leader' => factory(App\Leader::class),
        'status'    => 'ON'
    ];
});
