<?php

namespace Jatun\Javascript\Provider\FileResolver;

interface JavascriptFileResolverInterface
{
    /**
     * Resolve a given path to an absolute path
     * Return null if could not resolve
     *
     * @throws \RuntimeException when the path could not be resolved
     * @param string $path
     */
    public function resolve($path);
}