<?php


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

$factory->define(App\Subscriber::class, function (Faker\Generator $faker) {
	return [
		'name'  => $faker->name,
		'email' => $faker->email,
		'state' => $faker->randomElement( [ 'active', 'unsubscribed', 'junk', 'bounced' ] ),
	];
});


$factory->define(App\SubscriberField::class, function (Faker\Generator $faker) {
	$type = $faker->randomElement( [ 'date', 'number', 'string', 'boolean' ] );
	if ( $type == 'date' ) {
		$value = $faker->date( $format = 'Y-m-d', $max = 'now' );
	} else if ( $type == 'boolean' ) {
		$value = $faker->boolean;
	} else if ( $type == 'number' ) {
		$value = $faker->randomDigit;
	} else {
		$value = $faker->word;
	}
	return [
		'title'         => $faker->word,
		'value'         => $value,
		'type'          => $type,
		'subscriber_id' => $faker->numberBetween( 1, 50 )
	];
});