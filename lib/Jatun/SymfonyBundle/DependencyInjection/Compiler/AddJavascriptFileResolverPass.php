<?php

namespace Jatun\SymfonyBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class AddJavascriptFileResolverPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (false === $container->hasDefinition('jatun.javascript_provider.file')) {
            return;
        }
        
        $definition = $container->getDefinition('jatun.javascript_provider.file');
        foreach ($container->findTaggedServiceIds('jatun.javascript_file_resolver') as $id => $attributes) {
            $definition->addMethodCall('addResolver', array(new Reference($id)));
        }
    }
}
