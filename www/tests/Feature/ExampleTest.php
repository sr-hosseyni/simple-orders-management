<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    public function testRootPage()
    {
        $this
            ->get('/')
            ->assertRedirect('/order');
    }

    public function testOrdersPage()
    {
        $this
            ->get('/order')
            ->assertOk();
    }
}
