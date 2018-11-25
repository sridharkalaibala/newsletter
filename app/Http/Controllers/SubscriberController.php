<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\Domaincheck;
use App\Subscriber;
use App\SubscriberField;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class SubscriberController extends Controller {
	public function index( Request $request ) {
		$request->validate( [
			'offset' => 'integer',
			'limit'  => 'integer|max:1000',
		] );

		$offset = ( null !== $request->query( 'offset' ) ) ? $request->query( 'offset' ) : 0;
		$limit  = ( null !== $request->query( 'limit' ) ) ? $request->query( 'limit' ) : 10;

		return Subscriber::with( 'fields' )->offset( $offset )->limit( $limit )->get();
	}

	public function store( Request $request ) {
		$this->bodyValidate( $request );

		if ( $request->input( 'state' ) == 'active' ) {
			throw new BadRequestHttpException( 'Can not be activated implicitly' );
		}


		$subscriber = Subscriber::create( $request->all() );

		if ( null !== $request->input( 'fields' ) ) {
			SubscriberField::createFromArray( $request->input( 'fields' ), $subscriber->id );
		}
		return response()->json( $this->show( $subscriber ), 201 );
	}

	public function show( Subscriber $subscriber ) {
		$subscriber['fields'] = $subscriber->fields;

		return $subscriber;
	}

	public function update( Request $request, Subscriber $subscriber ) {
		$this->bodyValidate( $request );
		$subscriber->update( $request->all() );
		if ( $subscriber->state == 'active' && $request->input( 'state' ) == 'active' ) {
			throw new BadRequestHttpException( 'Can not be activated implicitly' );
		}
		if ( null !== $request->input( 'fields' ) ) {
			SubscriberField::deleteFromSID( $subscriber->id );
			SubscriberField::createFromArray( $request->input( 'fields' ), $subscriber->id );
		}

		return response()->json( $this->show( $subscriber ), 200 );
	}

	public function delete( Subscriber $subscriber ) {
		SubscriberField::deleteFromSID( $subscriber->id );
		$subscriber->delete();

		return response()->json( null, 204 );
	}

	private function bodyValidate( $request ) {
		$request->validate( [
			'name'  => 'required|string|max:200',
			'email' => [ 'required', 'email', new Domaincheck ],
			'state' => 'required|in:"active","unsubscribed","junk","bounced"',
		] );

		if ( null !== $request->input( 'fields' ) ) {
			$tes = $request->validate( [
				'fields.*.title' => 'required|string|max:200',
				'fields.*.type'  => 'required|in:"date","number","string","boolean"',
			] );
		}
	}
}
