<?php

namespace Tests\Feature\API;

use App\Models\BrewMethod;
use App\Models\Cafe;
use Tests\PassportTestCase;

class CafesApiTest extends PassportTestCase
{
    protected $scopes = [];

    public function testGetCafes()
    {
        $totalNumberOfCafes = mt_rand(2, 10);
        $allCafes = factory(Cafe::class)->times($totalNumberOfCafes)->create();

        $totalNumberOfBrewMethods = mt_rand(2, 10);
        $allBrewMethods = factory(BrewMethod::class)->times($totalNumberOfBrewMethods)->create();

        $expectedBrewMethods = [];
        foreach ($allCafes as $cafe) {
            $numberOfBrewMethods = mt_rand(0, $totalNumberOfBrewMethods);
            $brewMethods = $allBrewMethods->random($numberOfBrewMethods);

            $cafe->brewMethods()->attach($brewMethods->keyBy('id')->keys());

            $expectedBrewMethods[$cafe->id] = $brewMethods;
        }

        $response = $this->getJson('/api/v1/cafes');

        $data = json_decode($response->getContent(), true);

        $this->assertCount($totalNumberOfCafes, $data);
        foreach ($data as $cafe) {
            $this->assertArrayHasKey('id', $cafe);
            $this->assertArrayHasKey('name', $cafe);
            $this->assertArrayHasKey('address', $cafe);
            $this->assertArrayHasKey('city', $cafe);
            $this->assertArrayHasKey('state', $cafe);
            $this->assertArrayHasKey('zip', $cafe);
            $this->assertArrayHasKey('latitude', $cafe);
            $this->assertArrayHasKey('longitude', $cafe);
            $this->assertArrayHasKey('brew_methods', $cafe);
            $this->assertSameSize($expectedBrewMethods[$cafe['id']], $cafe['brew_methods']);
        }
    }

    public function testGetCafe()
    {
        $cafe = factory(Cafe::class)->create();

        $totalNumberOfBrewMethods = mt_rand(2, 10);
        $allBrewMethods = factory(BrewMethod::class)->times($totalNumberOfBrewMethods)->create();

        $numberOfBrewMethods = mt_rand(0, $totalNumberOfBrewMethods);
        $expectedBrewMethods = $allBrewMethods->random($numberOfBrewMethods);

        $cafe->brewMethods()->attach($expectedBrewMethods->keyBy('id')->keys());

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

        $this->assertSameSize($expectedBrewMethods, $data->brew_methods);

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
