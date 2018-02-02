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
        $watchPaths['admins'] = [];
        $watchPaths['frontends'] = [];
        foreach ($container->getParameter('kernel.bundles_metadata') as $bundle) {
            $dirname = $bundle['path'];
            $paths = [];
            $paths['resources'] = $dirname.'/Entity';
            $paths['operations'] = $dirname.'/Presentation/Service';
            $paths['admins'] = $dirname.'/Presentation/Admin';
            $paths['frontends'] = $dirname.'/Presentation/Frontend';
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

        //from configuration
        $appConfig->addMethodCall(
            'add', ['flow_resource_paths', $container->getParameter('flow_resource_paths')]
        );
        $appConfig->addMethodCall(
            'add', ['flow_operation_paths', $container->getParameter('flow_operation_paths')]
        );
        $appConfig->addMethodCall(
            'add', ['flow_admin_paths', $container->getParameter('flow_admin_paths')]
        );
        $appConfig->addMethodCall(
            'add', ['flow_frontend_paths', $container->getParameter('flow_frontend_paths')]
        );
    }
}
