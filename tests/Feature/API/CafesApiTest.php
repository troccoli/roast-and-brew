<?php

namespace Tests\Feature\API;

use App\Models\Cafe;
use Tests\PassportTestCase;

class CafesApiTest extends PassportTestCase
{
    protected $scopes = [];

    public function testGetCafes()
    {
        $numberOfCafes = mt_rand(2, 10);
        factory(Cafe::class)->times($numberOfCafes)->create();

        $response = $this->getJson('/api/v1/cafes');

        $data = json_decode($response->getContent(), true);

        $this->assertCount($numberOfCafes, $data);
        foreach ($data as $cafe) {
            $this->assertArrayHasKey('id', $cafe);
            $this->assertArrayHasKey('name', $cafe);
            $this->assertArrayHasKey('address', $cafe);
            $this->assertArrayHasKey('city', $cafe);
            $this->assertArrayHasKey('state', $cafe);
            $this->assertArrayHasKey('zip', $cafe);
            $this->assertArrayHasKey('latitude', $cafe);
            $this->assertArrayHasKey('longitude', $cafe);
        }
    }

    public function testGetCafe()
    {
        $cafe = factory(Cafe::class)->create();

        $response = $this->getJson("/api/v1/cafes/{$cafe->id}");

        $data = json_decode($response->getContent());

        $this->assertEquals($cafe->id, $data->id);
        $this->assertEquals($cafe->name, $data->name);
        $this->assertEquals($cafe->address, $data->address);
        $this->assertEquals($cafe->city, $data->city);
        $this->assertEquals($cafe->state, $data->state);
        $this->assertEquals($cafe->zip, $data->zip);
        $this->assertEquals($cafe->latitude, $data->latitude);
        $this->assertEquals($cafe->longitude, $data->longitude);
    }

    public function testPostNewCafe()
    {
        $cafe = factory(Cafe::class)->make();

        $this->assertDatabaseMissing('cafes', ['name', $cafe->name]);

        $response = $this->postJson('/api/v1/cafes', $cafe->toArray());

        $data = json_decode($response->getContent());

        $this->assertDatabaseHas('cafes', ['name' => $data->name]);
    }
}
