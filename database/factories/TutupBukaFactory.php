<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\TutupBuka;
use Faker\Generator as Faker;

$factory->define(TutupBuka::class, function (Faker $faker) {
    return [
        'tanggal_tutup' => $faker->dateTimeBetween($startDate = '-7 days', $endDate = 'now'),
        'tanggal_buka'  => $faker->dateTimeBetween($startDate = 'now', $endDate = '+7 days'),
        'id_anak'       => App\Anak::all()->random()->id_anak,
        'status'        => 'ON'
    ];
});
