<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    static $password;
    $username = str_random(7);

    return [
        'name' => $faker->name,
        'username' => $username,
        'email' => $username."@wmich.edu",
        'password' => $password ?: $password = bcrypt('password'),
        'group' => $faker->randomElement($array = array ('1','2')),
        'fundcc' => str_random(5),
        'jobcode' => str_random(5),
        'admin' => $faker->randomElement($array = array ('0','1')),
        'hours' => $faker->randomDigitNotNull,
        'remember_token' => str_random(10),
    ];
});
