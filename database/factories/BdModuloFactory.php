<?php

use App\BdModulo;
use Faker\Generator as Faker;

$factory->define(BdModulo::class, function (Faker $faker) {
    return [
        'nombre' => $faker->name,
        'descripcion' => $faker->paragraphs,
        'foto' => $faker->url,
        'estado' => 'Activo',
        'slug' => $faker->slug,
        'user_id' => 1
    ];
});
