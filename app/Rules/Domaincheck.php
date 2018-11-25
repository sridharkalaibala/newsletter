<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Domaincheck implements Rule {
	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct() {
		//
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string $attribute
	 * @param  mixed $value
	 *
	 * @return bool
	 */
	public function passes( $attribute, $value ) {
		list( $user, $domain ) = explode( '@', $value );
		$arr = dns_get_record( $domain, DNS_MX );
		if ( empty( $arr ) ) {
			return false;
		}
		if ( $arr[0]['host'] == $domain && ! empty( $arr[0]['target'] ) ) {
			return true;
		}

		return false;
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message() {
		return 'The email domain is not active.';
	}
}
