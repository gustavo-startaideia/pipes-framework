<?php

namespace Pipes\Tests\Spies;

trait Spy
{
    public $calls = [];

    public function getCallsCount($method): int
    {
        return collect($this->calls)->filter(fn ($call) => $call['method'] == $method)->count();
    }

    public function getCalls($method): array
    {
        return collect($this->calls)->filter(fn ($call) => $call['method'] == $method)->toArray();
    }

    public function addCall(string $name, array $arguments): mixed
    {
        $this->calls[] = ['method' => $name, 'arguments' => $arguments];

        return null;
    }
}
