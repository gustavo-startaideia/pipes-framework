<?php

namespace Pipes\Tests\Stream;

use Pipes\Tests\Spies\Stream\StreamContainerSpy;
use Pipes\Tests\Spies\Stream\ActionSpy;
use Pipes\Tests\Spies\Stream\HookSpy;
use Pipes\Stream\StreamDispatcher;

class StreamDispatcherTest extends \Pipes\Tests\TestCase
{
    /**
     * Dispatcher instace
     * 
     * @var Dispatcher
     */
    protected StreamDispatcher $sut;

    /**
     * Hook Register Spy
     *
     * @var StreamContainerSpy
     */
    protected mixed $streamContainerSpy;

    /**
     * Hook Spy Instance
     * 
     * @var HookSpy
     */
    protected HookSpy $hookSpyBefore;

    /**
     * Hook Spy Instance
     * 
     * @var HookSpy
     */
    protected HookSpy $hookSpyAfter;

    /**
     * Create sut and mocks
     * 
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->streamContainerSpy = new StreamContainerSpy;
        $this->hookSpyBefore = new HookSpy;
        $this->hookSpyAfter = new HookSpy;

        $this->hookSpyBefore::$before = [ActionSpy::class];
        $this->hookSpyAfter::$after = [ActionSpy::class];

        $this->streamContainerSpy->pushHook(
            hook: $this->hookSpyBefore
        );
        $this->streamContainerSpy->pushHook(
            hook: $this->hookSpyAfter
        );

        $this->sut = new StreamDispatcher(
            streamContainer: $this->streamContainerSpy
        );
    }

    /** @test */
    public function it_should_dispatch_an_action(): void
    {
        $actionSpy = new ActionSpy;

        $this->streamContainerSpy->shouldReturn('getBeforeHooks', [
            $this->hookSpyBefore->shouldReturn('handle', '<valid_payload_before_hook>')
        ]);
        $this->streamContainerSpy->shouldReturn('getAfterHooks', [
            $this->hookSpyAfter->shouldReturn('handle', '<valid_payload_after_hook>')
        ]);

        $resultDispatch = $this->sut->dispatch($actionSpy->setPayload('<valid_payload>'));

        $this->assertEquals('<valid_payload_after_hook>', $resultDispatch);

        $beforeHooksCalls = $this->streamContainerSpy->getCallsCount('getBeforeHooks');
        $afterHooksCalls = $this->streamContainerSpy->getCallsCount('getAfterHooks');

        $this->assertGreaterThanOrEqual(1, $beforeHooksCalls);
        $this->assertGreaterThanOrEqual(1, $afterHooksCalls);

        $this->assertEquals(1, $actionSpy->getCallsCount('handle'));

        $callsArgs = $actionSpy->getCalls('handle')[0]['arguments'][0];
        $this->assertEquals('<valid_payload_before_hook>', $callsArgs);

        $this->assertEquals(1, $this->hookSpyBefore->getCallsCount('handle'));
        $this->assertEquals(1, $this->hookSpyAfter->getCallsCount('handle'));
    }

    /** @test */
    public function it_should_not_execute_hooks_if_should_execute_returns_false(): void
    {
        $actionSpy = new ActionSpy;

        $beforeHookSpy = $this->hookSpyBefore->shouldReturn('shouldExecute', false)->shouldReturn('handle', '<valid_payload_before_hook>');
        $hookSpyAfter = $this->hookSpyAfter->shouldReturn('shouldExecute', false)->shouldReturn('handle', '<valid_payload_after_hook>');

        $this->streamContainerSpy->shouldReturn('getBeforeHooks', [
            $beforeHookSpy
        ]);

        $this->streamContainerSpy->shouldReturn('getAfterHooks', [
            $hookSpyAfter
        ]);

        $resultDispatch = $this->sut->dispatch($actionSpy->setPayload('<valid_payload>'));

        $this->assertEquals('<valid_payload>', $resultDispatch);

        $beforeHooksCalls = $this->streamContainerSpy->getCallsCount('getBeforeHooks');
        $afterHooksCalls = $this->streamContainerSpy->getCallsCount('getAfterHooks');

        $this->assertGreaterThanOrEqual(1, $beforeHooksCalls);
        $this->assertGreaterThanOrEqual(1, $afterHooksCalls);

        $this->assertEquals(1, $actionSpy->getCallsCount('handle'));

        $callsArgs = $actionSpy->getCalls('handle')[0]['arguments'][0];
        $this->assertEquals('<valid_payload>', $callsArgs);

        $this->assertEquals(0, $this->hookSpyBefore->getCallsCount('handle'));
        $this->assertEquals(0, $this->hookSpyAfter->getCallsCount('handle'));
    }
}
