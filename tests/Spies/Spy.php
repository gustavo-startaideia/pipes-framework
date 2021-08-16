<?php

namespace Pipes\Tests\Spies;

trait Spy
{
    /**
     * All method calls
     * 
     * @var array
     */
    public $calls = [];

    /**
     * All mocked return methods
     * 
     * @var array
     */
    public $returns = [];

    /**
     * Set return type
     *
     * @param string $method
     * @param mixed $returns
     * @return mixed
     */
    public function shouldReturn($method, $returns): mixed
    {
        $this->returns[$method] = $returns;

        return $this;
    }

    /**
     * Get calls count of a method
     * 
     * @param string $method
     * @return int
     */
    public function getCallsCount(string $method): int
    {
        return collect($this->calls)->filter(fn ($call) => $call['method'] == $method)->count();
    }

    /**
     * Get all calls of a method
     * 
     * @param string $method
     * @return array
     */
    public function getCalls(string $method): array
    {
        return collect($this->calls)->filter(fn ($call) => $call['method'] == $method)->toArray();
    }

    /**
     * Add a call to a method
     * 
     * @param string $method
     * @param array $arguments
     * @return mixed
     */
    public function addCall(string $name, array $arguments): mixed
    {
        $this->calls[] = ['method' => $name, 'arguments' => $arguments];

        $expectedReturn = optional($this->returns)[$name] ?? null;

        return $expectedReturn;
    }
}
