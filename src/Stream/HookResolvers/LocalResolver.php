<?php

namespace Pipes\Stream\HookResolvers;

use Illuminate\Contracts\Filesystem\Filesystem;
use Pipes\Stream\Contracts\HookResolverContract;
use Illuminate\Support\Str;

class LocalResolver implements HookResolverContract
{

    /**
     * Paths that should be scaned for hooks
     * 
     * @var array
     */
    protected array $pathsToScan;

    /**
     * Constructor method
     *
     * @param FileSystem $filesystem
     */
    public function __construct(
        public Filesystem $filesystem
    ) {
        $this->pathsToScan = config('pipes.hooks.paths', []);
    }

    /**
     * Get all hooks from the given path
     * 
     * @param string $namespace
     * @param string $path
     * @return array
     */
    public function getHooksFromPath(string $namespace, string $path): array
    {
        $files = $this->filesystem->allFiles($path);

        return collect($files)
            ->filter(
                fn ($file) => Str::endsWith($file->getFileName(), 'Hook.php')
            )
            ->map(
                fn ($file) => Str::replace($path, '', $file->getPathName())
            )
            ->map(
                fn ($file) => $namespace . Str::replace('.php', '', $file)
            )
            ->map(
                fn ($file) => Str::replace('/', '\\', $file)
            )
            ->toArray();
    }

    /**
     * Resolve hooks scaning project directory
     * 
     * @return array
     */
    public function resolve(): array
    {
        return collect($this->pathsToScan)
            ->flatMap(
                fn ($path, $namespace) => $this->getHooksFromPath($namespace, $path)
            )->toArray();
    }
}
