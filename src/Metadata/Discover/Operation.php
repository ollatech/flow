<?php

namespace Olla\Flow\Metadata\Discover;

use Composer\Autoload\ClassLoader;

final class Operation extends Discover implements DiscoverInterface
{
    public function collections($paths) {
        $bundle_paths = $this->config->get('bundle_oprations_path', []);
        $app_paths = $this->config->get('app_operations_path', []);
        $paths = array_merge($bundle_paths, $app_paths);
        $discovers = $this->scanDir($paths, ['php']);
        $classMap = [];
        $resources = [];
        foreach ($discovers as $className => $classFile) {
            $classMap = array_merge($classMap, [$className => $classFile]);
            $resources[] = $className;
        }
        $this->classAutoload($classMap);
        return $resources;
    }
    public function get($className, array $options = []) {
        if($options) {
            return $options;
        }
    }
}
