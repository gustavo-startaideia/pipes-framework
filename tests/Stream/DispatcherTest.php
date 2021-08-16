<?php

namespace Pipes\Tests\Stream;

use Pipes\Tests\Spies\Stream\HookRegisterSpy;
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
     * @var HookRegisterSpy
     */
    protected mixed $hookRegisterSpy;

    /**
     * Create sut and mocks
     * 
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->hookRegisterSpy = new HookRegisterSpy;

        $this->sut = new Dispatcher(
            hookRegister: $this->hookRegisterSpy
        );
    }

    /** @test */
    public function it_should_call_push_hook_on_hook_register(): void
    {
        $this->sut->pushHook(HookSpy::class);

        $this->assertEquals(1, $this->hookRegisterSpy->getCallsCount('pushHook'));

        $this->assertEquals(
            $this->hookRegisterSpy->getCalls('pushHook')[0]['arguments'][0],
            HookSpy::class
        );
    }
}
