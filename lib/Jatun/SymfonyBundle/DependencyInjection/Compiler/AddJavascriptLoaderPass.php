<?php

namespace Jatun\SymfonyBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Class AddJavascriptLoaderPass
 * @package Jatun\SymfonyBundle\DependencyInjection\Compiler
 */
class AddJavascriptLoaderPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('jatun.javascript_loader.chain')) {
            return;
        }

        $definition = $container->getDefinition('jatun.javascript_loader.chain');
        foreach ($container->findTaggedServiceIds('jatun.javascript_loader') as $id => $attributes) {
            $definition->addMethodCall('addLoader', array(new Reference($id)));
        }
    }
}
