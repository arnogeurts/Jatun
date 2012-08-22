<?php

namespace Jatun\SymfonyBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class AddJatunEventPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('jatun.environment')) {
            return;
        }

        $definition = $container->getDefinition('jatun.environment');
        foreach ($container->findTaggedServiceIds('jatun.event') as $id => $attributes) {
            $definition->addMethodCall('addEvent', array(new Reference($id)));
        }
    }
}
