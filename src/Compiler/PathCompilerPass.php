<?php

namespace Olla\Flow\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;


final class PathCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $watchPaths = [];
        $watchPaths['resources'] = [];
        $watchPaths['operations'] = [];
        $watchPaths['types'] = [];
        $watchPaths['admins'] = [];
        $watchPaths['frontends'] = [];
        foreach ($container->getParameter('kernel.bundles_metadata') as $bundle) {
            $dirname = $bundle['path'];
            $paths = [];
            $paths['resources'] = $dirname.'/Entity';
            $paths['operations'] = $dirname.'/Operation';
            $paths['types'] = $dirname.'/Graphql';
            $paths['admins'] = $dirname.'/Admin';
            $paths['frontends'] = $dirname.'/Frontend';
            foreach ($paths as $name => $path) {
                if ($container->fileExists($path, false)) {
                    $watchPaths[$name][] = $path;
                } 
            }
        }
        $appConfig = $container->findDefinition('Olla\Flow\Config');
        $appConfig->addMethodCall(
            'add', ['bundle_resources_path', $watchPaths['resources']]
        );
        $appConfig->addMethodCall(
            'add', ['bundle_operations_path', $watchPaths['operations']]
        );
        $appConfig->addMethodCall(
            'add', ['bundle_admins_path', $watchPaths['admins']]
        );
        $appConfig->addMethodCall(
            'add', ['bundle_frontends_path', $watchPaths['frontends']]
        );
        $appConfig->addMethodCall(
            'add', ['bundle_types_path', $watchPaths['types']]
        );

        //from configuration
        $appConfig->addMethodCall(
            'add', ['app_resources_path', $container->getParameter('app_resources_dirs')]
        );
    }
}
