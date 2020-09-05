<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Illuminate\Support\Str;
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

$factory->define(User::class, function (Faker $faker) {
    $gender = $faker->randomElement(['male', 'female']);
    return [
        'name' => $faker->name($gender),
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('12345678'),
        'remember_token' => Str::random(10),
        'latitude' => $faker->latitude($min = 20, $max = 27),
        'longitude' => $faker->longitude($min = 88, $max = 93),
        'gender' => ucfirst($gender),
        'dob' => $faker->dateTimeBetween($startDate = '-60 years', $endDate = '-18 years', $timezone = null)->format('Y-m-d'),
        'photo' => 'img/default/user.svg'
    ];
});
