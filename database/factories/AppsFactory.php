<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Apps;
use Faker\Generator as Faker;

$factory->define(Apps::class, function (Faker $faker) {
    return [
        'nama_apps' => $faker->domainWord,
        'link_apps' => $faker->domainName,
        'id_company'=> factory(App\Company::class),    
        'status'    => 'ON'
    ];
});
