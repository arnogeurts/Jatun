<?php

namespace Jatun\SymfonyBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * Class AddJatunEventHandlerPass
 * @package Jatun\SymfonyBundle\DependencyInjection\Compiler
 */
class AddJatunEventHandlerPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('jatun.event_resolver')) {
            return;
        }

        $definition = $container->getDefinition('jatun.event_resolver');
        foreach ($container->findTaggedServiceIds('jatun.event_handler') as $id => $attributes) {
            $definition->addMethodCall('addEventHandler', array(new Reference($id)));
        }
    }
}
