<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Tecnico;
use Faker\Generator as Faker;

$factory->define(Tecnico::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'rg' => $faker->rg,
        'cpf' => $faker->cpf,
        'telefone' => $faker->phoneNumber,
        'telefone1' => $faker->cellphoneNumber,
        'address' => $faker->address,
        'state_id' => '5',
        'cite_id' => '6131',
        'chamado_id' => $faker->randomDigit,
        'agencia' => $faker->numberBetween($min = 1000, $max = 9000),
        'tipo' => $faker->randomElements($array = array('0','1')),
        'active' => $faker->boolean,
    ];
});
