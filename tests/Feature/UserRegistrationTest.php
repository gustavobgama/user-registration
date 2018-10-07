<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegistrationTest extends TestCase
{
    protected $route = '/user/save';

    protected $verb = 'POST';

    /**
     * @test
     */
    public function create_with_missing_required_fields()
    {
        $response = $this->json($this->verb, $this->route, [
            'user' => [
                'firstname' => 'John',
            ]
        ]);

        $response->assertStatus(500);
    }

    /**
     * @test
     */
    public function create_with_minimun_required_fields()
    {
        $response = $this->json($this->verb, $this->route, [
            'user' => [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'phone' => '11 22 3344-5566',
            ]
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'phone' => '11 22 3344-5566',
        ]);
    }

    /**
     * @test
     */
    public function create_complete()
    {
        $response = $this->json($this->verb, $this->route, [
            'user' => [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'phone' => '11 22 3344-5566',
            ],
            'step' => 1,
        ]);

        $response = $this->json($this->verb, $this->route, [
            'user' => [
                'firstname' => 'John',
                'lastname' => 'Doe',
                'phone' => '11 22 3344-5566',
                'address' => 'Lorem ipsum',
                'address_number' => '10',
                'zipcode' => '11111-111',
                'city' => 'Sao Paulo',
                'account_owner' => 'John Doe',
                'iban' => 'DE8234',
            ],
            'step' => 3,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('users', [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'phone' => '11 22 3344-5566',
            'address' => 'Lorem ipsum',
            'address_number' => '10',
            'zipcode' => '11111-111',
            'city' => 'Sao Paulo',
            'account_owner' => 'John Doe',
            'iban' => 'DE8234',
            'paymentdata_id' => $response->getContent(),
        ]);
    }
}
