<?php

namespace Jatun\SymfonyBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class AddJavascriptProviderPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('jatun.javascript_builder')) {
            return;
        }

        $definition = $container->getDefinition('jatun.javascript_builder');
        foreach ($container->findTaggedServiceIds('jatun.javascript_provider') as $id => $attributes) {
            $definition->addMethodCall('addProvider', array(new Reference($id)));
        }
    }
}
