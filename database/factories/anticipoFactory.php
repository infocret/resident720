<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\anticipo;
use Faker\Generator as Faker;

$factory->define(anticipo::class, function (Faker $faker) {

    return [
        'condom_id' => $faker->randomDigitNotNull,
        'unid_id' => $faker->randomDigitNotNull,
        'conceptserv_id' => $faker->randomDigitNotNull,
        'fechareg' => $faker->word,
        'folio' => $faker->word,
        'cobertura' => $faker->word,
        'montoini' => $faker->word,
        'saldo' => $faker->word,
        'status' => $faker->word,
        'desc' => $faker->word,
        'observ' => $faker->word,
        'docto' => $faker->word,
        'filelink' => $faker->word,
        'userreg' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
