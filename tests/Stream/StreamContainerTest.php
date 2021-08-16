<?php

namespace Pipes\Tests\Stream;

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

        $this->sut->pushHook(HookSpy::class);

        $this->assertTrue($this->sut->hasHook(HookSpy::class));

        $this->assertFalse($this->sut->hasHook('<invalid_hook_name>'));
    }

    /** @test */
    public function it_should_retrive_all_hooks_of_a_action()
    {
        HookSpy::$before[] = '<valid_action_name>';
        HookSpy::$after[]  = '<valid_action_name>';

        $this->sut->pushHook(HookSpy::class);

        $retrivedHooks = $this->sut->getHooks('<valid_action_name>');

        $hookCount = collect($retrivedHooks)->filter(
            fn ($hook) => $hook === HookSpy::class
        )->count();

        $this->assertEquals(2, $hookCount);
    }

    /** @test */
    public function it_should_retrive_only_before_hooks()
    {
        HookSpy::$before[] = '<valid_action_name>';
        HookSpy::$after[]  = '<valid_action_name>';

        $this->sut->pushHook(HookSpy::class);

        $retrivedHooks = $this->sut->getBeforeHooks('<valid_action_name>');

        $hookCount = collect($retrivedHooks)->filter(
            fn ($hook) => $hook === HookSpy::class
        )->count();

        $this->assertEquals(1, $hookCount);
    }

    /** @test */
    public function it_should_retrive_only_after_hooks()
    {
        HookSpy::$before[] = '<valid_action_name>';
        HookSpy::$after[]  = '<valid_action_name>';

        $this->sut->pushHook(HookSpy::class);

        $retrivedHooks = $this->sut->getAfterHooks('<valid_action_name>');

        $hookCount = collect($retrivedHooks)->filter(
            fn ($hook) => $hook === HookSpy::class
        )->count();

        $this->assertEquals(1, $hookCount);
    }
}
