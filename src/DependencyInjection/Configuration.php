<?php
namespace Olla\Flow\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Exception\ExceptionInterface;


final class Configuration implements ConfigurationInterface
{

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('olla_flow');
        $rootNode
            ->children()
                ->scalarNode('storage')->defaultValue('orm')->end()
                ->arrayNode('storages')
                    ->arrayPrototype()
                        ->children()
                            ->scalarNode('engine')->defaultValue('')->end()
                            ->scalarNode('repository')->defaultValue('')->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('theme')
                        ->children()
                            ->scalarNode('frontend')->defaultValue('default')->end()
                            ->scalarNode('admin')->defaultValue('default')->end()
                        ->end()
                ->end()
            ->end();
        return $treeBuilder;
    }
}
