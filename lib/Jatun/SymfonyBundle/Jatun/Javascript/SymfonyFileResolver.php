<?php

namespace Jatun\SymfonyBundle\Jatun\Javascript;

use Jatun\Javascript\Provider\FileResolver\JavascriptFileResolverInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\Kernel;

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
        return $this->kernel->locateResource($path);
    }
}