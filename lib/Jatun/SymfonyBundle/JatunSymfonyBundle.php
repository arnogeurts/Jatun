<?php

namespace Jatun\SymfonyBundle;

use Jatun\SymfonyBundle\DependencyInjection\Compiler\AddJatunEventHandlerPass;
use Jatun\SymfonyBundle\DependencyInjection\Compiler\AddJavascriptFileResolverPass;
use Jatun\SymfonyBundle\DependencyInjection\Compiler\AddJavascriptLoaderPass;
use Jatun\SymfonyBundle\DependencyInjection\Compiler\AddJavascriptProviderPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class JatunSymfonyBundle extends Bundle
{
    /**
     * Add jatun event pass to the container builder
     * 
     * @param ContainerBuilder $container 
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new AddJatunEventHandlerPass());
        $container->addCompilerPass(new AddJavascriptFileResolverPass());
        $container->addCompilerPass(new AddJavascriptProviderPass());
        $container->addCompilerPass(new AddJavascriptLoaderPass());
    }
}
