<?php

namespace Pipes\Tests\Stream;

use Pipes\Tests\Spies\Stream\StreamDispatcherSpy;
use Pipes\Tests\Spies\Stream\StreamContainerSpy;
use Pipes\Tests\Spies\Stream\ActionSpy;
use Pipes\Tests\Spies\Stream\HookSpy;
use Pipes\Stream\StreamConnector;
use Pipes\Stream\Action;

class StreamConnectorTest extends \Pipes\Tests\TestCase
{
    /**
     * System Under Tests
     * 
     * @var StreamConnector
     */
    protected StreamConnector $sut;

    /**
     * Stream Container Spy
     * 
     * @var StreamContainerSpy
     */
    protected mixed $streamContainerSpy;

    /**
     * Stream Dispatcher Spy
     * 
     * @var StreamDispatcherSpy
     */
    protected mixed $streamDispatcherSpy;

    /**
     * Create sut and mocks
     * 
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->streamDispatcherSpy = new StreamDispatcherSpy();
        $this->streamContainerSpy = new StreamContainerSpy();

        // crate sut
        $this->sut = new StreamConnector(
            streamContainer: $this->streamContainerSpy,
            streamDispatcher: $this->streamDispatcherSpy
        );
    }

    /** @test */
    function it_should_call_dispatch_with_correct_params()
    {
        $actionSpy = new ActionSpy;

        $this->sut->dispatch($actionSpy);

        $this->assertEquals(1, $this->streamDispatcherSpy->getCallsCount('dispatch'));

        $dispatchArguments = $this->streamDispatcherSpy->getCalls('dispatch')[0]['arguments'][0];
        $this->assertInstanceOf(Action::class, $dispatchArguments);
        $this->assertEquals($actionSpy, $dispatchArguments);
    }

    /** @test */
    function it_should_call_push_hook_with_correct_params()
    {
        $hookSpy = new HookSpy;

        $result = $this->sut->pushHook($hookSpy);

        $this->assertEquals($result, $this->sut);

        $this->assertEquals(1, $this->streamContainerSpy->getCallsCount('pushHook'));
        $this->assertEquals($hookSpy, $this->streamContainerSpy->getCalls('pushHook')[0]['arguments'][0]);
    }
}
