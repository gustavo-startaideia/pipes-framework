<?php

namespace Pipes\Tests\Stream;

use Pipes\Tests\Spies\Stream\StreamContainerSpy;
use Pipes\Tests\Spies\Stream\HookResolverSpy;
use Pipes\Stream\StreamLoader;
use Pipes\Tests\Spies\Stream\HookSpy;

class StreamLoaderTest extends \Pipes\Tests\TestCase
{
    /**
     * Dispatcher instace
     * 
     * @var Dispatcher
     */
    protected StreamLoader $sut;

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

        $this->sut = new StreamLoader(
            streamContainer: $this->streamContainerSpy
        );
    }

    /** @test */
    public function it_should_load_hooks_from_resolvers(): void
    {
        $hookResolverSpy = new HookResolverSpy;
        $hookSpy = new HookSpy;

        $hookResolverSpy->shouldReturn('resolve', [
            $hookSpy
        ]);

        config(['pipes.hooks.resolvers' => [
            $hookResolverSpy
        ]]);

        $this->sut->loadHooks();

        $this->assertEquals(
            1,
            $this->streamContainerSpy->getCallsCount('pushHook')
        );

        $this->assertEquals(
            $hookSpy,
            $this->streamContainerSpy->getCalls('pushHook')[0]['arguments'][0]
        );
    }
}
