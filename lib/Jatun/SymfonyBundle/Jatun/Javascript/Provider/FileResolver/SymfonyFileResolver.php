<?php

namespace Jatun\SymfonyBundle\Jatun\Javascript\Provider\FileResolver;

use Jatun\Javascript\Provider\FileResolver\JavascriptFileResolverInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Class SymfonyFileResolver
 * @package Jatun\SymfonyBundle\Jatun\Javascript\Provider\FileResolver
 */
class SymfonyFileResolver implements JavascriptFileResolverInterface
{
    /**
     * @var \Symfony\Component\HttpKernel\Kernel
     */
    private $kernel;

    /**
     * @param Kernel $kernel
     */
    public function __construct(Kernel $kernel)
    {
        $this->kernel = $kernel;
    }

    /**
     * Resolve a given path to an absolute path
     * Return null if could not resolve
     *
     * @param string $path
     * @return string
     */
    public function resolve($path)
    {
        $resolved = null;
        try {
            $resolved = $this->kernel->locateResource($path);
        } catch (\InvalidArgumentException $e) {
            // Do nothing, so the function will return null => could not resolve
        } catch (\RuntimeException $e) {
            // Do nothing, so the function will return null => could not resolve
        }

        return $resolved;
    }
}