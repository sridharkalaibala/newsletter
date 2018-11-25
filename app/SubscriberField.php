<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubscriberField extends Model {
	protected $fillable = [ 'title', 'type', 'value', 'subscriber_id' ];
	protected $hidden = [ 'subscriber_id', 'id' ];
	public $timestamps = false;

	public static function createFromArray( $array, $subscriber_id ) {
		foreach ( $array as $value ) {
			parent::create( array_merge( $value, [ 'subscriber_id' => $subscriber_id ] ) );
		}
	}

	public static function deleteFromSID( $subscriber_id ) {
		parent::where( 'subscriber_id', $subscriber_id )->delete();
	}

	public function subscriber() {
		return $this->belongsTo( 'App\Subscriber', 'subscriber_id', 'id' );
	}
}
