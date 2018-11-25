<?php

namespace Tests\Feature\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SubscriberTest extends TestCase
{

	public function testGetValues()
	{
		$this->json('GET', 'api/subscribers/1')
		     ->assertStatus(200)
			->assertJsonStructure([
				'id',
				'name',
				'email',
				'created_at',
				'updated_at',
				'state',
			]);
	}

	public function testRequiresFields()
	{
		$this->json('POST', 'api/subscribers')
		     ->assertStatus(400)
		     ->assertJson([
			     'errors' => 'Sorry, something went wrong.'
		     ]);
	}

	public function testSubmitFieldsSuccessfully()
	{
		$payload = ['name' => 'Sridhar bala', 'email' => 'dev.sri.bala@gmail.com', 'state' => 'bounced'];

		$this->json('POST', 'api/subscribers', $payload)
		     ->assertStatus(201)
		     ->assertJsonStructure([
				     'id',
				     'name',
				     'email',
				     'created_at',
				     'updated_at',
				     'state',
		     ]);

	}

	public function testSubmitFieldsPOSTFailure()
	{
		$payload = ['name' => 'Sridhar bala', 'email' => 'dev.sri.bala@gmail.com', 'state' => 'active'];

		$this->json('POST', 'api/subscribers', $payload)
			->assertStatus(400)
			->assertJson([
				'errors' => 'Sorry, something went wrong.',
				"message"=> "Can not be activated implicitly"
			]);
	}

	public function testSubmitFieldsPUTFailure()
	{
		$payload = ['name' => 'Sridhar bala', 'email' => 'dev.sri.bala@gmail.com', 'state' => 'active'];

		$this->json('PUT', 'api/subscribers/1', $payload)
		     ->assertStatus(400)
		     ->assertJson([
			     'errors' => 'Sorry, something went wrong.',
			     "message"=> "Can not be activated implicitly"
		     ]);
	}

	public function testSubmitFieldsPUTSuccess()
	{
		$payload = ['name' => 'Sridhar bala', 'email' => 'dev.sri.bala@gmail.com', 'state' => 'bounced'];

		$this->json('PUT', 'api/subscribers/1', $payload)
		     ->assertStatus(200)
			->assertJsonStructure([
				'id',
				'name',
				'email',
				'created_at',
				'updated_at',
				'state',
			]);
	}

	public function testSubmitFieldsDeletesuccess()
	{
		$this->json('DELETE', 'api/subscribers/1')
		     ->assertStatus(204);
	}
}
