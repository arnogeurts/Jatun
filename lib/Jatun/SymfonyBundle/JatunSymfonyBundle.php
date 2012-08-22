<?php

namespace Jatun\SymfonyBundle;

use Jatun\SymfonyBundle\DependencyInjection\Compiler\AddJatunEventPass;
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
        $container->addCompilerPass(new AddJatunEventPass());
    }
}
