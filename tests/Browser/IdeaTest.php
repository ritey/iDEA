<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class IdeaTest extends DuskTestCase
{
    /**
     * A collection of tests to check idea.org.uk loads and displays the site name on the homepage.
     *
     * @return void
     */
    public function test_idea_hompeage_loads()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://idea.org.uk')
                    ->assertSee('The Prince Andrew Charitable Trust');
        });
    }

    /**
     * A test to check idea.org.uk register page loads and displays the form label Nickname.
     *
     * @return void
     */
    public function test_idea_register_page_loads()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://idea.org.uk/register')
                    ->assertSee('Nickname');
        });
    }

    /**
     * A test to check idea.org.uk login page loads and a user can login
     *
     * @return void
     */
    public function test_idea_login_page_loads()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('https://idea.org.uk/login')
                ->type('email', 'dave@ritey.com')
                ->type('password', '!Password123')
                ->click('.login form button[type="submit"]')
                ->assertSee('ritey');
        });
    }
}
