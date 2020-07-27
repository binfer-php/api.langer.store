<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DemoTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testDomeTest()
    {
        $response = $this->get('http://www.basidu.com');


        $response->assertStatus($response->status());
    }
}
