<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/*$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});*/

$factory->define(App\Curso::class, function (Faker\Generator $faker) {
    return [
        'codigo' => $faker->bothify('???-??#####??'),
        'nombre' => $faker->catchPhrase(),
        'logo' => $faker->date('Ymd_His', 'now').".png",
        'color_hexa' => $faker->hexcolor(),
        'costo_personalizado' => $faker->randomFloat(2, 100, 300),
        'costo_referencial' => $faker->randomFloat(2, 100, 300),
        'eslogan' => $faker->sentence(10, true),
        'descripcion' => $faker->text(500),
        'horas_academicas' => $faker->numberBetween(20, 30),
        'horas_reales' => $faker->numberBetween(10, 20),
        'area_id' => $faker->randomElement([1,2,3]),
        'dificultad_id' => $faker->randomElement([1,2,3]),
    ];
});

$factory->define(App\Carrera::class, function (Faker\Generator $faker) {
    return [
        'codigo' => $faker->bothify('???-??#####??'),
        'nombre' => $faker->catchPhrase(),
        'logo' => $faker->date('Ymd_His', 'now').".png",
        'color_hexa' => $faker->hexcolor(),
        'costo_mensual' => $faker->randomFloat(2, 100, 300),
    ];
});
