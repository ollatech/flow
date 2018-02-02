<?php

namespace Olla\Flow\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class InjectorCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $service = $container->findDefinition('Olla\Flow\Service\Service');
        $taggesAction = $container->findTaggedServiceIds('olla.provider', true);
        foreach ($taggesAction as $id => $tags) {
            $provider = null;
            $providerId = $id;
            $serviceId = $id;
            foreach ($tags as $tag) {
                if(isset($tag['alias'])) {
                    $providerId = $tag['alias'];
                }
                if(isset($tag['provider'])) {
                    $provider = $tag['provider'];
                }
            }
            if(!$provider) {
                continue;
            }
            $action = $container->findDefinition($id);
            $action->setPublic(true);
            $service->addMethodCall(
                'addService', [$provider, $providerId, $serviceId]
            );
        }
    }
}
