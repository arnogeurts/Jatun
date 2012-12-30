<?php

namespace Jatun\Javascript\Provider\FileResolver;

interface JavascriptFileResolverInterface
{
    /**
     * Resolve a given path to an absolute path
     * Return null if could not resolve
     * 
     * @param string $path
     */
    public function resolve($path);
}