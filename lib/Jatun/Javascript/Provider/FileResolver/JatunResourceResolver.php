<?php

namespace Jatun\Javascript\Provider\FileResolver;

class JatunResourceResolver implements JavascriptFileResolverInterface
{
    /**
     * {@inheritdoc}
     */
    public function resolve($path) 
    {
        $s = DIRECTORY_SEPARATOR;
        return realpath(__DIR__.'/../../../Resources/' . $path);
    }
}