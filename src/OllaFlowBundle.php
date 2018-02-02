<?php
namespace Olla\Flow;

use Olla\Flow\Compiler\ConfigCompilerPass;
use Olla\Flow\Compiler\PathCompilerPass;
use Olla\Flow\Compiler\InjectorCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;


final class OllaFlowBundle extends Bundle
{
	public function build(ContainerBuilder $container)
	{
		parent::build($container);
		$container->addCompilerPass(new ConfigCompilerPass());
		$container->addCompilerPass(new PathCompilerPass());
		$container->addCompilerPass(new InjectorCompilerPass());
	}
}
