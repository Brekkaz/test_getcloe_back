<?php

use Faker\Generator as Faker;

$factory->define(Core\Person\Person::class, function (Faker $faker) {
    return [
        'first_name'=> $faker->firstName(null),
        'last_name'=> $faker->lastName,
        'address'=> $faker->address,
        'email'=> $faker->unique()->safeEmail,
        'phone'=> $faker->PhoneNumber,
        'birth_date'=> $faker->date('Y-m-d', 'now'),
    ];
});
