<?php

namespace Pipes\Stream;

use Pipes\Facades\Stream;

class Action
{
    /**
     * Action payload
     * 
     * @var array
     */
    public mixed $payload = [];

    /**
     * Handle action dispatching
     *
     * @param mixed $payload
     * @return mixed
     */
    public function handle(mixed $payload): mixed
    {
        return $payload;
    }

    /**
     * Gets action payload
     * 
     * @return mixed
     */
    public function getPayload(): mixed
    {
        return $this->payload;
    }

    /**
     * Get action name
     * 
     * @return string
     */
    public static function getName(): string
    {
        return static::class;
    }

    /**
     * Set action payload
     * 
     * @param mixed $payload
     * @return Action
     */
    public function setPayload(mixed $payload): Action
    {
        $this->payload = $payload;

        return $this;
    }

    /**
     * Dispatch this action into the stream
     * 
     * @param mixed $payload
     * @return mixed
     */
    static function dispatch(mixed $payload): mixed
    {
        $action = new static;
        return Stream::dispatch($action->setPayload($payload));
    }
}
