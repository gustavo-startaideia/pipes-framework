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
     * @param Hook $hook
     * @return void
     */
    public function pushHook(Hook $hook): void
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
     * @param Action $action
     * @return array
     */
    public function getBeforeHooks(Action $action): array
    {
        return optional($this->beforeHooks)[$action->getName()] ?? [];
    }

    /**
     * Get only after hooks
     * 
     * @param Action $action
     * @return array
     */
    public function getAfterHooks(Action $action): array
    {
        return optional($this->afterHooks)[$action->getName()] ?? [];
    }

    /**
     * Get all hooks of a action
     * 
     * @param Action $action
     * @return array
     */
    public function getHooks(Action $action): array
    {
        return [
            ...optional($this->beforeHooks)[$action->getName()] ?? [],
            ...optional($this->afterHooks)[$action->getName()] ?? []
        ];
    }

    /**
     * Check if a given hook is loaded
     * 
     * @param Hook $hook
     * @return bool
     */
    public function hasHook(Hook $hook): bool
    {
        return collect(
            array_merge(
                $this->beforeHooks,
                $this->afterHooks
            )
        )
            ->map(fn ($element) => collect($element)->map(fn ($hook) => $hook->getName()))
            ->filter(fn ($element) => $element->contains($hook->getName()))
            ->count() > 0;
    }
}
