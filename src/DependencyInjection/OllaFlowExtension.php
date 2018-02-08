<?php

namespace Olla\Flow\DependencyInjection;


use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Config\Resource\DirectoryResource;
use Symfony\Component\DependencyInjection\ChildDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Yaml\Yaml;


final class OllaFlowExtension extends Extension implements PrependExtensionInterface
{

    public function prepend(ContainerBuilder $container)
    {
       
    }
    public function load(array $configs, ContainerBuilder $container)
    {
        $this->reconfig($configs, $container);
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('framework.xml');
        $loader->load('component.xml');
        $loader->load('bundles.xml');

        $loader->load('packages/theme-backend.xml');
        $loader->load('packages/theme-frontend.xml');
    }

    private function reconfig(array $configs, ContainerBuilder $container) {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);
        $container->setParameter('olla.storage', $config['storage']);
        $storages = []; 
        if(isset($config['storages'])) {
            foreach ($config['storages'] as $storage) {
                $storages[$storage['engine']] = $storage['repository'];
            }
        }
        $container->setParameter('olla.storages', $storages);
    }
}
