<?php

namespace Jatun\Javascript\Provider;

use Jatun\Javascript\Provider\FileResolver\JavascriptFileResolverInterface;
use Jatun\Javascript\Resource\FileResource;

class FileProvider implements JavascriptProviderInterface
{
    /**
     * File resolvers to resolve a path 
     * @var JavascriptFileResolverInterface
     */
    private $resolver;

    /**
     * @param JavascriptFileResolverInterface $resolver
     */
    public function __construct(JavascriptFileResolverInterface $resolver)
    {
        $this->resolver = $resolver;
    }
    
    /**
     * {@inheritdoc}
     */
    public function supports($resource)
    {
        return $resource instanceof FileResource;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getJavascript($resource)
    {
        if ( ! $this->supports($resource)) return '';
        
        $path = $this->resolver->resolve($resource->getPath());
        $js = @file_get_contents($path);
        
        if ( ! $js) {
            throw new \Exception(sprintf('Unable to load file resource %s', $path));
        }
        
        return trim($js);
    }
}