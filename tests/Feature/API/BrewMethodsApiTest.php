<?php

namespace Tests\Feature\API;

use App\Models\BrewMethod;
use App\Models\Cafe;
use Tests\PassportTestCase;

class BrewMethodsApiTest extends PassportTestCase
{
    protected $scopes = [];

    public function testGetBrewMethods()
    {
        $totalNumberOfBrewMethods = mt_rand(2, 10);
        $allBrewMethods = factory(BrewMethod::class)->times($totalNumberOfBrewMethods)->create();

        $response = $this->getJson('/api/v1/brew-methods');

        $data = json_decode($response->getContent(), true);

        $this->assertCount($totalNumberOfBrewMethods, $data);
        foreach ($data as $brewMethod) {
            $this->assertArrayHasKey('id', $brewMethod);
            $this->assertArrayHasKey('method', $brewMethod);
        }
    }
}
