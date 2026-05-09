<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_root_redirects_to_health_endpoint(): void
    {
        $this->get('/')
            ->assertRedirect('/health');
    }
}
