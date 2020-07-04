<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\City;
use App\Models\State;
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
        'cep' => $faker->postcode,
        'state_id' => State::all()->pluck('id')->first(),
        'cite_id' => function(array $cite) {
            return City::find($cite['state_id']);
        },
        'agencia' => '5555',
        'numconta' => '5555',
        'numbanco' => '5555',
        'operacao' => '5555',
        'tipo' => $faker->boolean,
        'active' => $faker->randomElement(['on', 'off']),
    ];
});

// fabianagrafitheira
