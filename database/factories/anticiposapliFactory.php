<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\anticiposapli;
use Faker\Generator as Faker;

$factory->define(anticiposapli::class, function (Faker $faker) {

    return [
        'anticipo_id' => $faker->randomDigitNotNull,
        'inmucharg_id' => $faker->randomDigitNotNull,
        'inmumovto_id' => $faker->randomDigitNotNull,
        'fechareg' => $faker->word,
        'saldoini' => $faker->word,
        'monto' => $faker->word,
        'saldofin' => $faker->word,
        'status' => $faker->word,
        'apmode' => $faker->word,
        'desc' => $faker->word,
        'observ' => $faker->word,
        'userreg' => $faker->word,
        'created_at' => $faker->date('Y-m-d H:i:s'),
        'updated_at' => $faker->date('Y-m-d H:i:s')
    ];
});
