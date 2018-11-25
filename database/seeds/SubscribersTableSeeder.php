<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Subscriber;

class SubscribersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		// Let's truncate our existing records to start from scratch.
		Schema::disableForeignKeyConstraints();
		Subscriber::truncate();
		Schema::enableForeignKeyConstraints();

		$faker = \Faker\Factory::create();

		// And now, let's create a few subscriber in our database:
		for ( $i = 0; $i < 50; $i ++ ) {
			Subscriber::create( [
				'name'  => $faker->name,
				'email' => $faker->email,
				'state' => $faker->randomElement( [ 'active', 'unsubscribed', 'junk', 'bounced' ] ),
			] );
		}
	}
}
