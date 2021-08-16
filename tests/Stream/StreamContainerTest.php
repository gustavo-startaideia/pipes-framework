<?php

namespace Pipes\Tests\Stream;

use Pipes\Stream\StreamContainer;
use Pipes\Tests\Spies\Stream\HookSpy;

class StreamContainerTest extends \Pipes\Tests\TestCase
{
    /**
     * System Under Tests
     * 
     * @var StreamContainer
     */
    protected StreamContainer $sut;

    /**
     * Create sut and mocks
     * 
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->sut = new StreamContainer();
    }

    /** @test */
    public function it_should_register_a_hook()
    {
        $this->sut->pushHook(HookSpy::class);

        $this->assertTrue($this->sut->hasHook(HookSpy::class));

        $this->assertFalse($this->sut->hasHook('<invalid_hook_name>'));
    }
}
