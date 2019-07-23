<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomepageTest extends TestCase
{
    /**
     * A basic test to check the homepage returns a 200 status.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A basic test to check the homepage returns a 200 status.
     *
     * @return void
     */
    public function aboutPageTest()
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
    }

    /**
     * A basic test to check the homepage returns a 200 status.
     *
     * @return void
     */
    public function aboutsPageTest()
    {
        $response = $this->get('/abouts');

        $response->assertStatus(404);
    }
}