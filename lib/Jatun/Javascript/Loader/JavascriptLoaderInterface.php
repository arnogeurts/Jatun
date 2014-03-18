<?php

namespace Jatun\Javascript\Loader;

use Jatun\Javascript\Resource\JavascriptResourceInterface;

/**
 * Interface JavascriptLoaderInterface
 * @package Jatun\Javascript\Loader
 */
interface JavascriptLoaderInterface
{
    /**
     * @return JavascriptResourceInterface
     */
    public function load();
} 