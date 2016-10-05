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
        /*'logo' => $faker->date('Ymd_His', 'now').".png",*/
        'color_hexa' => $faker->hexcolor(),
        'costo_personalizado' => $faker->randomFloat(2, 100, 300),
        'costo_referencial' => $faker->randomFloat(2, 100, 300),
        'eslogan' => $faker->sentence(10, true),
        'descripcion' => $faker->text(500),
        'vigente' => true,
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
        /*'logo' => $faker->date('Ymd_His', 'now').".png",*/
        'color_hexa' => $faker->hexcolor(),
        'costo_mensual' => $faker->randomFloat(2, 100, 300),
    ];
});

$factory->define(App\Persona::class, function (Faker\Generator $faker) {
    return [
        'codigo' => $faker->bothify('???-######'),
        'primer_apellido' => $faker->lastname,
        'segundo_apellido' => $faker->lastname,
        'nombres' => $faker->name,
        'email' => $faker->email,
        'fecha_nacimiento' => $faker->date('Y-m-d', 'now'),
        'numero_ci' => $faker->randomNumber(7),
        'genero' => $faker->randomElement(['femenino', 'masculino']),
        'direccion' => $faker->address,
        'telefono_1' => $faker->tollFreePhoneNumber,
        'telefono_2' => $faker->tollFreePhoneNumber,
        'expedicion_codigo' => $faker->randomElement(['LP', 'SC', 'CB']),
    ];
});

$factory->define(App\Docente::class, function (Faker\Generator $faker) {
    return [
        'biografia' => $faker->text(250),
        'email_institucional' => $faker->email,
        'vigente' => true,
        'social_facebook' => $faker->url,
        'social_twitter' => $faker->url,
        'social_googleplus' => $faker->url,
        'social_youtube' => $faker->url,
        'social_linkedin' => $faker->url,
        'social_website' => $faker->url,
        'persona_codigo' => factory(App\Persona::class)->create()->codigo,
    ];
});

$factory->define(App\LanzamientoCurso::class, function (Faker\Generator $faker) {
    return [
        'costo' => $faker->randomFloat(2, 100, 300),
        'curso_codigo' => factory(App\Curso::class)->create()->codigo,
        'cronograma_id' => factory(App\Cronograma::class)->create()->id,
    ];
});

$factory->define(App\Cronograma::class, function (Faker\Generator $faker) {
    return [
        'inicio' => $faker->date('Y-m-d\TH:i', 'now'),
        'promocion' => false,
        'slider' => true,
        'tipo_id' => $faker->randomElement([1,2,3]),
    ];
});

$factory->define(App\Alumno::class, function (Faker\Generator $faker) {
    return [
        'persona_codigo' => factory(App\Persona::class)->create()->codigo,
    ];
});
