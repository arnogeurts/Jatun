<?php

namespace Jatun\SymfonyBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Class AddJavascriptFileResolverPass
 * @package Jatun\SymfonyBundle\DependencyInjection\Compiler
 */
class AddJavascriptFileResolverPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('jatun.javascript_file_resolver.chain')) {
            return;
        }
        
        $definition = $container->getDefinition('jatun.javascript_file_resolver.chain');
        foreach ($container->findTaggedServiceIds('jatun.javascript_file_resolver') as $id => $attributes) {
            $definition->addMethodCall('addResolver', array(new Reference($id)));
        }
    }
}
