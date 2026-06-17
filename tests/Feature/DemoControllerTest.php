<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DemoControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_demo_controller_accessible()
    {
        // Sesuaikan route jika namanya berbeda
        $this->get('/demo')->assertStatus(200);
    }
}
