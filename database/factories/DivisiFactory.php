<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Divisi;
use Faker\Generator as Faker;

$factory->define(Divisi::class, function (Faker $faker) {
    return [
        'nama_divisi'   => $faker->jobTitle,
        'id_apps'       => App\Apps::all()->random()->id_apps,
        'status'        => 'ON'
    ];
});
