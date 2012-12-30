<?php

namespace Jatun\Javascript\Provider;

use Jatun\Javascript\JavascriptBuilder;
use Jatun\Javascript\Resource\ChainResource;

class ChainProvider implements JavascriptProviderInterface
{
    /**
     * The javascript builder
     * @var JavascriptBuilderInterface
     */
    private $builder;
    
    /**
     * Constructor
     * Inject the javascript builder
     * 
     * @param JavascriptBuilder $builder
     */
    public function __construct(JavascriptBuilder $builder)
    {
        $this->builder = $builder;
    }
    
    /**
     * {@inheritdoc}
     */
    public function supports($resource)
    {
        return $resource instanceof ChainResource;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getJavascript($resource)
    {
        if ( ! $this->supports($resource)) return '';
        
        $js = '';
        foreach ($resource->getResources() as $r) {
            $js .= $this->builder->getResource($r) . "\n";
        }

        return $js;
    }
}