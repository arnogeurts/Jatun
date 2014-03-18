<?php

namespace Jatun\Javascript;

use Jatun\Javascript\Loader\JavascriptLoaderInterface;
use Jatun\Javascript\Provider\JavascriptProviderInterface;
use Jatun\Javascript\Resource\JavascriptResourceInterface;

/**
 * @author Arno Geurts
 */
class JavascriptBuilder
{   
    /**
     * The javascript providers to cast the resources to string
     * @var JavascriptProviderInterface[]
     */
    private $providers = array();

    /**
     * @var JavascriptLoaderInterface
     */
    private $loader = array();

    /**
     * @param JavascriptLoaderInterface $loader
     */
    public function __construct(JavascriptLoaderInterface $loader)
    {
        $this->loader = $loader;
    }

    /**
     * Add a provider to cast the resource to javascript string
     * 
     * @param JavascriptProviderInterface $provider
     */
    public function addProvider(JavascriptProviderInterface $provider)
    {
        $this->providers[] = $provider;
    }

    /**
     * {@inheritdoc}
     */
    public function build()
    {
        return $this->buildResource($this->loader->load());
    }

    /**
     * Build the given resource to a string
     *
     * @param mixed $resource
     * @throws \Exception
     * @return string
     */
     public function buildResource(JavascriptResourceInterface $resource)
     {
         foreach ($this->providers as $provider) {
             if ($provider->supports($resource)) {
                 return $provider->getJavascript($resource);
             }
         }
         
         throw new \Exception(sprintf('No provider found for resource class %s', get_class($resource)));
     }
}