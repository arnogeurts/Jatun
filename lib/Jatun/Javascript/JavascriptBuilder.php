<?php

namespace Jatun\Javascript;

use Jatun\Javascript\Parser\JavascriptParserInterface;
use Jatun\Javascript\Provider\JavascriptProviderInterface;
use Jatun\Javascript\Resource\ChainResource;
use Jatun\Javascript\Resource\JavascriptResourceInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @author Arno Geurts
 */
class JavascriptBuilder
{   
    /**
     * The javascript providers to cast the resources to string
     * @var array
     */
    private $providers = array();
    
    /**
     * The class for the event resource
     * @var string
     */
    private $options;
    
    /**
     * Constructor
     * Inject the core resource
     * 
     * @param mixed $coreResource
     */
    public function __construct(array $options = array())
    {
        $this->setOptions($options);
    }
    
    /**
     * Resolve the options passed to the builder
     * 
     * @param array $options
     */
    protected function setOptions(array $options)
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults(array(
           'event_resource_class' => '\\Jatun\\Javascript\\Resource\\EventResource',
           'core_resource_class'  => '\\Jatun\\Javascript\\Resource\\CoreResource'
        ));
        
        $this->options = $resolver->resolve($options);
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
    public function build(JavascriptEventCollector $collector) 
    {
        $coreClass = $this->options['core_resource_class'];
        $eventClass = $this->options['event_resource_class'];
        
        $resources = array(new $coreClass());
        foreach ($collector as $event => $resource) {
            $resources[] = new $eventClass($event, $resource);
        }
        
        return $this->getResource(new ChainResource($resources));
    }
    
    /**
     * Build the given resource to a string
     * 
     * @param mixed $resource
     */
     public function getResource(JavascriptResourceInterface $resource)
     {
         foreach ($this->providers as $provider) {
             if ($provider->supports($resource)) {
                 return $provider->getJavascript($resource);
             }
         }
         
         throw new \Exception(sprintf('No provider found for resource class %s', get_class($resource)));
     }
}