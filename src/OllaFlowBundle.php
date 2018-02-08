<?php
namespace Olla\Flow;

use Olla\Flow\Compiler\ConfigCompilerPass;
use Olla\Flow\Compiler\InjectorCompilerPass;
use Olla\Flow\Compiler\ThemeCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;


final class OllaFlowBundle extends Bundle
{
	public function build(ContainerBuilder $container)
	{
		parent::build($container);
		$container->addCompilerPass(new ConfigCompilerPass());
		$container->addCompilerPass(new InjectorCompilerPass());
		$container->addCompilerPass(new ThemeCompilerPass());
	}
}
