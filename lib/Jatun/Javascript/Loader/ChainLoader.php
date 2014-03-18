<?php

namespace Jatun\Javascript\Loader;

use Jatun\Javascript\Resource\ChainResource;
use Jatun\Javascript\Resource\JavascriptResourceInterface;

/**
 * Class ChainLoader
 * @package Jatun\Javascript\Loader
 */
class ChainLoader implements JavascriptLoaderInterface
{
    /**
     * @var JavascriptLoaderInterface[]
     */
    private $loaders = array();

    /**
     * @param JavascriptLoaderInterface $loader
     */
    public function addLoader(JavascriptLoaderInterface $loader)
    {
        $this->loaders[] = $loader;
    }
    /**
     * @return JavascriptResourceInterface
     */
    public function load()
    {
        $resource = new ChainResource();
        foreach ($this->loaders as $loader) {
            $resource->addResource($loader->load());
        }

        return $resource;
    }
}