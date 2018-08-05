<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RedirectTest extends TestCase
{
    public function testRedirectIfNotLoggedIn()
    {
        $response = $this->get('/');

        $response->assertRedirect('/login');
    }
}
