<?php

use Faker\Generator as Faker;

$factory->define(App\Timesheets::class, function (Faker $faker) {
	static $week = "-,-,-,-,-,-,,0|-,-,-,-,-,-,,0|-,-,-,-,-,-,,0|-,-,-,-,-,-,,0|-,-,-,-,-,-,,0|-,-,-,-,-,-,,0|-,-,-,-,-,-,,0";

    return [
        'user_id' => function(){
        	return factory(App\User::class)->create()->id;
        },
        'startdate' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'firstweek' => $week,
        'secondweek'=> $week,
        'totals' => $faker->randomDigitNotNull.','.$faker->randomDigitNotNull.','.$faker->randomDigitNotNull,
        'submitted' => $faker->randomElement($array = array ('0','1')),
    ];
});
