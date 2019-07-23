<?php

namespace Tests\Unit;

use Tests\TestCase;
use Idea\Traits\Key;
use Illuminate\Foundation\Testing\RefreshDatabase;

class KeyTraitTest extends TestCase
{
    /**
     * A test for the Key Trait. key() generates an MD5 string using the class name, method name and user id if present
     * along with an optional string to generate a unique key ideal for using in a name value pair
     *
     * @return void
     */
    public function testKeyTraitTest()
    {
        $t = new class { use Key; }; // this is an anonymous class great for testing traits
        $this->assertTrue(strlen($t->key()) === 32);
        $this->assertTrue(strlen($t->key('test')) === 32);
        $this->assertTrue($t->key('test') !== $t->key());
    }
}
