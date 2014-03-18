<?php

namespace Jatun\Javascript\Provider\FileResolver;

/**
 * Class ChainResolver
 * @package Jatun\Javascript\Provider\FileResolver
 */
class ChainResolver implements JavascriptFileResolverInterface
{
    /**
     * @var JavascriptFileResolverInterface[]
     */
    private $resolvers = array();

    /**
     * @param JavascriptFileResolverInterface $resolver
     */
    public function addResolver(JavascriptFileResolverInterface $resolver)
    {
        $this->resolvers[] = $resolver;
    }

    /**
     * {@inheritdoc}
     */
    public function resolve($path)
    {
        $resolvedPath = null;
        foreach ($this->resolvers as $resolver) {
            $resolvedPath = $resolver->resolve($path);
            if (file_exists($resolvedPath)) {
                break;
            }
        }

        return $resolvedPath;
    }
}