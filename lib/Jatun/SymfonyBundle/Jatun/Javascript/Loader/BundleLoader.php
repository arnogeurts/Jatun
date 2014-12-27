<?php

namespace Jatun\SymfonyBundle\Jatun\Javascript\Loader;

use Jatun\Javascript\Loader\JavascriptLoaderInterface;
use Jatun\Javascript\Resource\ChainResource;
use Jatun\Javascript\Resource\FileResource;
use Jatun\Javascript\Resource\JavascriptResourceInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Class BundleResource
 * @package Jatun\SymfonyBundle\Jatun\Javascript\Loader
 */
class BundleLoader implements JavascriptLoaderInterface
{
    /**
     * @var Kernel
     */
    private $kernel;

    /**
     * @var string
     */
    private $jatunResourcePath;

    /**
     * @param Kernel $kernel
     * @param string $jatunResourcePath
     */
    public function __construct(Kernel $kernel, $jatunResourcePath)
    {
        $this->kernel = $kernel;
        $this->jatunResourcePath = $jatunResourcePath;
    }

    /**
     * @return JavascriptResourceInterface
     */
    public function load()
    {
        $chain = new ChainResource();
        foreach ($this->kernel->getBundles() as $bundle) {
            // get the path to the jatun resources in the given bundle, and check whether it exists
            $path = rtrim($bundle->getPath(), '/') . '/' . trim($this->jatunResourcePath, '/');
            if (!is_dir($path)) continue;

            // iterate through all the *.js files in the jatun resource, and add them as resources to the chain
            $finder = new Finder();
            $finder->files()->name('*.js');

            /** @var SplFileInfo $file */
            foreach ($finder->in($path) as $file) {
                $chain->addResource(new FileResource($file->getPathname()));
            }
        }

        return $chain;
    }
}