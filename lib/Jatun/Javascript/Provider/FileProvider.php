<?php

namespace Jatun\Javascript\Provider;

use Jatun\Javascript\Provider\FileResolver\JavascriptFileResolverInterface;
use Jatun\Javascript\Resource\FileResource;

class FileProvider implements JavascriptProviderInterface
{
    /**
     * File resolvers to resolve a path 
     * @var array
     */
    private $resolvers = array();
    
    /**
     * Add a file resolver to resolve a path
     * 
     * @param JavascriptFileResolverInterface $resolver
     */
    public function addResolver(JavascriptFileResolverInterface $resolver) 
    {
        $this->resolvers[] = $resolver;
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
        
        $path = $this->resolve($resource->getPath());
        $js = @file_get_contents($path);
        
        if ( ! $js) {
            throw new \Exception(sprintf('Unable to load file resource %s', $path));
        }
        
        return $js;
    }
    
    /**
     * Resolve a given path to a absolute path
     * 
     * @param string $path
     * @return string
     */
    private function resolve($path)
    {
        foreach ($this->resolvers as $resolver) {
            $absolutePath = $resolver->resolve($path);
            
            if ($absolutePath && file_exists($absolutePath)) {
                return $absolutePath;
            }
        }
        
        return $path;
    }
}