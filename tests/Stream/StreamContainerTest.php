<?php

namespace Pipes\Tests\Stream;

use Pipes\Tests\Spies\Stream\InvalidHookSpy;
use Pipes\Tests\Spies\Stream\ActionSpy;
use Pipes\Tests\Spies\Stream\HookSpy;
use Pipes\Stream\StreamContainer;

class StreamContainerTest extends \Pipes\Tests\TestCase
{
    /**
     * System Under Tests
     * 
     * @var StreamContainer
     */
    protected StreamContainer $sut;

    /**
     * Create sut and mocks
     * 
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        // reset hook actions
        HookSpy::$before = [];
        HookSpy::$after = [];

        // crate sut
        $this->sut = new StreamContainer();
    }

    /** @test */
    public function it_should_register_a_hook()
    {
        HookSpy::$before[] = '<valid_action_name>';
        HookSpy::$after[]  = '<valid_action_name>';

        $hookSpy = new HookSpy;

        $this->sut->pushHook($hookSpy);

        $this->assertTrue($this->sut->hasHook($hookSpy));

        $this->assertFalse($this->sut->hasHook(new InvalidHookSpy));
    }

    /** @test */
    public function it_should_retrive_all_hooks_of_a_action()
    {
        HookSpy::$before[] = ActionSpy::class;
        HookSpy::$after[]  = ActionSpy::class;

        $actionSpy = new ActionSpy;
        $hookSpy = new HookSpy;

        $this->sut->pushHook($hookSpy);

        $retrivedHooks = $this->sut->getHooks($actionSpy);

        $hookCount = collect($retrivedHooks)->filter(
            fn ($hook) => $hook->getName() === $hookSpy->getName()
        )->count();

        $this->assertEquals(2, $hookCount);
    }

    /** @test */
    public function it_should_retrive_only_before_hooks()
    {
        HookSpy::$before[] = ActionSpy::class;
        HookSpy::$after[]  = ActionSpy::class;

        $actionSpy = new ActionSpy;
        $hookSpy = new HookSpy;

        $this->sut->pushHook($hookSpy);

        $retrivedHooks = $this->sut->getBeforeHooks($actionSpy);

        $hookCount = collect($retrivedHooks)->filter(
            fn ($hook) => $hook->getName() === $hookSpy->getName()
        )->count();

        $this->assertEquals(1, $hookCount);
    }

    /** @test */
    public function it_should_retrive_only_after_hooks()
    {
        HookSpy::$before[] = ActionSpy::class;
        HookSpy::$after[]  = ActionSpy::class;

        $actionSpy = new ActionSpy;
        $hookSpy = new HookSpy;

        $this->sut->pushHook($hookSpy);

        $retrivedHooks = $this->sut->getAfterHooks($actionSpy);

        $hookCount = collect($retrivedHooks)->filter(
            fn ($hook) => $hook->getName() === $hookSpy->getName()
        )->count();

        $this->assertEquals(1, $hookCount);
    }
}
