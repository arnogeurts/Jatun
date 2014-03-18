<?php

namespace Jatun\Javascript\Loader;

use Jatun\Javascript\Resource\ChainResource;
use Jatun\Javascript\Resource\FileResource;
use Jatun\Javascript\Resource\JavascriptResourceInterface;
use Jatun\Javascript\Resource\StringResource;

/**
 * Class CoreLoader
 * @package Jatun\Javascript\Loader
 */
class CoreLoader implements JavascriptLoaderInterface
{
    /**
     * @var JavascriptLoaderInterface
     */
    private $loader;

    /**
     * @param JavascriptLoaderInterface $loader
     */
    public function __construct(JavascriptLoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     * @return JavascriptResourceInterface
     */
    public function load()
    {
        return new ChainResource(array(
            new StringResource("(function($) {\n"),
            new FileResource('core.js'),
            new FileResource('default_parser.js'),
            $this->loader->load(),
            new StringResource("})(jQuery);")
        ));
    }
}