<?php

namespace Pipes\Stream;

abstract class Action
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
    abstract public function handle(mixed $payload): mixed;

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
    public function getName(): string
    {
        return get_class($this);
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
}
