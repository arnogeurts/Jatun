<?php

namespace Jatun\Javascript\Provider;

use Jatun\Javascript\Resource\StringResource;

class StringProvider implements JavascriptProviderInterface
{
    /**
     * {@inheritdoc}
     */
    public function supports($resource)
    {
        return $resource instanceof StringResource;
    }
    
    /**
     * {@inheritdoc}
     */
    public function getJavascript($resource)
    {
        if ( ! $this->supports($resource)) return '';
        
        return $resource->getJavascript();
    }
}