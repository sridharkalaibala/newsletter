<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriberFieldsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create( 'subscriber_fields', function ( Blueprint $table ) {
			$table->engine = 'InnoDB';
			$table->increments( 'id' );
			$table->string( 'title' );
			$table->text( 'value' );
			// I am not fan of enum but to make task easy i added this
			$table->enum( 'type', [ 'date', 'number', 'string', 'boolean' ] );
			$table->integer( 'subscriber_id' )->unsigned();
			$table->foreign( 'subscriber_id' )->references( 'id' )->on( 'subscribers' )->onDelete( 'cascade' );
		} );
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::dropIfExists( 'subscriber_fields' );
	}
}
