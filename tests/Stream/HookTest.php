<?php

namespace Pipes\Tests\Stream;

use Pipes\Stream\Hook;

class HookTest extends \Pipes\Tests\TestCase
{
    /**
     * System Under Tests
     * 
     * @var Hook
     */
    protected Hook $sut;

    /**
     * Create sut and mocks
     * 
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        // crate sut
        $this->sut = new Hook;
    }

    /** @test */
    public function it_should_get_hook_name()
    {
        $this->assertEquals(get_class($this->sut), $this->sut->getName());
    }
}
