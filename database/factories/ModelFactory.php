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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    $hasher   = app()->make('hash');
    $fakeDate = new Carbon\Carbon();

    return [
        'name'          => $faker->name,
        'surname'       => $faker->name,
        'email'         => $faker->unique()->email,
        'password'      => app('hash')->make('123123123'),
        'address'       => $faker->word(),
        'phone1'        => $faker->phoneNumber,
        'phone2'        => $faker->phoneNumber,
        'phone3'        => $faker->phoneNumber,
        'birthday'      => $fakeDate->subYears(mt_rand(1, 31)),
        'death_date'    => $fakeDate->addYears(mt_rand(1, 31)),
        'gender'        => 'M',
        'civil_status'  => 'S',
        'notes'         => $faker->paragraph(mt_rand(10, 20)),
        'active'        => true,
        /**
         * Fk's
         */
        'occupation_id' => mt_rand(1, env('FAKER_CANT_OCCUPATIONS')),
        'church_id'     => mt_rand(1, env('FAKER_CANT_CHURCHES')),
    ];
});
$factory->define(App\Occupation::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->sentence(4),
    ];
});
$factory->define(App\Church::class, function (Faker\Generator $faker) {
    return [
        'name'    => $faker->name,
        'address' => $faker->word(),
        'phone1'  => $faker->phoneNumber,
        'phone2'  => $faker->phoneNumber,
        'phone3'  => $faker->phoneNumber,
        'email'   => $faker->unique()->email,
    ];
});
