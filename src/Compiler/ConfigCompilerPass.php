<?php

namespace Olla\Flow\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
 

final class ConfigCompilerPass implements CompilerPassInterface
{ 
	public function process(ContainerBuilder $container)
	{
		$appConfig = $container->findDefinition('Olla\Flow\Config');
		if(!$appConfig) {
			return;
		}
		if($container->hasParameter('class_collection_operation')) {
			$appConfig->addMethodCall(
				'add', ['class_collection_operation', $container->getParameter('class_collection_operation')]
			);
		}
		if($container->hasParameter('class_item_operation')) {
			$appConfig->addMethodCall(
				'add', ['class_item_operation', $container->getParameter('class_item_operation')]
			);
		}
		if($container->hasParameter('class_create_operation')) {
			$appConfig->addMethodCall(
				'add', ['class_create_operation', $container->getParameter('class_create_operation')]
			);
		}
		if($container->hasParameter('class_update_operation')) {
			$appConfig->addMethodCall(
				'add', ['class_update_operation', $container->getParameter('class_update_operation')]
			);
		}
		if($container->hasParameter('class_delete_operation')) {
			$appConfig->addMethodCall(
				'add', ['class_delete_operation', $container->getParameter('class_delete_operation')]
			);
		}
		if($container->hasParameter('class_collection_admin')) {
			$appConfig->addMethodCall(
				'add', ['class_collection_admin', $container->getParameter('class_collection_admin')]
			);
		}
		if($container->hasParameter('class_item_admin')) {
			$appConfig->addMethodCall(
				'add', ['class_item_admin', $container->getParameter('class_item_admin')]
			);
		}
		if($container->hasParameter('class_item_form_admin')) {
			$appConfig->addMethodCall(
				'add', ['class_item_form_admin', $container->getParameter('class_item_form_admin')]
			);
		}
		if($container->hasParameter('class_create_admin')) {
			$appConfig->addMethodCall(
				'add', ['class_create_admin', $container->getParameter('class_create_admin')]
			);
		}
		if($container->hasParameter('class_update_admin')) {
			$appConfig->addMethodCall(
				'add', ['class_update_admin', $container->getParameter('class_update_admin')]
			);
		}
		if($container->hasParameter('class_delete_admin')) {
			$appConfig->addMethodCall(
				'add', ['class_delete_admin', $container->getParameter('class_delete_admin')]
			);
		}

		//default engine
		if($container->hasParameter('storage_engine')) {
			$appConfig->addMethodCall(
				'add', ['storage_engine', $container->getParameter('storage_engine')]
			);
		}

		if($container->hasParameter('guard_agent')) {
			$appConfig->addMethodCall(
				'add', ['guard_agent', $container->getParameter('guard_agent')]
			);
		}

		if($container->hasParameter('monitor_logger')) {
			$appConfig->addMethodCall(
				'add', ['monitor_logger', $container->getParameter('monitor_logger')]
			);
		}
	}
}
