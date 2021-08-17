<?php

namespace Pipes\Tests\Stream;

use Pipes\Tests\Spies\Stream\HookResolverSpy;
use Pipes\Tests\Spies\Stream\StreamConnectorSpy;
use Pipes\Tests\Spies\Stream\HookSpy;
use Pipes\Stream\StreamLoader;

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
     * @var StreamConnectorSpy
     */
    protected mixed $streamConnectorSpy;

    /**
     * Create sut and mocks
     * 
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->streamConnectorSpy = new StreamConnectorSpy;

        $this->sut = new StreamLoader(
            streamConnector: $this->streamConnectorSpy
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
            $this->streamConnectorSpy->getCallsCount('pushHook')
        );

        $this->assertEquals(
            $hookSpy,
            $this->streamConnectorSpy->getCalls('pushHook')[0]['arguments'][0]
        );
    }
}
