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

    /**
     * A basic browser test to ensure the about loads and displays 'About site name' in the title bar.
     *
     * @return void
     */
    public function test_about_page_loads()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/about')
                    ->assertTitle('About '.config('app.name'));
        });
    }
}
