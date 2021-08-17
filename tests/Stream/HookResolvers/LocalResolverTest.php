<?php

namespace Pipes\Tests\Stream\HookResolvers;

use Pipes\Stream\HookResolvers\LocalResolver;
use Pipes\Tests\Spies\FilesystemSpy;
use SplFileInfo;

class LocalResolverTest extends \Pipes\Tests\TestCase
{
    /**
     * System Under Test
     * 
     * @var LocalResolver
     */
    protected $sut;

    /**
     * Filesystem Spy
     * 
     * @var FilesystemSpy
     */
    protected FilesystemSpy $filesystemSpy;

    /**
     * Create sut and mocks
     * 
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        config(['pipes.hooks.paths' => [
            '<valid_name_space>' => '<valid_path>'
        ]]);

        $this->filesystemSpy = new FilesystemSpy;

        $this->sut = new LocalResolver(
            filesystem: $this->filesystemSpy
        );
    }

    /** @test */
    public function it_should_load_hooks_from_a_path()
    {
        $this->filesystemSpy->shouldReturn('allFiles', [
            new SplFileInfo('<valid_path>/PathToHook.php'),
            new SplFileInfo('<valid_path>/Another/PathToHook.php'),
            new SplFileInfo('<valid_path>/Another/NotAHookClass.php'),
        ]);

        $hooks = $this->sut->resolve();

        $this->assertCount(2, $hooks);
        $this->assertEquals([
            '<valid_name_space>\\PathToHook',
            '<valid_name_space>\\Another\\PathToHook'
        ], $hooks);
    }
}
