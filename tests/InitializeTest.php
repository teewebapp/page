<?php

namespace Tee\Page\Tests;

use Tee\System\Tests\TestCase;

class InitializeTest extends TestCase {

    public function testSomethingIsTrue()
    {
        $this->assertTrue(\moduleEnabled('page'));
        $this->assertTrue(\moduleEnabled('system'));
    }

}