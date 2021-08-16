<?php

namespace Pipes\Tests\Stream;

use Pipes\Tests\Spies\Stream\StreamContainerSpy;
use Pipes\Tests\Spies\Stream\HookSpy;
use Pipes\Stream\Dispatcher;

class DispatcherTest extends \Pipes\Tests\TestCase
{
    /**
     * Dispatcher instace
     * 
     * @var Dispatcher
     */
    protected Dispatcher $sut;

    /**
     * Hook Register Spy
     *
     * @var StreamContainerSpy
     */
    protected mixed $streamContainerSpy;

    /**
     * Create sut and mocks
     * 
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->streamContainerSpy = new StreamContainerSpy;

        $this->sut = new Dispatcher(
            streamContainer: $this->streamContainerSpy
        );
    }

    /** @test */
    public function it_should_call_push_hook_on_hook_register(): void
    {
        $this->sut->pushHook(HookSpy::class);

        $this->assertEquals(1, $this->streamContainerSpy->getCallsCount('pushHook'));

        $this->assertEquals(
            $this->streamContainerSpy->getCalls('pushHook')[0]['arguments'][0],
            HookSpy::class
        );
    }
}
