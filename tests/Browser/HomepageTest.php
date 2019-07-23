<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class HomepageTest extends DuskTestCase
{
    /**
     * A basic browser test to ensure the homepage loads and displays the site name.
     *
     * @return void
     */
    public function test_hompeage_loads()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee(config('app.name'));
        });
    }
}
