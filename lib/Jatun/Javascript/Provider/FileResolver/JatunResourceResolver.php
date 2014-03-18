<?php

namespace Jatun\Javascript\Provider\FileResolver;

/**
 * Class JatunResourceFileResolver
 * @package Jatun\Javascript\Provider\FileResolver
 */
class JatunResourceResolver implements JavascriptFileResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function resolve($path) 
    {
        return realpath(__DIR__.'/../../../Resources/' . $path);
    }
}