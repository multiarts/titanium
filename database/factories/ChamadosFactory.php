<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Chamados;
use Faker\Generator as Faker;

$factory->define(Chamados::class, function (Faker $faker) {
    return [
        'number' => $faker->number,
    ];
});
