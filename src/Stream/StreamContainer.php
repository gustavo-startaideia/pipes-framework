<?php

namespace Pipes\Stream;

use Pipes\Stream\Contracts\StreamContainerContract;

class StreamContainer implements StreamContainerContract
{
    /**
     * Before hooks
     * 
     * @var array
     */
    protected $beforeHooks = [];

    /**
     * After hooks
     * 
     * @var array
     */
    protected $afterHooks = [];

    /**
     * Push a hook into the stream container
     * 
     * @param callable $hook
     */
    public function pushHook(string $hook): void
    {
        // register before actions
        collect($hook::$before)->each(function ($action) use ($hook) {
            if (optional($this->beforeHooks)[$action]) {
                $this->beforeHooks[$action] = [...$this->beforeHooks[$action], $hook];
                return;
            }
            $this->beforeHooks[$action] = [$hook];
        });

        // register after action
        collect($hook::$after)->each(function ($action) use ($hook) {
            if (optional($this->afterHooks)[$action]) {
                $this->afterHooks[$action] = [...$this->afterHooks[$action], $hook];
                return;
            }
            $this->afterHooks[$action] = [$hook];
        });
    }

    /**
     * Get only before hooks
     * 
     * @param string $action
     * @return array
     */
    public function getBeforeHooks(string $action): array
    {
        return optional($this->beforeHooks)[$action] ?? [];
    }

    /**
     * Get only after hooks
     * 
     * @param string $action
     * @return array
     */
    public function getAfterHooks(string $action): array
    {
        return optional($this->afterHooks)[$action] ?? [];
    }

    /**
     * Get all hooks of a action
     * 
     * @param string $action
     * @return array
     */
    public function getHooks(string $action): array
    {
        return [
            ...optional($this->beforeHooks)[$action] ?? [],
            ...optional($this->afterHooks)[$action] ?? []
        ];
    }

    /**
     * Check if a given hook is loaded
     * 
     * @param string $hook
     * @return bool
     */
    public function hasHook(string $hook): bool
    {
        return collect(
            array_merge(
                $this->beforeHooks,
                $this->afterHooks
            )
        )
            ->map(fn ($element) => collect($element))
            ->filter(fn ($element) => $element->contains($hook))
            ->count() > 0;
    }
}
