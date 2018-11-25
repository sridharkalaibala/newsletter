<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\SubscriberField;


class SubscriberFieldsTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		// Let's truncate our existing records to start from scratch.
		Schema::disableForeignKeyConstraints();
		SubscriberField::truncate();
		Schema::enableForeignKeyConstraints();

		$faker = \Faker\Factory::create();
		// And now, let's create a few subscriber in our database:


		for ( $i = 0; $i < 100; $i ++ ) {
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
			SubscriberField::create( [
				'title'         => $faker->word,
				'value'         => $value,
				'type'          => $type,
				'subscriber_id' => $faker->numberBetween( 1, 50 )
			] );
		}
	}
}
