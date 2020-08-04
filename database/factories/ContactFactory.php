<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'phone' => $faker->e164PhoneNumber,
        'email' => $faker->unique()->email,
        'religion' => function(){
            $varReligions = array('Buddhism', 'Christian', 'Islam');
            $var = array_rand($varReligions);
            return $varReligions[$var];
        }
    ];
});
