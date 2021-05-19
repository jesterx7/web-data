<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Anak;
use Faker\Generator as Faker;

$factory->define(Anak::class, function (Faker $faker) {
    return [
        'username'  => $faker->userName,
        'password'  => $faker->password,
        'id_apps'   => App\Apps::all()->random()->id_apps,
        'id_divisi' => App\Divisi::all()->random()->id_divisi,
        'id_leader' => App\Leader::all()->random()->id_leader,
        'status'    => 'ON'
    ];
});
