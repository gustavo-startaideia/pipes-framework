<?php


namespace Pipes\Tests\Spies\Stream;

use Pipes\Stream\Contracts\HookResolverContract;
use Pipes\Tests\Spies\Spy;

class HookResolverSpy implements HookResolverContract
{
    use Spy;

    /**
     * Resolve mock method
     * 
     * @return array
     */
    public function resolve(): array
    {
        return $this->addCall('resolve', []);
    }
}
