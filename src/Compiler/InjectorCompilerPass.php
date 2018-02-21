<?php

namespace Olla\Flow\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class InjectorCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $service = $container->findDefinition('olla.repository_component');
        $taggesAction = $container->findTaggedServiceIds('olla.repository', true);
        foreach ($taggesAction as $id => $tags) {
            $engine = $id;
            $serviceId = $id;
            foreach ($tags as $tag) {
                if(isset($tag['engine'])) {
                    $engine = $tag['engine'];
                }
            }
            if(!$engine) {
                continue;
            }
            $action = $container->findDefinition($id);
            $action->setPublic(true);
            $service->addMethodCall(
                'addRepository', [$engine, $serviceId]
            );
        }
    }
}
