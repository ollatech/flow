<?php

namespace Olla\Flow\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class ThemeCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
       
        $service = $container->findDefinition('olla.theme_component');
        $taggesAction = $container->findTaggedServiceIds('olla.theme', true);
        foreach ($taggesAction as $id => $tags) {
            $serviceId = $id;
            $context = null;
            $design = null;
            foreach ($tags as $tag) {
                if(isset($tag['design'])) {
                    $design = $tag['design'];
                }
                if(isset($tag['context'])) {
                    $context = $tag['context'];
                }
            }
            if(!$context || !$design) {
                continue;
            }
            $action = $container->findDefinition($id);
            $action->setPublic(true);
            $service->addMethodCall(
                'addTheme', [$context, $design, $serviceId]
            );
        }
    }
}
