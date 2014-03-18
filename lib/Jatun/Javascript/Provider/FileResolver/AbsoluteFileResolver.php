<?php

namespace Jatun\Javascript\Provider\FileResolver;

/**
 * Class AbsoluteFileResolver
 * @package Jatun\Javascript\Provider\FileResolver
 */
class AbsoluteFileResolver implements JavascriptFileResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function resolve($path)
    {
        return $path;
    }
}