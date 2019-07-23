<?php

namespace Tests\Unit;

use Tests\TestCase;
use Idea\Traits\Shrink;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShrinkTraitTest extends TestCase
{
    /**
     * A test for the Shrink Trait. shrink() removes space between HTML tags
     *
     * @return void
     */
    public function testShrinkTraitTest()
    {
        $t = new class { use Shrink; }; // this is an anonymous class great for testing traits
        $this->assertTrue($t->shrink('<body>Hello</body>') === '<body>Hello</body>');
        $this->assertTrue($t->shrink('<body> <p>Hello</p> </body>') === '<body><p>Hello</p></body>');
        $this->assertTrue($t->shrink('<body>   <p>Hello</p>   </body>') === '<body><p>Hello</p></body>');
    }
}
